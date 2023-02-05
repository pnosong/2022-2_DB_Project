<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];
$my_name = $_SESSION["name"];
$my_nickname = $_SESSION["nickname"];
$my_Email = $_SESSION["Email"];
$my_sex = $_SESSION["sex"];
$my_phonenumber = $_SESSION["phonenumber"];
$my_birthday = $_SESSION["birthday"];
$my_pid = $_POST["ProductUniqueNumber"];
include_once 'db_connect.php';

$sql1 = "UPDATE ProductTransactionStatus SET BUYER = '' WHERE ProductUniqueNumber = $my_pid";
$stat1 = oci_parse($con, $sql1);  
$ret1 = oci_execute($stat1);
if (!$ret1) {
    echo "<br/>";
    echo "데이터 갱신 실패";
    echo "<br/>";
}

$sql2 = "UPDATE ProductTransactionStatus SET Status = 'before' WHERE ProductUniqueNumber = $my_pid";
$stat2 = oci_parse($con, $sql2);  
$ret2 = oci_execute($stat2);
if (!$ret2) {
    echo "<br/>";
    echo "데이터 갱신 실패";
    echo "<br/>";
}
oci_close($con);
header( 'Location: mainpage.php' )
?>