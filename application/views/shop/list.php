<?php foreach($products as $product) :?>
    <a href="/shop/product?code=<?php print $product['code'];?>">
        <?php print $product['name'];?>---
        <?php print $product['price'];?>円
    </a><br/>
<?php endforeach;?>

<a href="/shop/cartlook">カートを見る</a><br />