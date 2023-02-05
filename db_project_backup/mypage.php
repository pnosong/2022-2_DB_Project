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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>랜딩페이지</title>
    <style>
        h1 {text-align: center;}
        form {text-align: center;}
    </style>
</head>
<body>
    <h1>[<?php echo $my_nickname; ?>]님의 마이 페이지</h1>
    <form method="post" action="logout.php">
        <input type="submit" value="로그아웃">
    </form>
    <form method="post" action="SalesDetails.php">
        <input type="submit" value="판매내역">
    </form>
    <form method="post" action="PurchaseHistory.php">
        <input type="submit" value="구매내역">
    </form>
    <form method="post" action="Privacy.php">
        <input type="submit" value="개인정보">
    </form>
    <form method="post" action="loginmain.php">
        <input type="submit" value="메인페이지">
    </form>

    <h2>판매중인 상품</h2>
    <?php
    $db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';
    $con = oci_connect("DBA2022G3", "test1234", $db);
    if (!$con) 
    {
        echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
        exit();
    }

    $sql = "SELECT ProductInformation.ProductUniqueNumber as re, ProductInformation.title as t, ProductInformation.content as c, ProductInformation.price as p, ProductInformation.photo as ph from ProductInformation join ProductList on ProductInformation.ProductUniqueNumber = ProductList.ProductUniqueNumber join ProductTransactionStatus on ProductInformation.ProductUniqueNumber = ProductTransactionStatus.ProductUniqueNumber where ProductList.account = '$my_account' and ProductTransactionStatus.status = 'before'";
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
        $file_name = $row['PH'];
        if ($i == 0)
        {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td><strong>", "제목", "</strong></td>", "<td><strong>", "사진", "</strong></td>", "<td><strong>", "설명", "</strong></td>", "<td><strong>", "가격", "</strong></td>", "<td><strong>", "수정", "</strong></td>", "<td><strong>", "삭제", "</strong></td>";
            echo "</tr>";
            $i = 1;
        }
        echo "<tr>";
        echo "<td>", $row['T'], "</td>";
        echo "<td><img src='img/$file_name'></td>";
        echo "<td>", $row['C'], "</td>";
        echo "<td>", $row['P'], "</td>";
        echo "<td>";
        echo "<form method='post' action='AltProduct.php'><input type='hidden' name='Alt_Product_ProductUniqueNumber' value=", $row[0] ,"><input type='submit' value='수정'></form>";
        echo "</td>";
        echo "<td>";
        echo "<form method='post' action='DelProduct.php'><input type='hidden' name='Del_Product_ProductUniqueNumber' value=", $row[0] ,"><input type='hidden' name='Del_Product_PHOTO' value=", $row[4] ,"><input type='submit' value='삭제'></form>";
        echo "</td>";  
        echo "</tr>";
    }
    if ($i == 1)
    {
        echo "</table>";
    }
    else
    {
        echo "판매중인 목록이 없습니다.";
    }
    oci_close($con);
    ?>

</body>
</html>