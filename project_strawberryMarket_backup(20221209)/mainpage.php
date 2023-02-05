<?php
session_start();
$my_account = $_SESSION["account"];
if (isset($_SESSION["account"]) == false) {
  echo "<script>alert('You need to login.');
        location.href='./login_and_createAccount.php'
        </script>";
}
$my_password = $_SESSION["password"];
$my_name = $_SESSION["name"];
$my_nickname = $_SESSION["nickname"];
$my_Email = $_SESSION["Email"];
$my_sex = $_SESSION["sex"];
$my_phonenumber = $_SESSION["phonenumber"];
$my_birthday = $_SESSION["birthday"];
include_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/headerstyle.css" />
  <link rel="stylesheet" href="css/bodystyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인 메인</title>
</head>

<body>
  <header>
    <div class="head">
      <div class="header__inner">
        <a href="mainpage.php">
          <img src="./img/Strawberry MarketLogo2.png" />
        </a>
        <?php
        echo $my_nickname, "님, 환영합니다.";
        ?>
        <div class="search">
          <form action="search_logic.php" method="post" class="search__from">
            <input class=search__input type="text" name="search" placeholder="물품명을 검색해보세요!">
            <button class="search__button" type="submit">
              <img src="./img/search-icon.svg" />
            </button>
          </form>
        </div>
        <div class="buttons2">
          <div class="buttons-chat">
            <form method="post" action="logout.php">
              <input class="buttons-chat__button" value="로그아웃" type="submit">
            </form>
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="마이페이지" onClick="location.href='mypage.php'">
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="상품등록" onClick="location.href='writingPageInsert.php'">
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="개인정보" onClick="location.href='privacy.php'">
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="mid">
    <div class="table__">
      <div class="table__body">
        <h2>올라온 물품</h2>
        <a></a><a></a>
        <?php
        // 거래전인 상품 정보 뽑아오기
        $sql = "SELECT 
  ProductInformation.ProductUniqueNumber as PUN, 
  ProductInformation.title as t, 
  ProductInformation.content as c, 
  ProductInformation.price as p, 
  ProductInformation.photo as ph, 
  ProductList.account as a,
  MemberInformation.nickname as n
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
  join 
  MemberInformation 
  on 
  MemberInformation.account = ProductList.account 
  where 
  ProductTransactionStatus.status = 'before'";
        $stat = oci_parse($con, $sql);
        $ret = oci_execute($stat);

        $i = 0;
        while (($row = oci_fetch_array($stat)) == TRUE) {
          // 수정된 부분
          $photoName = $row['PH'];
          if ($i == 0) {
            $i = 1;
          }
          echo "<form class='block' method = 'POST' action = 'productInformation.php'>";
          echo "<div class='submit__Container'>";
          echo "<div class='photo'>";
          echo "<img class='size' src='./img/$photoName'>";
          echo "</div>";
          echo "<div class='info'>";
          echo "<div class='title'>";
          echo "<span>", $row['T'], "</span>";
          echo "</div>";
          echo "<div class='nickname'>";
          echo "$row[N]";
          echo "</div>";
          echo "<div class='price'>";
          echo "$row[P]", "₩";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "<input type='hidden' name='ProductUniqueNumber' value='$row[0]'>";
          echo "<input class='submit__button'type='submit' value=''>";
          echo "</form>";
        }
        if ($i == 0) {
          echo "판매중인 목록이 없습니다.";
        }
        oci_close($con);
        ?>
      </div>
    </div>
  </div>
</body>

</html>