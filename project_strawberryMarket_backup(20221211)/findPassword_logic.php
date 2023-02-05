<?php
include_once 'db_connect.php';  
$account = $_POST['account'];
$name = $_POST['name'];
$birthday = $_POST['birthday'];
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
    <p class="h1head"><?php echo $my_nickname; ?>해당 아이디의 비밀번호입니다. </p>
    <table>
    <?php 

    $sql = "SELECT password from MemberInformation where account='$account' and name = '$name' and birthday = '$birthday'";
    $stat = oci_parse($con, $sql);  
    $ret = oci_execute($stat);
    $check = oci_fetch_row($stat);
    $a = $check[0];
    if (is_null($a)) {
      echo "<div style='text-align: center;'>";
      echo "<a>아이디 또는 입력 정보가 잘못되었습니다.</a>";
      echo "</div>";
      echo "<form method='post'  action='findPassword.php'>";
      echo "<div style='text-align: center;' class = 'buttons-chat'>";
      echo "<input class = 'buttons-chat__button' type='submit' value='다시 비밀번호 찾기'>";
      echo "</div>";
      echo "</from>";
      echo "</table>";
    }else{
      $stat = oci_parse($con, $sql);  
      $ret = oci_execute($stat);
      while (($row = oci_fetch_array($stat)) == TRUE) {
        echo "<tr><th><strong>비밀번호</strong></th><td>",$row[0],"</tr>";
    }
    echo "</table>";
    }
    ?>



</body>
</html>