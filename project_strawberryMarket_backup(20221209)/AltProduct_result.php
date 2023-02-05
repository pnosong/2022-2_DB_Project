<?php
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
    $Alt_Number = $_POST["Alt_Number"];
    $Del_Number1 = $_POST['Del_Number'];


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


    $file_name = $_FILES['photo']['name'];
    $tmp_file = $_FILES['photo']['tmp_name'];
    $file_path='./img/'.$file_name;
    move_uploaded_file($tmp_file, $file_path);

    $PHOTO = $file_name;
    $TITLE = $_POST["title"];
    $PRICE = $_POST["price"];
    $CONTENT = $_POST["content"];
    




    


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