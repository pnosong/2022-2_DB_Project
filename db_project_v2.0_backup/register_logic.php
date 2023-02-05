<?php
session_start();

$account = $_POST['account'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$name = $_POST['name'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$phonenumber = $_POST['phonenumber'];
$birthday = $_POST['birthday'];

if (!is_null($account)) {
    $db_information = '(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA = (SID = orcl)))';
    $connect = oci_connect("DBA2022G3", "test1234", $db_information);
}

$sql = "SELECT account FROM MemberInformation WHERE account='$account'";
$stat = oci_parse($connect, $sql);
$ret = oci_execute($stat);
$row = oci_fetch_row($stat);


if ($account == $row[0]) {
    echo "<script>alert('Duplicate ID.');
        location.href='./login.php'
        </script>";
} else if ($password != $password_confirm) {
    echo "<script>alert('Please check the password again.');
        location.href='./login.php'
        </script>";
} else {
    $sql_add_user = "insert into MemberInformation
        ( account, password, name, nickname, email, sex, phonenumber, birthday ) VALUES
        ( '$account', '$password', '$name', '$nickname', '$email', '$sex', '$phonenumber', '$birthday' )";
    $stat_add_user = oci_parse($connect, $sql_add_user);
    $ret_add_user = oci_execute($stat_add_user);

    $_SESSION['account'] = $account;
    $_SESSION['password'] = $password;

    $sql_name = "SELECT name FROM MemberInformation WHERE account='$account'";
    $result_name = oci_parse($connect, $sql_name);
    oci_execute($result_name);
    $row_name = oci_fetch_row($result_name);
    $_SESSION['name'] = $row_name[0];

    $sql_nickname = "SELECT nickname FROM MemberInformation WHERE account='$account'";
    $result_nickname = oci_parse($connect, $sql_nickname);
    oci_execute($result_nickname);
    $row_nickname = oci_fetch_row($result_nickname);
    $_SESSION["nickname"] = $row_nickname[0];

    $sql_Email = "SELECT Email FROM MemberInformation WHERE account='$account'";
    $result_Email = oci_parse($connect, $sql_Email);
    oci_execute($result_Email);
    $row_Email = oci_fetch_row($result_Email);
    $_SESSION["Email"] = $row_Email[0];

    $sql_sex = "SELECT sex FROM MemberInformation WHERE account='$account'";
    $result_sex = oci_parse($connect, $sql_sex);
    oci_execute($result_sex);
    $row_sex = oci_fetch_row($result_sex);
    $_SESSION["sex"] = $row_sex[0];

    $sql_phonenumber = "SELECT phonenumber FROM MemberInformation WHERE account='$account'";
    $result_phonenumber = oci_parse($connect, $sql_phonenumber);
    oci_execute($result_phonenumber);
    $row_phonenumber = oci_fetch_row($result_phonenumber);
    $_SESSION["phonenumber"] = $row_phonenumber[0];

    $sql_birthday = "SELECT birthday FROM MemberInformation WHERE account='$account'";
    $result_birthday = oci_parse($connect, $sql_birthday);
    oci_execute($result_birthday);
    $row_birthday = oci_fetch_row($result_birthday);
    $_SESSION["birthday"] = $row_birthday[0];

    oci_close($connect);
    header('Location: register_success.html');
}
