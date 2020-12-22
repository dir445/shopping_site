<?php $this->setLayoutVar('title', '商品追加') ?>
<?php echo $this->render('login_header'); ?>

商品追加 <br />
<form method="post" action="/product/add_check" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    商品名<br />
    <input type="text" name="name"><br />
    価格<br />
    <input type="text" name="price"><br />
    画像<br />
    <input type="file" name="image" style="width:400px"><br />
    <br />
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" name="add_check" value="追加">
</form>