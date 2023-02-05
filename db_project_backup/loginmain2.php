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
    <link rel="daangn icon" href="./img/logo.ico" />
    <link rel="stylesheet" href="./headerstyle.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 메인</title>

    
</head>
<body>
<header>
      <div class="header__inner">
        <img src="./img/logo-basic.svg" alt="daangn-logo" />
        <div class="search">
          <input
            type="text"
            name="header-search-input"
            class="search__input"
            placeholder="물품명을 검색해보세요!"
          />
          <button class="search__button">
            <img src="./img/search-icon.svg" alt="daangn-search" />
          </button>
        </div>
        <div class="buttons">
          <div class="buttons-chat">
            <form method="post" action="logout.php">
                <input class="buttons-chat__button2" type="button" value="로그아웃" type="submit"> 
            </form> 
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="마이페이지" onClick="location.href='mypage.php'"> 
          </div>
        </div>
      </div>
    </header>

    <form method="post" action="logout.php">
        <input type="submit" value="로그아웃">
    </form>
    <h1><?php echo $my_nickname; ?>님의</h1>
    <h1>메인 페이지</h1>
    <a href="mypage.php">마이페이지</a><br><br>
    <a href="writingpage.html"> 중고거래 글쓰기 </a> <br><br>
    <a href="search_result.html"> 검색하러가기 </a> <br><br>

    <h2>올라온 물품</h2>
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
    
    // 거래전인 상품 정보 뽑아오기
    $sql = "SELECT 
    ProductInformation.ProductUniqueNumber as PUN, 
    ProductInformation.title as t, 
    ProductInformation.content as c, 
    ProductInformation.price as p, 
    ProductInformation.photo as ph, 
    ProductList.account as a
    from 
    ProductInformation 
    join 
    ProductList 
    on 
    ProductInformation.ProductUniqueNumber = ProductList.ProductUniqueNumber 
    join 
    ProductTransactionStatus 
    on 
    ProductInformation.ProductUniqueNumber = ProductTransactionStatus.ProductUniqueNumber 
    where 
    ProductTransactionStatus.status = 'before'";
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
        // 수정된 부분
        $photoName = $row['PH'];

        if ($i == 0)
        {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td><strong>", "제목", "</strong></td>", 
                "<td><strong>", "설명", "</strong></td>", 
                "<td><strong>", "사진", "</strong></td>", 
                "<td><strong>", "구매&수정", "</strong></td>";
            echo "</tr>";
            $i = 1;
        }

        if ($row['A'] != $my_account)
        {
            echo "<tr>";
            echo "<td>$row[T]</td>";
            echo "<td>$row[C]</td>";
            echo "<td><img src='./img/$photoName'></td>";
            echo("<td>
            <form method = post action=purchase.php>
                <input type=hidden name=pid value =$row[0]>
                <input type=submit value=구매하기>
            </form>
            </td>");
            echo "</tr>";
        }
        else
        {
            echo "<tr>";
            echo "<td>$row[T]</td>";
            echo "<td>$row[C]</td>";
            echo "<td><img src='./img/$photoName'></td>";
            echo ("<td>
            <form method='post' action='AltProduct.php'>
                <input type='hidden' name='Alt_Product_ProductUniqueNumber' value= $row[0]>
                <input type='submit' value='수정하기'>
            </form>
            </td>");
            echo "</tr>";
        }
    }
    oci_close($con);
    ?>
</body>
</html>