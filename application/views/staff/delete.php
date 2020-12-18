<?php $this->setLayoutVar('title', 'スタッフ削除') ?>
<?php echo $this->render('login_header'); ?>

スタッフ削除<br />
<br />
スタッフコード<br />
<?php print $this->escape($code); ?>
<br />
スタッフ名<br />
<?php print $this->escape($name); ?>
<br />
このスタッフを削除してよろしいですか？<br />
<br />
<form method="post" action="/staff/delete_done">
    <input type="hidden" name="code" value="<?php print $this->escape($code); ?>">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" name="delete_done" value="OK">
</form>