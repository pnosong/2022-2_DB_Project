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


    $src = $_POST["productinfo"];
    $check = $_POST["select"];
 
    if($check=="TITLE"){
      $sql = oci_parse($con,"SELECT * FROM ProductInformation WHERE TITLE like  '%$src%' order by ProductUniqueNumber");
      oci_execute($sql);
    }
    else if($check=="CONTENT"){
      $sql = oci_parse($con,"SELECT * FROM ProductInformation WHERE CONTENT like '%$src%' order by ProductUniqueNumber");
      oci_execute($sql);
    }

   oci_free_statement($sql);
   oci_close($con);