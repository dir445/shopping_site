<?php $this->setLayoutVar('title', '商品情報') ?>

<a href="/shop/cartin?code=<?php print $this->escape($code);?>">カートに入れる</a>
<br /><br />

商品情報<br />

<?php echo $this->render('product/info',[
    'code' => $this->escape($code),
    'name' => $this->escape($name),
    'price' => $this->escape($price),
    'image_name' => $this->escape($image_name)
]); ?>

<form>
    <input type="button" onclick="history.back()" value="戻る">
</form>
