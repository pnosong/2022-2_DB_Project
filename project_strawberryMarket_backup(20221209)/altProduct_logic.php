<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];

$Alt_Number = $_POST["ProductUniqueNumber"];

$TITLE = $_POST["title"];
$PRICE = $_POST["price"];
$CONTENT = $_POST["content"];

$file_name = $_FILES['photo']['name'];
$tmp_file = $_FILES['photo']['tmp_name'];


include_once 'db_connect.php';
 
    $sql2 = "select TITLE, PHOTO, PRICE, CONTENT from ProductInformation where ProductUniqueNumber = '$Alt_Number'";
    $stat = oci_parse($con, $sql2);
    $ret = oci_execute($stat);
    $row = oci_fetch_array($stat);

    if($TITLE == NULL){                     //제목을 안받은 경우
        $TITLE =  $row['TITLE'];
    }
    if($PRICE == NULL){                     //가격을 안받은 경우
        $PRICE =  $row['PRICE'];
    }
    if($CONTENT == NULL){                   //내용을 안받은 경우
        $CONTENT =  $row['CONTENT'];
    }
    if($file_name == NULL){                 //파일을 안받은 경우
        $PHOTO =  $row['PHOTO'];
    }else{
        $photoName = $row['PHOTO'];

        echo $photoName , "<br>";
        $total_photoName = './img/'.$photoName;
        echo $total_photoName, "<br>";
        if(file_exists($total_photoName)){
        unlink($total_photoName);
        echo "img 폴더에서 파일삭제 성공";
        }else{
        echo "img 폴더에서 파일삭제 실패";
        }
    
        $file_path='./img/'.$file_name;
        move_uploaded_file($tmp_file, $file_path);
    
        $PHOTO = $file_name;
    }

$sql = "UPDATE ProductInformation  SET PHOTO = '$PHOTO', TITLE = '$TITLE', PRICE = '$PRICE', CONTENT = '$CONTENT' WHERE ProductUniqueNumber = '$Alt_Number'";
$ret = oci_execute(oci_parse($con, $sql));

if($ret)  
{  
    oci_commit($con);
    oci_close($con);
    echo "데이터 변경 성공<br>";
    header('Location: mainpage.php');
}
else
{
    echo "Error.";
}
/* */
?>