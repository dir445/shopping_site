<?php
require_once('../common/common.php');
//check_staff_login(TRUE);
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
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];

        $dbh = connect_shop_database();

        $sql = 'INSERT INTO mst_staff(name,password) VALUES(?,?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $stmt->execute($data);

        $dbh = null;

        print $staff_name;
        print 'さんを追加しました。<br />';
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>
    <a href="staff_list.php">戻る</a>
</body>
</html>