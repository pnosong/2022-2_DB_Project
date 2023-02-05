<?php
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
    echo "디비 연결 성공";




    $TITLE = $_POST["TITLE"];
    $PRICE = $_POST["PRICE"];
    $CONTENT = $_POST["CONTENT"];
    $PHOTO = $_POST["PHOTO"];

    $sql = "insert into ProductInformation (ProductUniqueNumber, TITLE, PRICE, CONTENT, PHOTO) values (PUN.NEXTVAL,'$TITLE','$PRICE','$CONTENT','$PHOTO')";
    $ret = oci_execute(oci_parse($con, $sql));

    if($ret){
        echo "데이터 입력 성공";
    }
    else{
        echo "데이터 입력 실패";
    }

    oci_close($con);