<?php $this->setLayoutVar('title', '商品情報参照') ?>
<?php echo $this->render('login_header'); ?>
<?php echo $this->render('disp',[
    'item_name' => '商品',
    'attributes' => [
        '商品コード' => $this->escape($code),
        '商品名' => $this->escape($name),
        '価格' => $price . '円',
        '商品画像' => '<img src="/uploads/'.$image_name.'">']
]); ?>
