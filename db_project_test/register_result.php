<?php
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

    // echo $birthday;
    $sql_add_user = "insert into MemberInformation
        ( account, password, name, nickname, email, sex, phonenumber, birthday )
        VALUES ( '$account', '$password', '$name', '$nickname', '$email', '$sex', '$phonenumber', '$birthday' )";
        $stat_add_user=oci_parse($con, $sql_add_user);
        $ret_add_user=oci_execute($stat_add_user);

        if($ret_add_user){
            echo "회원 등록 성공";
        }else{
            echo "회원 등록 실패";
        }


    // if($wu==1){
    //     echo "<p>사용자의 이름이 중복되었습니다.</p>";
    // }elseif($wp==1){
    //     echo "<p>비밀번호 확인이 일치하지 않습니다.</p>";
    // }else
    //     echo "<p>유효성 검사가 완료되었습니다.</p>";
?>