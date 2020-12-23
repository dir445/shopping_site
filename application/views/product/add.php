<?php $this->setLayoutVar('title', '商品追加') ?>
<?php echo $this->render('login_header'); ?>

商品追加 <br />

<?php if (isset($errors) && count($errors) > 0): ?>
    <?php echo $this->render('errors', array('errors' => $errors)); ?>
<?php endif;?>

<form method="post" action="/product/add_done" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    商品名<br />
    <input type="text" name="name" value="<?php print $this->escape($name);?>"><br />
    価格<br />
    <input type="text" name="price" value="<?php print $this->escape($price);?>"><br />
    画像<br />
    <input type="file" name="image" style="width:400px"><br />
    <br />
    <input type="submit" name="back" value="戻る" formaction="/product/list">
    <input type="submit" name="add_done" value="追加">
</form>