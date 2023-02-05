<?php
$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';

$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
echo "디비 연결 성공<br>";




// echo $_FILES;
$file_name = $_FILES['img_test']['name'];
$tmp_file = $_FILES['img_test']['tmp_name'];
$file_path='img/'.$file_name;
move_uploaded_file($tmp_file, $file_path);
move_uploaded_file($_FILES['img_test']['tmp_name'], $file_path);
echo "상품사진 img폴더에 등록 완료";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="img/cat_test.jpeg">
</body>
</html>