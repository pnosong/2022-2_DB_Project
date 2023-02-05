<?php
error_reporting(E_ALL & ~E_WARNING);
session_start();

$account = $_POST['account'];
$password = $_POST['password'];

$db_information = '(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA = (SID = orcl)))';
$connect = oci_connect("DBA2022G3", "test1234", $db_information);

$sql_password = "SELECT password FROM MemberInformation WHERE account='$account'";
$result_password = oci_parse($connect, $sql_password);
oci_execute($result_password);

$row = oci_fetch_row($result_password);
$encrypted_password = $row[0];

if (is_null($encrypted_password)) { // 계정명과 일치하는 비밀번호가 없을 경우
    echo "<script>alert('This account does not exist.');
    location.href='./login.php'
    </script>";
    oci_close($connect);
} else {
    if ($encrypted_password == $password) {
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
        header('Location: mainpage.php');
    } else { // 계정명과 일치하는 비밀번호가 입력과 다를경우
        echo "<script>alert('Password does not match.');
        location.href='./login.php'
        </script>";
        oci_close($connect);
    }
}
