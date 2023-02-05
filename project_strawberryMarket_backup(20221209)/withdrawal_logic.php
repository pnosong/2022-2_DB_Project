<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];

$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';
$con = oci_connect("DBA2022G3", "test1234", $db);

$sql = "DELETE from MemberInformation  WHERE account= '$my_account'";
$ret = oci_execute(oci_parse($con, $sql));

if($ret)  
{  
    oci_commit($con);
    oci_close($con);
    echo "회원 탈퇴 성공<br>";
    session_destroy();
    header( 'Location: login_and_createAccount.html' );
}
else
{
    echo "Error.";
}
?>