<?php
$account = $_POST["account"];
$password = $_POST["password"];
$name = $_POST["name"];
$nickname = $_POST["nickname"];
$Email = $_POST["Email"];
$sex = $_POST["sex"];
$phonenumber = $_POST["phonenumber"];
$birthday = $_POST["birthday"];

session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];
$my_name = $_SESSION["name"];
$my_nickname = $_SESSION["nickname"];
$my_Email = $_SESSION["Email"];
$my_sex = $_SESSION["sex"];
$my_phonenumber = $_SESSION["phonenumber"];
$my_birthday = $_SESSION["birthday"];



$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';

$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
echo "디비 연결 성공<br>";



$sql = "SELECT account FROM MemberInformation WHERE account='$account'";
$stat = oci_parse($con, $sql);
$ret = oci_execute($stat);
$row = oci_fetch_row($stat);

if ($account == $row[0] and $account != $my_account) {
    echo "<script>alert('계정이 중복됩니다!');
    location.href='./altPrivacy.php'
    </script>";
} else {
    $sql1 = "SELECT * from ProductTransactionStatus where buyer = '$my_account'";
    $stat1 = oci_parse($con, $sql1);
    $ret = oci_execute($stat1);
    $check1 = oci_fetch_row($stat1);
    $a1 = $check1[0];
    if (is_null($a1)) {
        echo "실행없음.1";
    } else {
        $sql1 = "UPDATE ProductTransactionStatus SET Status = '$account', buyer ='' where buyer = '$my_account'";
        $stat1 = oci_parse($con, $sql1);
        $ret = oci_execute($stat1);
        echo "실행1";
        if ($ret) {
        } else {
            echo "Error.1";
        }
    }
    $sql2 = "SELECT * from ProductList where account= '$my_account'";
    $stat2 = oci_parse($con, $sql2);
    $ret = oci_execute($stat2);
    $check2 = oci_fetch_row($stat2);
    $a2 = $check2[0];
    if (is_null($a2)) {
        echo "실행없음.2";
    } else {
        $sql = "UPDATE ProductList SET account = '' WHERE account= '$my_account'";
        $stat = oci_parse($con, $sql);
        $ret = oci_execute($stat);
        echo "실행2";
        if ($ret) {
        } else {
            echo "Error.2";
        }
    }

    $sql3 = "UPDATE MemberInformation SET account = '$account', password = '$password', name = '$name', nickname = '$nickname', Email = '$Email', sex = '$sex' , phonenumber = '$phonenumber' , birthday = '$birthday'  WHERE account = '$my_account'";
    $stat3 = oci_parse($con, $sql3);
    $ret = oci_execute($stat3);

    if ($ret) {
    } else {
        echo "Error.3";
    }

    if (is_null($a2)) {
        echo "실행없음.1";
    } else {
        $sql4 = "UPDATE ProductList SET account = '$account' WHERE account is NULL";
        $stat4 = oci_parse($con, $sql4);
        $ret = oci_execute($stat4);

        if ($ret) {
        } else {
            echo "Error.4";
        }
    }

    if (is_null($a1)) {
        echo "실행없음.1";
    } else {
        $sql5 = "UPDATE ProductTransactionStatus SET Status = 'after', buyer ='$account' where status = '$account'";
        $stat5 = oci_parse($con, $sql5);
        $ret = oci_execute($stat5);

        if ($ret) {
        } else {
            echo "Error.5";
        }
    }
}

if ($ret) {
    oci_commit($con);
    oci_close($con);
    echo "<script>alert('회원정보가 성공적으로 수정되었습니다!');
    location.href='./mainpage.php'
    </script>";
} else {
    echo "Error.최종";
}
