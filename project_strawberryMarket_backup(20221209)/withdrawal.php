<?php
error_reporting(E_ALL&~E_WARNING);
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];

$check_account = $_POST[ 'check_account' ];
$check_password = $_POST[ 'check_password' ];

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
    <form method="post" action="privacy.php">
        <input type="submit" value="탈퇴취소">
    </form>
    <form method="post" action="withdrawal.php">
        <input type="text" placeholder="아이디 확인" name="check_account" required> <br>
        <input type="text" placeholder="비밀번호 확인" name="check_password" required> <br>
        <input type="submit" value="회원 탈퇴">
    </form>

    <?php
    if($check_account != null and $check_password != null)
    {
        if ( $my_account == $check_account and $my_password == $check_password)
        {
            echo "탈퇴성공";
            header('Location: withdrawal_logic.php');
        }
        else
        {
            echo "아이디 또는 비밀번호가 틀립니다.";
        }
    }

    ?>
</body>
</html>