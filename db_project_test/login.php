<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h1>로그인</h1>
    <form method="post" action="login_result.php">
        <p><input type="text" name="account" placeholder="아이디" required></p>
        <p><input type="password" name="password" placeholder="비밀번호" required></p>
        <p><input type="submit" value="로그인"></p>
        <?php
        // if ( $wu == 1 ) {
        //   echo "<p>사용자이름이 존재하지 않습니다.</p>";
        // }
        // if ( $wp == 1 ) {
        //   echo "<p>비밀번호가 틀렸습니다.</p>";
        // }
        // ?>
    </form>
</body>
</html>