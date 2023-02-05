<?php
session_start();

$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];
$my_name = $_SESSION["name"];
$my_nickname = $_SESSION["nickname"];
$my_Email = $_SESSION["Email"];
$my_sex = $_SESSION["sex"];
$my_phonenumber = $_SESSION["phonenumber"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>랜딩페이지</title>
</head>
<body>
    <form method="post" action="logout2.php">
        <input type="submit" value="로그아웃">
    </form>
    <h1><?php echo $my_nickname; ?>님의</h1>
    <h1>메인 페이지</h1>
    <a href="mypage.php">마이페이지</a><br><br>
    <a href="writingpage.html"> 중고거래 글쓰기 </a> <br><br>  
</body>
</html>