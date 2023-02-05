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
    <h1>[<?php echo $my_nickname; ?>]님의 마이 페이지</h1>
    <table border="1">
        <tr>
            <td><strong>아이디</strong></td>
            <td><?php echo $my_account; ?></td>
        </tr>
        <tr>
            <td><strong>비밀번호</strong></td>
            <td><?php echo $my_password; ?></td>
        </tr>
        <tr>
            <td><strong>이름</strong></td>
            <td><?php echo $my_name; ?></td>
        </tr>
        <tr>
            <td><strong>별명</strong></td>
            <td><?php echo $my_nickname; ?></td>
        </tr>
        <tr>
            <td><strong>이메일</strong></td>
            <td><?php echo $my_Email; ?></td>
        </tr>
        <tr>
            <td><strong>성별</strong></td>
            <td><?php echo $my_sex; ?></td>
        </tr>
        <tr>
            <td><strong>전화번호</strong></td>
            <td><?php echo $my_phonenumber; ?></td>
        </tr>
        <tr>
            <td><strong>생년월일</strong></td>
            <td><?php echo $my_birthday; ?></td>
        </tr>
    </table>
    <form method="post" action="AltPrivacy.php">
        <input type="submit" value="개인정보 변경">
    </form>
    <form method="post" action="Withdrawal.php">
        <input type="submit" value="회원탈퇴">
    </form>
</body>
</html>