<?php $this->setLayoutVar('title', 'スタッフ追加') ?>

<?php

foreach($errors as $e) {
    print $e;
    print '<br />';
}
print 'スタッフ名：';
print $name;
print '<br />';

if(count($errors) === 0) {
    print '<form method="post" action="add_done">';
    print '<input type="hidden" name="name" value="'.$name.'">';
    print '<input type="hidden" name="pass" value="'.$pass_md5.'">';
    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" name="add_done" value="OK">';
    print '</form>';
} else {
    print '<form action="add">';
    print '<input type="submit" value="戻る">';
    print '</form>';
}
?>