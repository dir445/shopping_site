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
        $staff_code = $_POST['code'];
        check_csfr_token('スタッフを削除できませんでした。');

        $dbh = connect_shop_database();

        $sql = 'DELETE FROM mst_staff WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_code;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }   
    ?>
    削除しました。<br />
    <br />
    <a href="staff_list.php">戻る</a>
</body>
</html>