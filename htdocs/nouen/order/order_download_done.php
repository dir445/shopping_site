<?php
require_once('../common/common.php');
check_staff_login(TRUE);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> ろくまる農園 </title>
</head>
<body>
    <?php
    try {
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];

        $dbh = connect_shop_database();
        
        $sql = 'SELECT
            dat_sales.code,
            dat_sales.date,
            dat_sales.code_member,
            dat_sales.name AS dat_sales_name,
            dat_sales.name,
            dat_sales.email,
            dat_sales.postal1,
            dat_sales.postal2,
            dat_sales.address,
            dat_sales.tel,
            dat_sales_product.code_product,
            mst_product.name AS mst_product_name,
            dat_sales_product.price,
            dat_sales_product.quantity
        FROM
            dat_sales,dat_sales_product,mst_product
        WHERE
            dat_sales.code=dat_sales_product.code_sales
            AND dat_sales_product.code_product=mst_product.code
            AND substr(dat_sales.date,1,4)=?
            AND substr(dat_sales.date,6,2)=?
            AND substr(dat_sales.date,9,2)=?';

        $data[] = $year;
        $data[] = $month;
        $data[] = $day;
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        $dbh = null;

        $csv = '注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
        $csv.= "\n";
        while(true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false) {
                break;
            }
            $csv.= $rec['code'];
            $csv.= ',';
            $csv.= $rec['date'];
            $csv.= ',';
            $csv.= $rec['code_member'];
            $csv.= ',';
            $csv.= $rec['dat_sales_name'];
            $csv.= ',';
            $csv.= $rec['email'];
            $csv.= ',';
            $csv.= $rec['postal1'] . '-' .$rec['postal2'];
            $csv.= ',';
            $csv.= $rec['address'];
            $csv.= ',';
            $csv.= $rec['tel'];
            $csv.= ',';
            $csv.= $rec['code_product'];
            $csv.= ',';
            $csv.= $rec['mst_product_name'];
            $csv.= ',';
            $csv.= $rec['price'];
            $csv.= ',';
            $csv.= $rec['quantity'];
            $csv.= "\n";
        }

        $file = fopen('./chumon.csv','w');
        $csv = mb_convert_encoding($csv,'SJIS','UTF-8');
        fputs($file,$csv);
        fclose($file);

        //print nl2br($csv);
    } catch(Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>
    <a href="chumon.csv">注文データのダウンロード</a><br />
    <br />
    <a href="order_download.php">日付選択へ</a><br />
    <br />
    <a href="../staff_login/staff_top.php">トップメニューへ</a><br />

</body>
</html>