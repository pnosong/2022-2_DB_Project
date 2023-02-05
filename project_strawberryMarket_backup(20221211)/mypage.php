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
    <title>마이페이지</title>
</head>
<body>
  <header>
    <div class="head">
      <div class="header__inner">
        <a href="mainpage.php">
          <img src="./img/Strawberry MarketLogo2.png"/>
        </a>
        <?php
        echo $my_nickname, "님, 환영합니다.";
        ?>
        <div class="search">
          <form action="search_logic.php" method="post" class="search__from">
            <input class=search__input type="text" name="search" placeholder="물품명을 검색해보세요!">
            <button class="search__button" type="submit">
              <img src="./img/search-icon.svg"/>
            </button>
          </form>
        </div>
        <div class="buttons2">
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="판매내역" onClick="location.href='salesDetails.php'"> 
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="구매내역" onClick="location.href='purchaseHistory.php'"> 
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="개인정보" onClick="location.href='privacy.php'"> 
          </div>
          <div class="buttons-chat">
            <form method="post" action="logout.php">
              <input class="buttons-chat__button" value="로그아웃" type="submit"> 
            </form> 
          </div>
        </div>
      </div>
    </div>
  </header>
<div class="mid" >
<div class="table__" >
<div class="table__body" >
<h2>나의 판매중인 목록</h2>
<a></a><a></a>
<?php  
    $sql = "SELECT 
    ProductInformation.ProductUniqueNumber as re, 
    ProductInformation.title as t, 
    ProductInformation.content as c, 
    ProductInformation.price as p, 
    ProductInformation.photo as ph 
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
    ProductList.account = '$my_account' 
    and 
    ProductTransactionStatus.status = 'before'";
    $stat = oci_parse($con, $sql);
    $ret = oci_execute($stat);
    if (!$ret) {
        echo "데이터 조회 실패";
    }

    $i=0;
    while (($row = oci_fetch_array($stat)) == TRUE) 
    {
      if ($i == 0){$i = 1;}
      $photoName = $row[0]."_".$row['PH'];
      echo "<form class='block' method = 'POST' action = 'productInformation.php'>";
      echo "<div class='submit__Container'>";
      echo "<div class='photo'>";
      echo "<img class='size' src='./img/$photoName'>";
      echo "</div>";
      echo "<div class='info'>";
      echo "<div class='title'>";
      echo "<span>", $row['T'],"</span>";
      echo "</div>";
      echo "<div class='price'>";
      echo "$row[P]","₩";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "<input type='hidden' name='ProductUniqueNumber' value='$row[0]'>";
      echo "<input class='submit__button'type='submit' value=''>";
      echo "</form>";
      $i=1;
    }
    if($i==0)
    {
        echo "판매중인 목록이 없습니다.";
    }
    oci_close($con);
  ?>
</div>
</div>
</div>
</body>
</html>