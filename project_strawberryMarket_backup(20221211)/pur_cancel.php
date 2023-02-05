<?php
$cancel_pid = $_POST['cancel'];

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

$sql1 = "UPDATE ProductTransactionStatus
        SET BUYER = null
        WHERE ProductUniqueNumber = $cancel_pid";
$stat1 = oci_parse($con, $sql1);  
$ret1 = oci_execute($stat1);

$sql2 = "UPDATE ProductTransactionStatus
        SET status = 'before'
        WHERE ProductUniqueNumber = $cancel_pid";
$stat2 = oci_parse($con, $sql2);  
$ret2 = oci_execute($stat2);
if (!$ret1 || !$ret2) {
    echo "<br/>";
    echo "데이터 갱신 실패";
    echo "<br/>";
}
else if($ret1 && $ret2){
    header('Location: PurchaseHistory.php');
}

oci_close($con);
?>