<?php
include_once 'db_connect.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>계정찾기</title>
    <link rel="stylesheet" href="css/headerstyle.css" />
    <link rel="stylesheet" href="css/bodystyle.css" />
    <link rel="stylesheet" href="css/privacybuttonstyle.css"/>
    <link rel="stylesheet" href="css/privacytablestyle.css"/>
</head>
<body>
<header>
    <div class="head">
      <div class="header__inner">
        <a href="login_and_createAccount.php">
          <img src="./img/Strawberry MarketLogo2.png" />
        </a>
        <div>
        </div>
        <div style="width: 67px;" class="buttons">
          <form method="post" action="login_and_createAccount.php">
            <input class="buttons-chat__button2" type="submit" value="로그인">
          </form>
        </div>
      </div>
    </div> 
    </header>
    
    <div class="mid">
    <p class="h1head"><?php echo $my_nickname; ?>아이디를 찾기위해 가입하신 이메일을 입력해주세요</p>
    <form style="display: inline;" method="post"  action="findAccount_logic.php">
    <table>
        <tr>
            <th><strong>이메일</strong></th>
            <td><input type="text" name="email" required="required"></td>
        </tr>
    </table>
    <div style="margin-top: 20px; margin-bottom: 20px;" class = "buttons2">
          <div class = "buttons-chat">
            <input class = "buttons-chat__button" type="submit" value="아이디 찾기">
          </div>
        </div>
        <div style="text-align: center; padding-right: 60px;">
        <a href="findPassword.php">Forgot only password?</a>
        </div>
    </form>
</body>
</html>