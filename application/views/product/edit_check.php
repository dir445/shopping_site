<?php $this->setLayoutVar('title', '商品修正') ?>
<?php echo $this->render('login_header'); ?>
<?php echo $this->render('errors', array('errors' => $errors)); ?>

商品名:<?php print $this->escape($name);?>
<br />
価格：<?php print $this->escape($price);?>
<br />
<img src="/uploads/<?php print $this->escape($image_name);?>">
<br />

<?php if(count($errors) === 0):?>
    <form method="post" action="/product/edit_done">
        <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
        <input type="hidden" name="code" value="<?php print $this->escape($code);?>">
        <input type="hidden" name="name" value="<?php print $this->escape($name);?>">
        <input type="hidden" name="price" value="<?php print $this->escape($price);?>">
        <input type="hidden" name="image_name" value="<?php print $this->escape($image_name);?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" name="edit_done" value="OK">
    </form>
<?php else:?>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
<?php endif;?>