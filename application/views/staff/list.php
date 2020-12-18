<?php $this->setLayoutVar('title', 'スタッフ一覧') ?>
<?php echo $this->render('login_header'); ?>

<?php echo $this->render('list',[
    'item_name' => 'スタッフ',
    'controller' => 'staff',
    'items' => $staffs,
    'attributes' => ['code' => 'コード','name' => '名前'],
    'code_key' => 'code'
]); ?>