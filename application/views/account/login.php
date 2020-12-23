<?php $this->setLayoutVar('title', 'ログイン'); ?>

スタッフログイン<br />
<form method="post" action="/account/authenticate">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <?php if (isset($errors) && count($errors) > 0): ?>
        <?php echo $this->render('errors', array('errors' => $errors)); ?>
    <?php endif; ?>
    スタッフコード <br />
    <input type="text" name="code" value="<?php print $this->escape($code);?>" ><br />
    パスワード <br />
    <input type="password" name="pass" value="<?php print $this->escape($pass);?>"><br />
    <br />
    <input type="submit" value="ログイン">
</form>