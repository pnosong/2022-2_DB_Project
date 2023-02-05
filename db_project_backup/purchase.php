<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];
$my_name = $_SESSION["name"];
$my_nickname = $_SESSION["nickname"];
$my_Email = $_SESSION["Email"];
$my_sex = $_SESSION["sex"];
$my_phonenumber = $_SESSION["phonenumber"];
$my_birthday = $_SESSION["birthday"];
$my_pid = $_POST["pid"];

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
        SET BUYER = '$my_account'
        WHERE ProductUniqueNumber = $my_pid";
$stat = oci_parse($con, $sql1);  
$ret = oci_execute($stat);
if (!$ret) {
    echo "<br/>";
    echo "데이터 갱신 실패";
    echo "<br/>";
}

$sql2 = "UPDATE ProductTransactionStatus
        SET status = 'after'
        WHERE ProductUniqueNumber = $my_pid";
$stat = oci_parse($con, $sql2);  
$ret = oci_execute($stat);
if (!$ret) {
    echo "<br/>";
    echo "데이터 갱신 실패";
    echo "<br/>";
}

oci_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구매 완료</title>
</head>
<body>
    <h1>구매완료!</h1>
    <form method="POST" action="PurchaseHistory.php">
        <input type=submit value=구매내역>
    </form>
</body>
</html>