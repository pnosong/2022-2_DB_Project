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
</head>
<body>
    <form method="post" action="mypage.php">
        <input type="submit" value="마이페이지">
    </form>
    <form method="post" action="logout.php">
        <input type="submit" value="로그아웃">
    </form>
    <form method="post" action="Privacy.php">
        <input type="submit" value="변경취소">
    </form>
    <h1><?php echo $my_nickname; ?>님의</h1>
    <h1>개인정보 변경</h1>
    <form method="post" action="AltPrivacy_resurt.php">
        <table border="1">
            <tr>
                <td><strong>아이디</strong></td>
                <td><?php echo $my_account; ?></td>
                <td><input type="text" name="account" required> <br></td>
            </tr>
            <tr>
                <td><strong>비밀번호</strong></td>
                <td><?php echo $my_password; ?></td>
                <td><input type="text" name="password" required> <br></td>
            </tr>
            <tr>
                <td><strong>이름</strong></td>
                <td><?php echo $my_name; ?></td>
                <td><input type="text" name="name"> <br></td>
            </tr>
            <tr>
                <td><strong>별명</strong></td>
                <td><?php echo $my_nickname; ?></td>
                <td><input type="text" name="nickname"> <br></td>
            </tr>
            <tr>
                <td><strong>이메일</strong></td>
                <td><?php echo $my_Email; ?></td>
                <td><input type="text" name="Email"> <br></td>
            </tr>
            <tr>
                <td><strong>성별</strong></td>
                <td><?php echo $my_sex; ?></td>
                <td><input type="text" name="sex"></td>
            </tr>
            <tr>
                <td><strong>전화번호</strong></td>
                <td><?php echo $my_phonenumber; ?></td>
                <td><input type="text" name="phonenumber"></td>
            </tr>
            <tr>
                <td><strong>생년월일</strong></td>
                <td><?php echo $my_birthday; ?></td>
                <td><input type="text" name="birthday"></td>
            </tr>
        </table>
        <input type="submit" value="입력완료">
    </form>
</body>
</html>