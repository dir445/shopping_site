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

    if($name!='') {
        print 'スタッフ名：';
        print $name;
        print '<br />';
    } elseif($changeName) {
        print 'スタッフ名が入力されていません。<br />';
    }

    if($changePass) {
        if($pass=='') {
            print 'パスワードが入力されていません。<br />';
        }    
        if($pass != $pass2) {
            print 'パスワードが一致しません。<br />';
        }
    }

    if((!$changeName && !$changePass) || 
        ($changeName && $name=='') ||
        ($changePass && ($pass=='' || $pass!=$pass2))) {
        print '<form>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
    } else {
        print '<form method="post">';
        print '<input type="hidden" name="code" value="'.$code.'">';
        print '<input type="hidden" name="name" value="'.$name.'">';
        print '<input type="hidden" name="pass" value="'.$pass_md5.'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" name="edit_done" value="OK">';
        print '</form>';
    }
    ?>
</body>
</html>