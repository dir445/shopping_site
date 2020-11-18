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
        $dbh = connect_shop_database();

        $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        print '商品一覧<br /><br />';

        print '<form method="post" action="pro_branch.php">';
        while(true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false) {
                break;
            }
            print '<input type="radio" name="procode" value="'.$rec['code'].'">';
            print $rec['name'].'---';
            print $rec['price'].'円';
            print '<br />';
        }
        print '<input type="submit" name="disp" value="参照">';
        print '<input type="submit" name="add" value="追加">';
        print '<input type="submit" name="edit" value="修正">';
        print '<input type="submit" name="delete" value="削除">';
        print '</form>';
    } catch(Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>

    <br />
    <a href="../staff_login/staff_top.php">トップメニューへ</a><br />
    
</body>
</html>