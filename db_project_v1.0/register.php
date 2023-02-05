<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h1>회원가입</h1>
    <form method="post" action="register_result.php">
        <p><input type="text" name="account" placeholder="아이디" required></p>
        <p><input type="password" name="password" placeholder="비밀번호" required></p>
        <p><input type="password" name="password_confirm" placeholder="비밀번호 확인" required></p>
        <p><input type="text" name="name" placeholder="이름" required></p>
        <p><input type="text" name="nickname" placeholder="별명" required></p>
        <p><input type="email" name="email" placeholder="이메일" required></p>
        <p><input type="text" name="sex" placeholder="성별" required></p>
        <p><input type="text" name="phonenumber" placeholder="휴대전화 번호" required></p>
        <p><input type="text" name="birthday" placeholder="생년월일" required></p>
        <p><input type="submit" value="회원가입"></p>
    </form>
</body>
</html>
