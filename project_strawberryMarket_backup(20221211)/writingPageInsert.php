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
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="content-type" content="text/html" ; charset="utf-8">
    <style>
        table.table2 {
            border-collapse: separate;
            border-spacing: 1px;
            text-align: left;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            margin: 20px 10px;
        }

        table.table2 tr {
            width: 50px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        table.table2 td {
            width: 100px;
            padding: 10px;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        #wrapper {
            width: 720px;

            margin: 0 auto;

            height: 600px;

            border: 6px solid rgb(223, 105, 105);
        }
    </style>
    <link rel="stylesheet" href="css/headerstyle.css" />
</head>

<body>
    <header>
        <p>.</p>
        <p>.</p>
        <p>.</p>
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
                        <input class="buttons-chat__button" type="button" value="판매내역" onClick="location.href='salesDetails.php'">
                    </div>
                    <div class="buttons-chat">
                        <input class="buttons-chat__button" type="button" value="구매내역" onClick="location.href='purchaseHistory.php'">
                    </div>
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


    <div id="wrapper">
        <table style="padding-top:20px" text-align=center width=720 cellpadding=3>
            <tr>
                <td style="height:40; float:center; background-color:rgb(223, 105, 105)">
                    <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>중고거래 글쓰기</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <form enctype="multipart/form-data" method="post" action="writingPageInsert_logic.php">
                        <table class="table2">

                            <tr>
                                <td>사진</td>
                                <td><input type="file" name="photo" size=10 maxlength=15></td>
                            </tr>
                            <tr>
                                <td>글제목</td>
                                <td><input type="text" name="title" size=30></td>
                            </tr>

                            <tr>
                                <td>가격</td>
                                <td><input type="number" name="price" size=20 placeholder="￦ 가격 (선택사항)" required></td>
                            </tr>

                            <tr>
                                <td>내용</td>
                                <td><textarea name="content" cols=75 rows=15 placeholder="조치원읍에 올릴 게시글 내용을 작성해 주세요.&#13;&#10;(가품 및 판매 금지 물품은 게시가 제한될 수 있어요.)" required></textarea></td>

                            </tr>
                        </table>
                        <span style="position: absolute;">
                            <input style="height:26px; width:80px; font-size:16px;" type="submit" value="작성완료">
                        </span>
                    </form>
                    <form enctype="multipart/form-data" method="post" action="mainpage.php">
                        <span style="padding-left: 85px;">
                            <input style="height:26px; width:80px; font-size:16px;" type="submit" value="작성취소">
                        </span>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>