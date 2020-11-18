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
        check_csfr_token('商品を追加できませんでした。');
        $post = sanitize($_POST);
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou_name = $post['gazou_name'];

        $dbh = connect_shop_database();

        $sql = 'INSERT INTO mst_product(name,price,gazou) VALUES(?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_gazou_name;

        $stmt->execute($data);

        $dbh = null;

        print $pro_name;
        print 'を追加しました。<br />';
    } catch (Exception $e) {
        print $e.'<br />';
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>
    <a href="pro_list.php">戻る</a>
</body>
</html>