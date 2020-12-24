<?php $this->setLayoutVar('title', 'ショッピングカート');?>


カートの中身<br />
<br />
<form method="post" action="/shop/edit">
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
                <td><input type="text" name="kazu<?php print $product['code'];?>" value="<?php print $product['count'];?>"></td>
                <td><?php print $product['price'] * $product['count']; ?>円</td>
                <td><input type="checkbox" name="delete<?php print $product['code'];?>"></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>