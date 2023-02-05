<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품페이지</title>
</head>
<body>
    <div>
        <a href="">마이페이지</a>
        <a href="WritingPageInsert.php">상품 추가</a>
    </div>
    
<!-- DB연동 후 상품 테이블 정보 가져와서 화면 표시 -->
    <?php
    // oracle DB 서버
    $db = '
    (DESCRIPTION =
            (ADDRESS_LIST=
                    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
            )
            (CONNECT_DATA =
            (SID = orcl)
            )
    )';

    $con = oci_connect("DBA2022G3", "test1234", $db);
        if (!$con) {
            echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
            exit();
        }

    $sql = "select * from ProductInformation";
    // sql문 준비
    $stat = oci_parse($con, $sql);  
    // sql문 실행
    $ret = oci_execute($stat);

    if (!$ret) {
        echo "<br/>";
        echo "데이터 조회 실패";
        echo "<br/>";
    }

    // query를 통해 나온 행들 row에 저장
    while (($row = oci_fetch_array($stat)) == TRUE) {
        echo $row['PHOTO'], " ", $row['CONTENT'], " ", $row['PRICE'], "<p>";
    }

    oci_close($con);
    ?>
</body>
</html>