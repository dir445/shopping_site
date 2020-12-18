<?php $this->setLayoutVar('title', 'スタッフ追加') ?>
<?php echo $this->render('login_header'); ?>
<?php echo $this->render('errors', ['errors' => $errors]); ?>

スタッフ名:<?php print $this->escape($name);?>
<br />

<?php if(count($errors) === 0):?>
    <form method="post" action="/staff/add_done">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <input type="hidden" name="name" value="<?php print $this->escape($name);?>">
    <input type="hidden" name="pass" value="<?php print $this->escape($pass_md5);?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" name="add_done" value="OK">
    </form>
<?php else:?>
    <form> 
        <input type="button" onclick="history.back()" value="戻る">
    </form>
<?php endif;?>