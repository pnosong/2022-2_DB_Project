
<?php
$db = '(DESCRIPTION =(ADDRESS_LIST=(ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';

$con = oci_connect("DBA2022G3", "test1234", $db);
if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
echo "디비 연결 성공<br>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="content-type" content="text/html"; charset="utf-8">
    <style>
        table.table2 {
            border-collapse: separate;
            border-spacing: 1px;
            text-align: left;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            margin: 20px 10px;
        }

        table.table2 tr {
            width: 50px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        table.table2 td {
            width: 100px;
            padding: 10px;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <form enctype="multipart/form-data" method="post" action="testinsertImage.php">
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
                            <td><input type="file" name="img_test" size=10 maxlength=15></td>
                        </tr>
                       
                        <!-- <tr>
                            <td>cat_test.jpeg 사진 삭제</td>
                            <td><input type="submit" name="img_delete" value="삭제" size=10 maxlength=15></td>
                        </tr> -->

                        
                    </table>

                    <div colspan="2">
                        <input style="height:26px; width:80px; font-size:16px;" type="submit" value="작성완료">
                        <input style="height:26px; width:80px; font-size:16px;" onclick="history.back()" type="submit" value="작성취소">
                    </div>

                </td>
            </tr>
        </table>
    </form>
</body>

</html>



