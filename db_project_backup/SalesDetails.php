<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];
$my_name = $_SESSION["name"];
$my_nickname = $_SESSION["nickname"];
$my_Email = $_SESSION["Email"];
$my_sex = $_SESSION["sex"];
$my_phonenumber = $_SESSION["phonenumber"];

$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';

$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form method="post" action="logout.php">
        <input type="submit" value="로그아웃">
    </form>
    <form method="post" action="mypage.php">
        <input type="submit" value="마이페이지">
    </form>
    <h1>[<?php echo $my_nickname; ?>]님의 판매내역입니다.</h1>
    <?php
    $sql = "SELECT ProductInformation.title, ProductInformation.content, ProductInformation.price, ProductInformation.photo FROM ProductInformation join ProductList on ProductInformation.ProductUniqueNumber = ProductList.ProductUniqueNumber join ProductTransactionStatus on ProductInformation.ProductUniqueNumber = ProductTransactionStatus.ProductUniqueNumber WHERE ProductList.account = '$my_account'and ProductTransactionStatus.status = 'after'";
    $stat = oci_parse($con, $sql);
    $ret = oci_execute($stat);

    if (!$ret) {
        echo "<br/>";
        echo "데이터 조회 실패";
        echo "<br/>";
    }

    $i=0;
    while (($row = oci_fetch_array($stat)) == TRUE) 
    {
        $photoName = $row['PHOTO'];

        if ($i == 0)
        {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td><strong>", "제목", "</strong></td>", "<td><strong>", "사진", "</strong></td>", "<td><strong>", "설명", "</strong></td>", "<td><strong>", "가격", "</strong></td>";
            echo "</tr>";
            $i = 1;
        }
        echo "<tr>";
        echo "<td>", $row['TITLE'], "</td>";
        echo "<td><img src='./img/$photoName'></td>";
        echo "<td>", $row['CONTENT'], "</td>";
        echo "<td>", $row['PRICE'], "</td>";
        echo "</tr>";
    }
    if ($i == 1)
    {
        echo "</table>";
    }
    else
    {
        echo "판매내역이 없습니다.";
    }
    oci_close($con);
    ?>
</body>
</html>