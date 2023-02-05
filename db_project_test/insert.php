<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="content-type" content="text/html"; charset="utf-8">
    <title>신규회원 등록</title>
</head>
<body>
    <h1>신규 회원 입력</h1>
    <form method="post" action="insert_result.php">
        아이디 : <input type="text" name="account"> <br>
        비밀번호 : <input type="text" name="password"> <br>
        이름 : <input type="text" name="name"> <br>
        닉네임 : <input type="text" name="nickname"> <br>
        <input type="submit" value="회원 등록">
    </form>
</body>
</html>