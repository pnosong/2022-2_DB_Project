<?php
session_start();
$my_account = $_SESSION["account"];
$my_password = $_SESSION["password"];

$Alt_Number = $_POST['Alt_Product_ProductUniqueNumber'];

$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';
$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) 
{
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}

$sql = "SELECT title from ProductInformation WHERE ProductUniqueNumber = '$Alt_Number'";
$stat = oci_parse($con, $sql);
$ret = oci_execute($stat);
$row = oci_fetch_array($stat);
$title = $row[0];
if (!$ret) {
    echo "<br/>";
    echo "데이터 정보 삭제 실패";
    echo "<br/>";
}
oci_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>랜딩페이지</title>
</head>
<body>
    <form method="post" action="logout.php">
        <input type="submit" value="로그아웃">
    </form>
    <form method="post" action="loginmain.php">
        <input type="submit" value="마이페이지">
    </form>
    <form method="post" action="loginmain.php">
        <input type="submit" value="메인페이지">
    </form>
    <h1>[<?php echo $title; ?>]글을 수정합니다</h1>
    <?php
    ?>

    <form method="post" action="AltProduct_result.php">
        <!-- method : POST!!! (GET X) -->
        <table style="padding-top:50px"  width=auto  cellpadding=2>
            <tr>
                <td style="height:40; float:center; background-color:#FF7F00">
                    <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>중고거래 글쓰기</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table2">
                        <tr>
                            <td>사진</td>
                            <td><input type="text" name="PHOTO" size=10 maxlength=15></td>
                        </tr>
                        <tr>
                            <td>글제목</td>
                            <td><input type="text" name="TITLE" size=30></td>
                        </tr>

                        <tr>
                            <td>가격</td>
                            <td><input type="number" name="PRICE" size=20 placeholder="￦ 가격 (선택사항)" required></td>
                        </tr>
                        <tr>
                            <td>내용</td>
                            <td><textarea name="CONTENT" cols=75 rows=15 placeholder="조치원읍에 올릴 게시글 내용을 작성해 주세요.&#13;&#10;(가품 및 판매 금지 물품은 게시가 제한될 수 있어요.)" required></textarea></td>
                        </tr>  
                    </table>
                    <div colspan="2">
                        <input type='hidden' name='Alt_Number' value = <?php echo $Alt_Number; ?> >
                        <input style="height:26px; width:80px; font-size:16px;" type="submit" value="변경완료">
                        <input style="height:26px; width:80px; font-size:16px;" onclick="history.back()" type="submit" value="변경취소">
                    </div>
                </td>
            </tr>
        </table>
    </form>


</body>
</html>