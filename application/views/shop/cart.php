<?php $this->setLayoutVar('title', 'ショッピングカート');?>
ショッピングカート<br />

<?php if (isset($errors) && count($errors) > 0): ?>
    <?php echo $this->render('errors', array('errors' => $errors)); ?>
<?php endif; ?>

<br />
<?php if(count($products) == 0) : ?>
    カートに何も入っていません。
<?php else:?>
    <form method="post" action="/shop/update">
        <table border="1">
            <tr>
                <td>商品名</td>
                <td>商品画像</td>
                <td>価格</td>
                <td>数量</td>
                <td>小計</td>
                <td>削除</td>
            </tr>
            <?php foreach($products as $product): ?>
                <tr>
                    <td><?php print $product['name'];?></td>
                    <td><img src="/uploads/<?php print $product['image_name'];?>"></td>
                    <td><?php print $product['price'];?>円</td>
                    <td>
                        <input type="text" name="count<?php print $product['code'];?>" value="<?php print $product['count'];?>">個
                        <input type="submit" name="update" value="更新">
                    </td>
                    <td><?php print $product['price'] * $product['count']; ?>円</td>
                    <td>
                        <input type="submit" name="delete<?php print $product['code'];?>" value="削除">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>
<?php endif;?>
<br /><br />
<a href="/shop/list">商品一覧へ戻る</a>