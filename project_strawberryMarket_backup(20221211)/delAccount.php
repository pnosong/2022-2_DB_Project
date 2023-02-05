<?php
error_reporting(E_ALL & ~E_WARNING);
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];
$my_nickname = $_SESSION["nickname"];

$check_account = $_POST['check_account'];
$check_password = $_POST['check_password'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>랜딩페이지</title>
    <link rel="stylesheet" href="css/headerstyle.css" />
    <link rel="stylesheet" href="css/bodystyle.css" />
    <link rel="stylesheet" href="css/privacybuttonstyle.css" />
    <link rel="stylesheet" href="css/privacytablestyle.css" />
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
        <h1 class="h1head"><?php echo $my_nickname; ?> 님의 회원탈퇴</h1>

        <form method="post" action="delAccount.php">
            <table>
                <tr>
                    <th><strong>아이디 확인</strong></th>
                    <td><input type="text" placeholder="아이디" name="check_account" required="required"> <br></td>
                </tr>
                <tr>
                    <th><strong>비밀번호 확인</strong></th>
                    <td><input type="text" placeholder="비밀번호" name="check_password" required="required"> <br></td>
                </tr>
            </table>
            <footer class="footer__inner">
                <div class="buttons2">
                    <div class="buttons-chat">
                        <input class="buttons-chat__button" type="submit" value="회원탈퇴">
                    </div>
                    <div class="buttons-chat">
                        <input class="buttons-chat__button" type="button" value="탈퇴취소" onClick="location.href='privacy.php'">
                    </div>
                </div>
        </form>
    </div>


    <?php
    if ( !is_null( $check_account ) && !is_null($check_password)){
      if ( $my_account == $check_account ) { 
                  if($my_password == $check_password){
                      header('Location: delAccount_logic.php');
                  }
                  else {
                      $wp = 1;
                      oci_close($con);
                  }
              }
              else {
                  $wa = 1;
                  oci_close($con);
              }
          } 



    ?>

    <?php
    if ($wa == 1) {
        echo "<script>
                alert('아이디가 틀렸습니다.');
              </script>";
    }
    if ($wp == 1) {
        echo "<script>alert('비밀번호가 틀렸습니다.');</script>";
    }
    ?>
</body>

</html>