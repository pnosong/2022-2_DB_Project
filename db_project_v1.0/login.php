<?php
error_reporting(E_ALL&~E_WARNING);
session_start();

  $account = $_POST[ 'account' ];
  $password = $_POST[ 'password' ];

  if ( !is_null( $account ) ) {
    $db = '
    (DESCRIPTION =
            (ADDRESS_LIST=
                    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
            )
            (CONNECT_DATA =
            (SID = orcl)
            )
    )';
    //enter user name & password
    //connect with oracle_db

    
    $con = oci_connect("DBA2022G3", "test1234", $db);
    if (!$con) {
        echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
        exit();
    }

    $sql_password = "SELECT password FROM MemberInformation WHERE account='$account'";
    $result_password = oci_parse( $con, $sql_password );
    oci_execute($result_password);

    $row = oci_fetch_row($result_password);
    $encrypted_password = $row[0];

    echo "<script>alert(test!!);</script>";

    if ( is_null( $encrypted_password ) ) { //계정명과 일치하는 비밀번호가 없을 경우
      $wa = 1;
      oci_close($con);
    } 
    else 
    {
      if ( $encrypted_password == $password)  
      {
        $_SESSION['account'] = $account;
        $_SESSION['password'] = $password;

        $sql_name = "SELECT name FROM MemberInformation WHERE account='$account'";
        $result_name = oci_parse( $con, $sql_name );
        oci_execute($result_name);
        $row_name = oci_fetch_row($result_name);
        $_SESSION['name']=$row_name[0];

        $sql_nickname = "SELECT nickname FROM MemberInformation WHERE account='$account'";
        $result_nickname = oci_parse( $con, $sql_nickname );
        oci_execute($result_nickname);
        $row_nickname = oci_fetch_row($result_nickname);
        $_SESSION["nickname"]=$row_nickname[0];
        
        $sql_Email = "SELECT Email FROM MemberInformation WHERE account='$account'";
        $result_Email = oci_parse( $con, $sql_Email );
        oci_execute($result_Email);
        $row_Email = oci_fetch_row($result_Email);
        $_SESSION["Email"]=$row_Email[0];
        
        $sql_sex = "SELECT sex FROM MemberInformation WHERE account='$account'";
        $result_sex = oci_parse( $con, $sql_sex );
        oci_execute($result_sex);
        $row_sex = oci_fetch_row($result_sex);
        $_SESSION["sex"]=$row_sex[0];
        
        $sql_phonenumber = "SELECT phonenumber FROM MemberInformation WHERE account='$account'";
        $result_phonenumber = oci_parse( $con, $sql_phonenumber );
        oci_execute($result_phonenumber);
        $row_phonenumber = oci_fetch_row($result_phonenumber);
        $_SESSION["phonenumber"]=$row_phonenumber[0];

        $sql_birthday = "SELECT birthday FROM MemberInformation WHERE account='$account'";
        $result_birthday = oci_parse( $con, $sql_birthday );
        oci_execute($result_birthday);
        $row_birthday = oci_fetch_row($result_birthday);
        $_SESSION["birthday"]=$row_birthday[0];

        oci_close($con);
        header( 'Location: loginmain.php' );
      } 
      else                  //계정명과 일치하는 비밀번호가 입력과 다를경우
      {
        $wp = 1;
        oci_close($con);
      }
    }
  }
?>

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
    <h1>로그인</h1>
    <form method="post" action="login.php">
        <input type="text" placeholder="아이디" name="account" required> <br>
        <input type="text" placeholder="비밀번호" name="password" required> <br>
        <input type="submit" value="로그인">
        <?php
        if ( $wa == 1 ) {
          echo "<p>사용자이름이 존재하지 않습니다.</p>";
        }
        if ( $wp == 1 ) {
          echo "<p>비밀번호가 틀렸습니다.</p>";
        }
      ?>
    </form>
</body>
</html>
