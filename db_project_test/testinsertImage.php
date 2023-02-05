<?php
$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';

$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
echo "디비 연결 성공<br>";




// ----------- 사진데이터 img 폴더와 db에 등록
$file_name = $_FILES['img_test']['name'];
$tmp_file = $_FILES['img_test']['tmp_name'];
$file_path='img/'.$file_name;
move_uploaded_file($tmp_file, $file_path);
echo "상품사진 img폴더에 등록 완료" , "<br>";


$sql = "insert into IMGTEST (IMG) values ('$file_name')";
$ret = oci_execute(oci_parse($con, $sql));

if($ret){
    echo "데이터 입력 성공", "<br>";
}
else{
    echo "데이터 입력 실패", "<br>";
}


// ------------- 프론트에서 보여주기
// $sql2 = "select IMG from IMGTEST where IMG='cat_test.jpeg'";
// $stat = oci_parse($con, $sql2);
// $ret = oci_execute($stat);

// while(($row = oci_fetch_array($stat)) != false){
//     $photoName = $row['IMG'];
// }

// echo $photoName, "<br>";





// ----------- 사진데이터 img폴더에서 삭제

$sql2 = "select IMG from IMGTEST where IMG='cat_test.jpeg'";
$stat = oci_parse($con, $sql2);
$ret = oci_execute($stat);

while(($row = oci_fetch_array($stat)) != false){
    $photoName = $row['IMG'];
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





oci_close($con);



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
    <?php
    // echo "<img src='img/$photoName' alt='사진'> <br>"
    ?>

</body>
</html>

