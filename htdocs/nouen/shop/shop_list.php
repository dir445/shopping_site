<?php
require_once('../common/common.php');
disp_member_login();
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
        $dbh = connect_shop_database();

        $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        print '商品一覧<br /><br />';

        while(true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false) {
                break;
            }
            print '<a href="shop_product.php?procode='.$rec['code'].'">';
            print $rec['name'].'---';
            print $rec['price'].'円';
            print '</a>';
            print '<br />';
        }

        print '<br />';
        print '<a href="shop_cartlook.php">カートを見る</a><br />';
    } catch(Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>

</body>
</html>