<?php
session_start();
$my_account = $_SESSION["account"];
include_once 'db_connect.php';

// 사진데이터 처리
$file_name = $_FILES['photo']['name'];
$tmp_file = $_FILES['photo']['tmp_name'];
$file_path = './img/' . $file_name;
move_uploaded_file($tmp_file, $file_path);
// echo "img폴더에 상품사진 등록 완료";

$title = $_POST["title"];
$price = $_POST["price"];
$content = $_POST["content"];
$photo = $file_name;

$sql = "insert all into ProductInformation (ProductUniqueNumber, title, price, content, photo) values (PUN.NEXTVAL,'$title','$price','$content','$photo') INTO ProductList (ProductUniqueNumber, account) values (PUN.NEXTVAL, '$my_account')  INTO ProductTransactionStatus (ProductUniqueNumber, status) values (PUN.NEXTVAL, 'before') SELECT * FROM DUAL";
$ret = oci_execute(oci_parse($con, $sql));

oci_close($con);
echo "<script>alert('Your item has been successfully registered!');
        location.href='./mypage.php'
        </script>";
