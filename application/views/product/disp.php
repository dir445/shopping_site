<?php $this->setLayoutVar('title', '商品情報参照') ?>
<?php echo $this->render('login_header'); ?>

商品情報参照<br />

<?php echo $this->render('product/info',[
    'code' => $this->escape($code),
    'name' => $this->escape($name),
    'price' => $this->escape($price),
    'image_name' => $this->escape($image_name)
]); ?>

<form>
    <input type="button" onclick="history.back()" value="戻る">
</form>

