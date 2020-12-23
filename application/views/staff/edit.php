<?php $this->setLayoutVar('title', 'スタッフ修正') ?>
<?php echo $this->render('login_header'); ?>

スタッフ修正<br />

<?php if (isset($errors) && count($errors) > 0): ?>
    <?php echo $this->render('errors', array('errors' => $errors)); ?>
<?php endif;?>

変更する項目をチェックしてください。<br />
<br />
スタッフコード<br />
<?php print $this->escape($code); ?>
<br />
<form method="post" action="/staff/edit_done">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <input type="hidden" name="code" value="<?php print $this->escape($code); ?>">
    スタッフ名<input type="checkbox" name="changename" value="1"><br />
    <input type="text" name="name" style="width:200px" value="<?php print $this->escape($name);?>">
    <br /><br />
    パスワード<input type="checkbox" name="changepass" value="1"><br />
    <input type="password" name="pass" style="width:100px">
    <br />
    パスワードをもう一度入力してください<br />
    <input type="password" name="pass2" style="width:100px"><br />
    <br /><br />
    <input type="submit" name="back" value="戻る" formaction="/staff">
    <input type="submit" name="edit_check" value="OK">
</form>