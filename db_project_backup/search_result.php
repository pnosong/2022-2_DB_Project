<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>검색 결과</title>
  </head>
  <body>
    <form action="search_result.php" method="post">
      <input type="text" name = "search", placeholder ="조치원읍 근처에서 검색">
      <input type="submit" value="검색">
    </form>

    
    <a href="loginmain.php"> 메인페이지 가기 </a> <br><br> 

    </body>
</html>
    
    <?php
    session_start();
    $my_account = $_SESSION["account"];
    // oracle DB 서버
    $db = '
    (DESCRIPTION =
            (ADDRESS_LIST=
                    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
            )
            (CONNECT_DATA =
            (SID = orcl)
            )
    )';

    $con = oci_connect("DBA2022G3", "test1234", $db);
        if (!$con) {
            echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
            exit();
        }
    
    $search = $_POST['search'];

    // 거래전인 상품 정보 뽑아오기
    $sql = "SELECT 
    ProductInformation.ProductUniqueNumber as PUN, 
    ProductInformation.title as t, 
    ProductInformation.content as c, 
    ProductInformation.price as p, 
    ProductInformation.photo as ph, 
    ProductList.account as a
    from 
    ProductInformation 
    join 
    ProductList 
    on 
    ProductInformation.ProductUniqueNumber = ProductList.ProductUniqueNumber 
    join 
    ProductTransactionStatus 
    on 
    ProductInformation.ProductUniqueNumber = ProductTransactionStatus.ProductUniqueNumber 
    where 
    ProductTransactionStatus.status = 'before' and CONTENT like '%$search%'";
    $stat = oci_parse($con, $sql);  
    $ret = oci_execute($stat);

    if (!$ret) {
        echo "<br/>";
        echo "데이터 조회 실패";
        echo "<br/>";
    }


    $i=0;
    while (($row = oci_fetch_array($stat)) == TRUE) 
    {
        // 수정된 부분
        $photoName = $row['PH'];

        if ($i == 0)
        {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td><strong>", "제목", "</strong></td>", 
                "<td><strong>", "설명", "</strong></td>", 
                "<td><strong>", "사진", "</strong></td>", 
                "<td><strong>", "구매&수정", "</strong></td>";
            echo "</tr>";
            $i = 1;
        }

        if ($row['A'] != $my_account)
        {
            echo "<tr>";
            echo "<td>$row[T]</td>";
            echo "<td>$row[C]</td>";
            echo "<td><img src='./img/$photoName'></td>";
            echo("<td>
            <form method = post action=purchase.php>
                <input type=hidden name=pid value =$row[0]>
                <input type=submit value=구매하기>
            </form>
            </td>");
            echo "</tr>";
        }
        else
        {
            echo "<tr>";
            echo "<td>$row[T]</td>";
            echo "<td>$row[C]</td>";
            echo "<td><img src='./img/$photoName'></td>";
            echo ("<td>
            <form method='post' action='AltProduct.php'>
                <input type='hidden' name='Alt_Product_ProductUniqueNumber' value= $row[0]>
                <input type='submit' value='수정하기'>
            </form>
            </td>");
            echo "</tr>";
        }
    }
    if ($i == 1)
    {
        echo "</table>";
    }
    else
    {
        echo "검색 결과 없습니다.";
    }
    oci_close($con);
    ?>
 



