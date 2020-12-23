<?php $this->setLayoutVar('title', '商品削除') ?>
<?php echo $this->render('login_header'); ?>

商品削除<br />

<?php echo $this->render('product/info',[
    'code' => $this->escape($code),
    'name' => $this->escape($name),
    'price' => $this->escape($price),
    'image_name' => $this->escape($image_name)
]); ?>


<br />
この商品を削除してよろしいですか？<br />
<br />
<form method="post" action="/product/delete_done">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <input type="hidden" name="code" value="<?php print $code; ?>">
    <input type="hidden" name="image_name" value="<?php print $image_name; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
</form>