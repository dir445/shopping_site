<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ショッピングサイト</title>
</head>
<body>
    <?php
    if($name == '') {
        print 'スタッフ名が入力されていません。<br />';
    } else {
        print 'スタッフ名：';
        print $name;
        print '<br />';
    }

    if($pass=='') {
        print 'パスワードが入力されていません。<br />';
    }

    if($pass != $pass2) {
        print 'パスワードが一致しません。<br />';
    }

    if($name=='' || $pass=='' || $pass!=$pass2) {
        print '<form>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
    } else {
        print '<form method="post" action="../index.php">';
        print '<input type="hidden" name="name" value="'.$name.'">';
        print '<input type="hidden" name="pass" value="'.$pass_md5.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" name="add_done" value="OK">';
        print '</form>';
    }
    ?>
</body>
</html>