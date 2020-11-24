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
        require_once('../common/common.php');

        $post = sanitize($_POST);
        $staf_code = $post['code'];
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];

        $dbh = connect_shop_database();

        $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $data[] = $staf_code;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }   
    ?>
    修正しました。<br />
    <br />
    <a href="staff_list.php">戻る</a>
</body>
</html>