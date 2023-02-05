<?php
  session_start();
  $session_account = $_SESSION[ "account" ];
//   if ( is_null( $session_account ) ) {
    // header( 'Location: login.php' );
//   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 성공</title>
</head>
<body>
    <h1><?php echo $session_account; ?>님, 로그인 하셨습니다.</h1>
    <a href="logout.php">로그아웃</a>
</body>
</html>