<?php
require_once('../common/common.php');
check_staff_login(TRUE);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ショッピングサイト</title>
</head>
<body>
    <?php 

    if(!$changeName && !$changePass) {
        print '変更する項目がチェックされていません<br />';
    }

    if($staff_name == '') {
        print 'スタッフ名が入力されていません。<br />';
    } else {
        print 'スタッフ名：';
        print $staff_name;
        print '<br />';
    }

    if($changePass) {
        if($staff_pass=='') {
            print 'パスワードが入力されていません。<br />';
        }
    
        if($staff_pass != $staff_pass2) {
            print 'パスワードが一致しません。<br />';
        }
    }


    if($staff_name=='' || $staff_pass=='' || $staff_pass!=$staff_pass2) {
        print '<form>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
    } else {
        $staff_pass = md5($staff_pass);
        print '<form method="post" action="staff_edit_done.php">';
        print '<input type="hidden" name="code" value="'.$staf_code.'">';
        print '<input type="hidden" name="name" value="'.$staff_name.'">';
        print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="OK">';
        print '</form>';
    }
    ?>
</body>
</html>