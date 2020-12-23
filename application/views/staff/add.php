<?php $this->setLayoutVar('title', 'スタッフ追加') ?>

<?php echo $this->render('login_header'); ?>

スタッフ追加 <br />

<?php if (isset($errors) && count($errors) > 0): ?>
    <?php echo $this->render('errors', array('errors' => $errors)); ?>
<?php endif;?>

<form method="post" action="/staff/add_done">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    スタッフ名<br />
    <input type="text" name="name" value="<?php print $this->escape($name);?>"><br />
    パスワード<br />
    <input type="password" name="pass"><br />
    パスワード（確認）<br />
    <input type="password" name="pass2"><br />
    <input type="submit" name="back" value="戻る" formaction="/staff">
    <input type="submit" name="add_check" value="追加">
</form>    