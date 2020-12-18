<?php $this->setLayoutVar('title', '商品一覧') ?>
<?php echo $this->render('login_header'); ?>

<?php echo $this->render('list',[
    'item_name' => '商品',
    'controller' => 'product',
    'items' => $products,
    'attributes' => ['name' => '名前','price' => '価格'],
    'code_key' => 'code'
]);?>