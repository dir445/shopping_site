<?php

class ShopController extends Controller {
    public function listAction() {
        $products = $this->db_manager->get('Product')->getAll();
        return $this->render(['products' => $products]);
    }

    public function productAction() {
        $code = $this->request->getGet('code');
        $result = $this->db_manager->get('Product')->get($code);
        $name = $result['name'];
        $price = $result['price'];
        $image_name = $result['image_name'];
        return $this->render([
            'code' => $code,
            'name' => $name,
            'price' => $price,
            'image_name' => $image_name]);
    }

    public function cartinAction() {
        $code = $this->request->getGet('code');
        $cart = $this->session->get('cart');
        
        $msg = 'その商品はすでにカートに入っています。';
        if(is_null($cart) || !array_key_exists($code , $cart)) {
            $msg = 'カートに追加しました。';
            $cart[$code] = 1;
            $this->session->set('cart' , $cart);
        }

        return $this->render([
            'title'=>'商品追加',
            'msg' => $msg,
            'backTo'=>'/shop'],
            'done');
    }

    public function cartAction() {
        $cart = $this->session->get('cart' , []);

        $products = $this->getCartProducts($cart);
        return $this->render(['products' => $products]);
    }

    public function updateAction() {
        $cart = $this->session->get('cart' , []);
        $errors = [];
        foreach($cart as $code => $count) {
            if(!is_null($this->request->getPost('delete' . $code))) {
                unset($cart[$code]);
                continue;
            }
            $new_count = $this->request->getPost('count' . $code, $count);
            if(preg_match("/\A[0-9]+\z/",$new_count) == 0 || $new_count < 0) {
                $errors[] = '数量に誤りがあります。';
                continue;
            }
            if($new_count == 0) {
                unset($cart[$code]);
                continue;
            }
            $cart[$code] = $new_count;
        }
        $this->session->set('cart' , $cart);
        $products = $this->getCartProducts($cart);
        return $this->render(['products' => $products,
                              'errors' => $errors],'cart');
    }

    function getCartProducts($cart) {
        $products = [];
        foreach($cart as $code => $count) {
            $product = $this->db_manager->get('Product')->get($code);
            $products[] = [
                'code' => $code,
                'count' => $count,
                'name' => $product['name'],
                'price' => $product['price'],
                'image_name' => $product['image_name']
            ];
        }
        return $products;
    }
}