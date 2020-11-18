<?php
require_once('../common/common.php');
disp_member_login();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> ろくまる農園 </title>
</head>
<body>
    <?php
    try{
        $pro_code = $_GET['procode'];

        if(isset($_SESSION['cart']) == true) {
            $cart = $_SESSION['cart'];
            $kazu = $_SESSION['kazu'];
            if(in_array($pro_code,$cart)==true) {
                print 'その商品はすでにカートに入っています。<br />';
                print '<a href="shop_list.php">商品一覧へ戻る</a>';
                exit();
            }
        }       
        $cart[] = $pro_code;
        $kazu[] = 1;
        $_SESSION['cart'] = $cart;
        $_SESSION['kazu'] = $kazu;
    } catch(Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>

    カートに追加しました。<br />
    <br />
    <a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>