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
$ProductUniqueNumber = $_POST["ProductUniqueNumber"];
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
            <input class=search__input type="text" name="search" placeholder="물품명을 검색해보세요!" required>
            <button class="search__button" type="submit">
              <img src="./img/search-icon.svg"/>
            </button>
          </form>
        </div>
        <div class="buttons2">
          <div class="buttons-chat">
            <form class="buttons-chat__button" method="post" action="mainpage.php">
              <input class="buttons-chat__button" value="로그아웃" type="submit"> 
            </form> 
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="마이페이지" onClick="location.href='mypage.php'"> 
          </div>
          <div class="buttons-chat">
            <input class="buttons-chat__button" type="button" value="글쓰기" onClick="location.href='writingPageInsert.php'"> 
          </div>
        </div>
      </div>
    </div>
  </header>
<div class="mid" >
<div class="table__" >
<a></a>
<?php
$sql = "SELECT 
ProductInformation.ProductUniqueNumber as PUN, 
ProductInformation.title as t, 
ProductInformation.content as c, 
ProductInformation.price as p, 
ProductInformation.photo as ph,
ProductTransactionStatus.status as s,  
ProductList.account as a,
MemberInformation.nickname as n
from 
ProductInformation 
join 
ProductTransactionStatus 
on 
ProductInformation.ProductUniqueNumber = ProductTransactionStatus.ProductUniqueNumber
join 
ProductList 
on 
ProductInformation.ProductUniqueNumber = ProductList.ProductUniqueNumber 
join 
MemberInformation 
on 
MemberInformation.account = ProductList.account 
where 
ProductList.ProductUniqueNumber = $ProductUniqueNumber";
  $stat = oci_parse($con, $sql);  
  $ret = oci_execute($stat);
  if (!$ret) {
    echo "데이터 조회 실패";
  }
  $i=0;
  while (($row = oci_fetch_array($stat)) == TRUE) {
  // 수정된 부분
  $photoName = $ProductUniqueNumber."_".$row['PH'];
  if ($i == 0){$i = 1;}

    echo "<div class='table__img' >";
      echo "<img class='size' src='./img/$photoName'>";
    echo "</div>";
    
  echo "<div class='table__box'>";

    echo "<form action='search_logic.php' method='post' class='profile__info'>";
      echo "<div style='position:absolute;'>";
        echo "<img class='profile' src='./logo/profile.png'>";
        echo "<span class='nickname'>";
          echo "$row[N]";
        echo "</span>";
      echo "</div>";

      echo "<input type='hidden' name='search' value = $row[N]>";
      echo "<input type='submit'class='profile__submit' value =''>";

    echo "</form>";

    echo "<div class='table__content'>";
      echo "<div class='title__info'>";
        echo "<span class='title'>";
          echo $row['T'];
        echo "</span>";
        echo "<span class='price'>";
        echo $row['P'];
        echo "₩","</span>";
      echo "</div>";
      echo "<p class='content'>";
        echo $row['C'];
      echo "</p>";
      echo "<div class='submit__info'>";
      if($row['S'] == 'after'){
        if($my_account == $row['A']){
          echo "<form class='submit__' method='post' action='pur_cancel_logic.php'>";
            echo "<input type='hidden' name='ProductUniqueNumber' value = $row[0]>";
            echo "<input type='hidden'class='submit__' value='환불' type='submit'>";
          echo "</form>";
        }else{
          echo "<form class='submit__' method='post' action='pur_cancel_logic.php'>";
            echo "<input type='hidden' name='ProductUniqueNumber' value = $row[0]>";
            echo "<input class='submit__' value='반품' type='submit'>";
          echo "</form>";
        }
      }else{
        if($my_account == $row['A']){
          echo "<form method='post' action='altProduct.php'>";
            echo "<input type='hidden' name='ProductUniqueNumber' value = $row[0]>";
            echo "<input class='submit__' value='수정' type='submit'>";
          echo "</form>";
          echo "<form method='post' action='delProduct_logic.php'>";
            echo "<input type='hidden' name='ProductUniqueNumber' value = $row[0]>";
            echo "<input class='submit__' value='삭제' type='submit'>";
          echo "</form>";
        }else{
          echo "<form class='submit__' method='post' action='purchase_logic.php'>";
            echo "<input type='hidden' name='ProductUniqueNumber' value = $row[0]>";
            echo "<input class='submit__' value='구매' type='submit'>";
          echo "</form>";
        }
      }
      echo "</div>";
    echo "</div>";
  echo "</div>";

  }
  if ($i == 0){echo "물건없음";}
?>
</div>    
</div>
</div>