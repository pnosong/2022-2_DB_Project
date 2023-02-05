<?php
$account = $_POST["account"];
$password = $_POST["password"];
$name = $_POST["name"];
$nickname = $_POST["nickname"];
$Email = $_POST["Email"];
$sex = $_POST["sex"];
$phonenumber = $_POST["phonenumber"];
$birthday = $_POST["birthday"]; 

session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];
$my_name = $_SESSION["name"];
$my_nickname = $_SESSION["nickname"];
$my_Email = $_SESSION["Email"];
$my_sex = $_SESSION["sex"];
$my_phonenumber = $_SESSION["phonenumber"];
$my_birthday = $_SESSION["birthday"];

$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';

$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
echo "디비 연결 성공<br>";



$sql = "SELECT account FROM MemberInformation WHERE account='$account'";
    $stat = oci_parse($con, $sql);
    $ret = oci_execute($stat);
    $row = oci_fetch_row($stat);

if($account == $row[0] and $account != $my_account){     //다른 회원과 아이디가 같으면 불가능
    header( 'Location: modify_accountFail.html' );
}else{
    $sql = "UPDATE MemberInformation SET account = '$account', password = '$password', name = '$name', nickname = '$nickname', Email = '$Email', sex = '$sex' , phonenumber = '$phonenumber' , birthday = '$birthday'  WHERE account= '$my_account'";
    $ret = oci_execute(oci_parse($con, $sql));

    if($ret)  
    {  
        oci_commit($con);
        oci_close($con);
        echo "데이터 변경 성공<br>";
        header('Location: login.php');
    }
    else
    {
        echo "Error.";
    }
}
?>