<?php
session_start();
$my_account = $_SESSION["account"];

    $db = '
    (DESCRIPTION =
            (ADDRESS_LIST=
                    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
            )
            (CONNECT_DATA =
            (SID = orcl)
            )
    )';
    //enter user name & password
    //connect with oracle_db
    $con = oci_connect("DBA2022G3", "test1234", $db);
    if (!$con) {
        echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
        exit();
    }
    echo "디비 연결 성공", "<br>";



    // 사진데이터 처리
    $file_name = $_FILES['photo']['name'];
    $tmp_file = $_FILES['photo']['tmp_name'];
    $file_path='./img/'.$file_name;
    move_uploaded_file($tmp_file, $file_path);
    // echo "img폴더에 상품사진 등록 완료";

    // $sql = "insert into ProductInformation (IMG) values ('$file_name')";
    // $ret = oci_execute(oci_parse($con, $sql));



    $title = $_POST["title"];
    $price = $_POST["price"];
    $content = $_POST["content"];
    $photo = $file_name;

    $sql = "insert all into ProductInformation (ProductUniqueNumber, title, price, content, photo) values (PUN.NEXTVAL,'$title','$price','$content','$photo') INTO ProductList (ProductUniqueNumber, account) values (PUN.NEXTVAL, '$my_account')  INTO ProductTransactionStatus (ProductUniqueNumber, status) values (PUN.NEXTVAL, 'before') SELECT * FROM DUAL";
    $ret = oci_execute(oci_parse($con, $sql));

    // if($ret){
    //     echo "데이터 입력 성공";
    // }
    // else{
    //     echo "데이터 입력 실패";
    // }

    oci_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="content-type" content="text/html"; charset="utf-8">
</head>
<body>
    <h1>등록된 상품 정보</h1>
    <?php
    echo "상품 제목 : ", $title, "<br>";
    echo "상품 가격 : ", $price, "<br>";
    echo "상품 내용 : ", $content, "<br>";
    echo "상품 사진", "<br>";
    echo "<img src='img/$file_name'> <br>";
    ?>

    <a href="WritingPageInsert.php"> 글쓰기 </a> <br><br> 
    <a href="loginmain.php"> 메인페이지 </a> <br><br> 
</body>
</html>
</html>