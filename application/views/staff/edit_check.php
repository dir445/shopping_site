<?php $this->setLayoutVar('title', 'スタッフ修正') ?>

<?php
foreach($errors as $e) {
    print $e;
    print '<br />';
}
?>

スタッフ名:<?php print $name;?>
<br />

<?php if(count($errors) === 0):?>
    <form method="post" action="edit_done">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <input type="hidden" name="code" value="<?php print $code;?>">
    <input type="hidden" name="name" value="<?php print $name;?>">
    <input type="hidden" name="pass" value="<?php print $pass_md5;?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" name="edit_done" value="OK">
    </form>
<?php else:?>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
<?php endif;?>