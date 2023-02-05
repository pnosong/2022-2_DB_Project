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

    $account = $_POST["account"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $nickname = $_POST["nickname"];

    $sql = "insert into MEMBERINFORMATION (account, password, name, nickname) values ('".$account."','".$password."','".$name."','".$nickname."')";
    $ret = oci_execute(oci_parse($con, $sql));

    if($ret){
        echo "데이터 입력 성공";
    }
    else{
        echo "데이터 입력 실패";
    }

    oci_close($con);


