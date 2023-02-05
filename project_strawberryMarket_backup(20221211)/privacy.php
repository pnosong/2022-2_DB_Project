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
                        <input class="buttons-chat__button" type="button" value="마이페이지" onClick="location.href='mypage.php'">
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

    <div class="mid">
        <h1 class="h1head"><?php echo $my_nickname; ?> 님의 개인정보</h1>
        <table>
            <tr>
                <th><strong>아이디</strong></th>
                <td><?php echo $my_account; ?></td>
            </tr>
            <tr>
                <th><strong>비밀번호</strong></th>
                <td><?php echo $my_password; ?></td>
            </tr>
            <tr>
                <th><strong>이름</strong></th>
                <td><?php echo $my_name; ?></td>
            </tr>
            <tr>
                <th><strong>별명</strong></th>
                <td><?php echo $my_nickname; ?></td>
            </tr>
            <tr>
                <th><strong>이메일</strong></th>
                <td><?php echo $my_Email; ?></td>
            </tr>
            <tr>
                <th><strong>성별</strong></th>
                <td><?php echo $my_sex; ?></td>
            </tr>
            <tr>
                <th><strong>전화번호</strong></th>
                <td><?php echo $my_phonenumber; ?></td>
            </tr>
            <tr>
                <th><strong>생년월일</strong></th>
                <td><?php echo $my_birthday; ?></td>
            </tr>
        </table>
    </div>
    <footer class="footer__inner">
        <div class="buttons2">
            <div class="buttons-chat">
                <form method="post" action="altPrivacy.php">
                    <input class="buttons-chat__button" type="submit" value="개인정보 변경">
                </form>
            </div>
            <div class="buttons-chat">
                <form method="post" action="delAccount.php">
                    <input class="buttons-chat__button" type="submit" value="회원탈퇴">
                </form>
            </div>
        </div>
    </footer>
</body>

</html>