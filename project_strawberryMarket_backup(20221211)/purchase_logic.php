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

$sql1 = "UPDATE ProductTransactionStatus SET BUYER = '$my_account' WHERE ProductUniqueNumber = $my_pid";
$stat = oci_parse($con, $sql1);  
$ret = oci_execute($stat);
if (!$ret) {
    echo "<br/>";
    echo "데이터 갱신 실패";
    echo "<br/>";
}

$sql2 = "UPDATE ProductTransactionStatus SET status = 'after' WHERE ProductUniqueNumber = $my_pid";
$stat = oci_parse($con, $sql2);  
$ret = oci_execute($stat);
if (!$ret) {
    echo "<br/>";
    echo "데이터 갱신 실패";
    echo "<br/>";
}
oci_close($con);

echo "<script>alert('상품정보 수정이 완료되었습니다!');
        location.href='./mainpage.php'
        </script>";
?>
