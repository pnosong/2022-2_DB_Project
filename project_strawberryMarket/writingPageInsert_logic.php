<?php
session_start();
$my_account = $_SESSION["account"];
include_once 'db_connect.php';

$title = $_POST["title"];
$price = $_POST["price"];
$content = $_POST["content"];
$file_name = $_FILES['photo']['name'];
$photo = $file_name;

$sql = "insert all into ProductInformation (ProductUniqueNumber, title, price, content, photo) values (PUN.NEXTVAL,'$title','$price','$content','$photo') INTO ProductList (ProductUniqueNumber, account) values (PUN.NEXTVAL, '$my_account')  INTO ProductTransactionStatus (ProductUniqueNumber, status) values (PUN.NEXTVAL, 'before') SELECT * FROM DUAL";
$ret = oci_execute(oci_parse($con, $sql));

$sql2 = "SELECT PUN.CURRVAL FROM DUAL";
$stat2 = oci_parse($con, $sql2);
$ret2 = oci_execute($stat2);

while(($row = oci_fetch_array($stat2)) != false){
    $ProductUniqueNumber = $row[0];
}

// 사진데이터 처리
$upload_file_name = $ProductUniqueNumber."_".$file_name;
$tmp_file = $_FILES['photo']['tmp_name'];
$file_path = './img/' . $upload_file_name;
move_uploaded_file($tmp_file, $file_path);
// echo "img폴더에 상품사진 등록 완료";


oci_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <form name="productInformation" method="post" action="productInformation.php">
        <input type="hidden" name="ProductUniqueNumber" value= '<?php echo $ProductUniqueNumber;?>'>
    </form>
    <script>alert('Your item has been successfully registered!');
        document.productInformation.submit();
    </script>;
</body>
</html>

