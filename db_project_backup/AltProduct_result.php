<?php
$PHOTO = $_POST["PHOTO"];
$TITLE = $_POST["TITLE"];
$PRICE = $_POST["PRICE"];
$CONTENT = $_POST["CONTENT"];
$Alt_Number = $_POST["Alt_Number"];

session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];

$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';

$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
echo "디비 연결 성공<br>";


$sql = "UPDATE ProductInformation  SET PHOTO = '$PHOTO', TITLE = '$TITLE', PRICE = '$PRICE', CONTENT = '$CONTENT' WHERE ProductUniqueNumber = '$Alt_Number'";
$ret = oci_execute(oci_parse($con, $sql));

if($ret)  
{  
    oci_commit($con);
    oci_close($con);
    echo "데이터 변경 성공<br>";
    header('Location: mypage.php');
}
else
{
    echo "Error.";
}

?>