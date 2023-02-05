<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];

$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';
$con = oci_connect("DBA2022G3", "test1234", $db);

// img파일 사진 삭제
$sql = "SELECT ProductInformation.PHOTO, ProductInformation.ProductUniqueNumber
from 
ProductInformation
join
ProductList
on
ProductList.ProductUniqueNumber = ProductInformation.ProductUniqueNumber
join 
MemberInformation 
on 
MemberInformation.account = ProductList.account 
join 
ProductTransactionStatus 
on 
ProductTransactionStatus.ProductUniqueNumber = ProductList.ProductUniqueNumber 
where 
MemberInformation.account = '$my_account' 
and 
ProductTransactionStatus.status = 'before')";

$stat = oci_parse($con, $sql);
$ret = oci_execute($stat);

while(($row = oci_fetch_array($stat)) != false){
    $photoName = $row['ProductUniqueNumber']."_".$row['PHOTO'];
    $total_photoName = './img/'.$photoName;

    if(file_exists($total_photoName)){
        unlink($total_photoName);
    }
}

// 탈퇴한 회원 정보, 올린 물품 삭제 
$sql1 = "DELETE 
    from ProductInformation
    where ProductInformation.ProductUniqueNumber = (
    SELECT ProductList.ProductUniqueNumber
    from 
    ProductList
    join 
    MemberInformation 
    on 
    MemberInformation.account = ProductList.account 
    join 
    ProductTransactionStatus 
    on 
    ProductTransactionStatus.ProductUniqueNumber = ProductList.ProductUniqueNumber 
    join
    ProductInformation
    on
    ProductList.ProductUniqueNumber = ProductInformation.ProductUniqueNumber
    where 
    MemberInformation.account = '$my_account' 
    and 
    ProductTransactionStatus.status = 'before')";

$sql2 = "DELETE 
    from ProductTransactionStatus
    where ProductTransactionStatus.ProductUniqueNumber = (
    SELECT ProductList.ProductUniqueNumber
    from 
    ProductList
    join 
    MemberInformation 
    on 
    MemberInformation.account = ProductList.account 
    join 
    ProductTransactionStatus 
    on 
    ProductTransactionStatus.ProductUniqueNumber = ProductList.ProductUniqueNumber 
    where 
    MemberInformation.account = '$my_account' 
    and 
    ProductTransactionStatus.status = 'before')";

$sql3 = "DELETE 
        from ProductList
        where ProductList.account = (
        SELECT MemberInformation.account
        from 
        MemberInformation 
        where 
        MemberInformation.account = '$my_account')";

$sql4 = "DELETE
        FROM MemberInformation
        WHERE MemberInformation.account = '$my_account'";

$ret1 = oci_execute(oci_parse($con, $sql1));
$ret2 = oci_execute(oci_parse($con, $sql2));
$ret3 = oci_execute(oci_parse($con, $sql3));
$ret4 = oci_execute(oci_parse($con, $sql4));

if ($ret1 && $ret2 && $ret3 && $ret4) {
    oci_commit($con);
    oci_close($con);
    session_destroy();
    echo "<script>alert('계정이 성공적으로 삭제되었습니다!');
        location.href='./login_and_createAccount.php'
        </script>";
} else {
    
    echo "Error.";
}