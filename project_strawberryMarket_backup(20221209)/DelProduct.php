<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];

$Del_Number = $_POST['Del_Product_ProductUniqueNumber'];
$Del_Number1 = $_POST['Del_Product_PHOTO'];

echo "ProductUniqueNumber 값";
echo $Del_Number,"<br>";
echo "성공","<br>";

$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';
$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) 
{
    
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}

$sql2 = "select PHOTO from ProductInformation where PHOTO = '$Del_Number1'";
$stat = oci_parse($con, $sql2);
$ret = oci_execute($stat);

while(($row = oci_fetch_array($stat)) != false){
    $photoName = $row['PHOTO'];
}

echo $photoName , "<br>";
$total_photoName = './img/'.$photoName;
echo $total_photoName, "<br>";
if(file_exists($total_photoName)){
    unlink($total_photoName);
    echo "img 폴더에서 파일삭제 성공";
}else{
    echo "img 폴더에서 파일삭제 실패";
}



$sql = "DELETE FROM ProductInformation WHERE ProductUniqueNumber = '$Del_Number'";
$stat = oci_parse($con, $sql);
$ret = oci_execute($stat);

if (!$ret) {
    echo "<br/>";
    echo "데이터 정보 삭제 실패";
    echo "<br/>";
}

$sql = "DELETE FROM ProductTransactionStatus WHERE ProductUniqueNumber = $Del_Number";
$stat = oci_parse($con, $sql);
$ret = oci_execute($stat);

if (!$ret) {
    echo "<br/>";
    echo "데이터 상태 삭제 실패";
    echo "<br/>";
}

$sql = "DELETE FROM ProductList WHERE ProductUniqueNumber = $Del_Number";
$stat = oci_parse($con, $sql);
$ret = oci_execute($stat);

if (!$ret) {
    echo "<br/>";
    echo "데이터 상태 삭제 실패";
    echo "<br/>";
}




oci_close($con);

header( 'Location: mypage.php' );
?>