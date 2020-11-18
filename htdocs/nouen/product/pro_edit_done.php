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
        $post = sanitize($_POST);
        $pro_code  = $post['code'];
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou_name_old = $post['gazou_name_old'];
        $pro_gazou_name = $post['gazou_name'];

        $dbh = connect_shop_database();

        $sql = 'UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_gazou_name;
        $data[] = $pro_code;

        $stmt->execute($data);

        $dbh = null;
        
        if($pro_gazou_name_old != $pro_gazou_name) {
            if($pro_gazou_name_old != '') {            
                unlink('./gazou/'.$pro_gazou_name_old);
            }
        }
        print '修正しました。<br />';
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>
    <a href="pro_list.php">戻る</a>
</body>
</html>