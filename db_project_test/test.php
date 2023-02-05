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


// 조회
$sql = "select * from S";
$stat = oci_parse($con, $sql);
$ret = oci_execute($stat);

if ($ret) {
    echo "<br/>";
    echo "데이터 조회 완료";
    echo "<br/>";
} else {
    echo "<br/>";
    echo "데이터 조회 실패";
    echo "<br/>";
}

while (($row = oci_fetch_array($stat)) != false) {
    echo $row['S#'], " ", $row['SNAME'], " ", $row['STATUS'], " ", $row["CITY"], "<br>";
}


// // 삽입
// $sql2 = "insert into S (S#,SNAME,STATUS,CITY) values ('S6','Homin',50,'Seoul')";
// $ret2=oci_execute(oci_parse($con,$sql2));

// if($ret2){
//     echo "<br/>";
//     echo "데이터 입력 완료";
//     echo "<br/>";
// }else{
//     echo "<br/>";
//     echo "데이터 입력 실패";
//     echo "<br/>";
// }


// // 삭제
// $sql3 = "delete from S where SNAME='Homin'";
// $ret3=oci_execute(oci_parse($con,$sql3));

// if($ret3){
//     echo "<br/>";
//     echo "데이터 삭제 완료";
//     echo "<br/>";
// }else{
//     echo "<br/>";
//     echo "데이터 삭제 실패";
//     echo "<br/>";
// }


// 수정
$sql4 = "update S set SNAME='Homin2' where SNAME='Homin'";
$ret4=oci_execute(oci_parse($con,$sql4));

if($ret4){
    echo "<br/>";
    echo "데이터 수정 완료";
    echo "<br/>";
}else{
    echo "<br/>";
    echo "데이터 수정 실패";
    echo "<br/>";
}

oci_close($con);
