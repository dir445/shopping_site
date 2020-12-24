<?php $this->setLayoutVar('title', '商品一覧');?>

<?php foreach($products as $product) :?>
    <a href="/shop/product?code=<?php print $this->escape($product['code']);?>">
        <?php print $product['name'];?>---
        <?php print $product['price'];?>円
    </a><br/>
<?php endforeach;?>

<a href="/shop/cart">カートを見る</a><br />