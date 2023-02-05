<?php
    session_start();

    $account = $_POST['account'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $name=$_POST['name'];
    $nickname=$_POST['nickname'];
    $email=$_POST['email'];
    $sex=$_POST['sex'];
    $phonenumber=$_POST['phonenumber'];
    $birthday=$_POST['birthday'];
    
    if(!is_null($account)){
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
        echo "디비 연결 성공", "<br>";
    }

    // $sql="select account from MemberInformation where account='".$account."'";
    // $stat=oci_parse($con,$sql);
    // $ret=oci_execute($stat);

    // if ($ret) {
    //     echo "<br/>";
    //     echo "sql 성공";
    //     echo "<br/>";
    // } else {
    //     echo "<br/>";
    //     echo "sql 실패";
    //     echo "<br/>";
    // }

    // unset($account_ee);
    // $account_ee="";
    // global $account_ee;
    // while($row=oci_fetch_array($stat)){
    //     echo $row["account"];
    //     $account_ee=$row["account"];
    // }

    // global $wu;
    // global $wp;
    // if($account==$account_ee){
    //     $wu=1;
    // }elseif($password != $password_confirm){
    //     $wp=1;
    // }else{
        // $encrypted_password = password_hash( $password, PASSWORD_DEFAULT);????
        // echo $birthday;
        // $sql_add_user = "insert into MemberInformation
        //                 ( account, password, name, nickname, email, sex, phonenumber, birthday )
        //                 VALUES ( '".$account."', '".$password."', '".$name."', '".$nickname."', '".$email."', '".$sex."', '".$phonenumber."', '".$birthday."' )";
        // $sql_add_user = "insert into MemberInformation
        // ( account, password, name, nickname, email, sex, phonenumber, birthday )
        // VALUES ( '$account', '$password', '$name', '$nickname', '$email', '$sex', '$phonenumber', '$birthday' )";


        // $stat_add_user=oci_parse($con, $sql_add_user);
        // $ret_add_user=oci_execute($stat_add_user);

        // if($ret_add_user){
        //     echo "회원 등록 성공";
        // }else{
        //     echo "회원 등록 실패";
        // }
    // }

    $sql = "SELECT account FROM MemberInformation WHERE account='$account'";
    $stat = oci_parse($con, $sql);
    $ret = oci_execute($stat);
    $row = oci_fetch_row($stat);
    
    
    if($account == $row[0]){
        header( 'Location: register_accountFail.html' );
    }else if($password != $password_confirm){
        header( 'Location: register_passwordFail.html' );
    }else{
        $sql_add_user = "insert into MemberInformation
        ( account, password, name, nickname, email, sex, phonenumber, birthday ) VALUES
        ( '$account', '$password', '$name', '$nickname', '$email', '$sex', '$phonenumber', '$birthday' )";
        $stat_add_user=oci_parse($con, $sql_add_user);
        $ret_add_user=oci_execute($stat_add_user);

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
        header( 'Location: register_success.html' );
    }
?>