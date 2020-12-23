<?php $this->setLayoutVar('title', '商品修正') ?>
<?php echo $this->render('login_header'); ?>

商品修正<br />

<?php if (isset($errors) && count($errors) > 0): ?>
    <?php echo $this->render('errors', array('errors' => $errors)); ?>
<?php endif;?>

変更する項目をチェックしてください。<br />
<br />
商品コード<br />
<?php print $this->escape($code); ?>
<br />
<form method="post" action="/product/edit_done" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <input type="hidden" name="code" value="<?php print $this->escape($code); ?>">
    商品名<input type="checkbox" name="changename" value="1"><br />
    <input type="text" name="name" style="width:200px" value="<?php print $this->escape($name);?>">
    <br />
    価格<input type="checkbox" name="changeprice" value="1"><br />
    <input type="text" name="price" style="width:200px" value="<?php print $this->escape($price);?>">
    <br />
    商品画像<input type="checkbox" name="changeimage" value="1"><br />
    <input type="file" name="image" style="width:400px">
    <br />
    <br />
    <input type="submit" name="back" value="戻る" formaction="/product/list">
    <input type="submit" name="edit_check" value="OK">
</form>