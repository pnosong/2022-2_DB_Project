<?php
    $account = $_POST['account'];
    $password = $_POST['password'];

    if(!is_null($account)){
        include 'db_access.php';
    }
    // if(!is_null($account)){
    //     $db = '
    //     (DESCRIPTION =
    //             (ADDRESS_LIST=
    //                     (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
    //             )
    //             (CONNECT_DATA =
    //             (SID = orcl)
    //             )
    //     )';
    //     //enter user name & password
    //     //connect with oracle_db
    //     $con = oci_connect("DBA2022G3", "test1234", $db);
    //     if (!$con) {
    //         echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    //         exit();
    //     }
    //     echo "디비 연결 성공", "<br>";
    // }

    // $sql = "select account from MemberInformation where account='".$account."'";
    $sql = "select account, password from MemberInformation where account='".$account."' and password='".$password."'";
    $stat=oci_parse($con,$sql);
    $ret=oci_execute($stat);

    // echo $stat, "<br>";
    // echo $ret, "<br>";
    if ($ret) {
        echo "<br/>";
        echo "sql 성공";
        echo "<br/>";
    } else {
        echo "<br/>";
        echo "sql 실패";
        echo "<br/>";
    }

    $row = oci_fetch_all($stat, $res);
    if($row){
        $_SESSION['account'];
        $_SESSION['password'];
        header('Location: login-ok.php');
    }else{
        echo "로그인 정보를 잘못 입력했습니다.";
    }



    // $count = oci_num_rows($stat);
    // echo $count, "<br>";

    // if($count==1){
    //     session_start();
    //     $_SESSION["account"];
    //     $_SESSION["password"];
    //     header('Location: login-ok.php');
    // }else{
    //     echo "로그인 정보를 잘못 입력했습니다.";
    // }

    // while($row=oci_fetch_array($stat)){
    //     echo $row, "<br>";
    //     echo $row[0], "<br>";
    //     $encrypted_password=$row['password'];
    // }

    // if(is_null($encrypted_password)){
    //     $wu = 1;
    //     echo "로그인 실패";
    // }else{
    //     if(password_verify($password, $encrypted_password)){
    //         session_start();
    //         $_SESSION['account']=$account;
    //         header('Location: login-ok.php');
    //     }else{
    //         $wp=1;
    //     }
    // }
?>