<?php echo $this->render('disp',[
    'item_name' => '商品',
    'attributes' => [
        '商品コード' => $this->escape($code),
        '商品名' => $this->escape($name),
        '価格' => $price . '円'    ]
]); ?>

<!-- 商品情報参照<br />
<br />
商品コード<br />
<?php print $code; ?>
<br />
商品名<br />
<?php print $name; ?>
<br />
価格<br />
<?php print $price; ?> 円
<br />
<br />
<form>
    <input type="button" onclick="history.back()" value="戻る">
</form> -->