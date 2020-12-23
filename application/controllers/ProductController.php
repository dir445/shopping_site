<?php

class ProductController extends Controller {
    protected $auth_actions = ['list', 'disp', 'add' , 'add_done',
                               'edit' , 'edit_done' , 'delete' , 'delete_done'];

    public function listAction() {
        $products = $this->db_manager->get('Product')->getAll();
        return $this->render([
            'item_name' => '商品',
            'controller' => 'product',
            'items' => $products,
            'attributes' => ['名前' => 'name' ,'価格（円）' => 'price'],
            'code_key' => 'code'],
            '../list');       
    }

    public function dispAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Product')->get($code);
        $name = $result['name'];
        $price = $result['price'];
        $image_name = $result['image_name'];
        return $this->render(['code' => $code,
                              'name' => $name,
                              'price' => $price,
                              'image_name' => $image_name]);
    }

    public function addAction() {
        return $this->render([
            'name' => '',
            'price' => '',
            '_token' => $this->generateCsrfToken('product/add')]);
    }

    public function add_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('product/add', $token)) {
            return $this->redirect('/product');
        }

        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $image = $_FILES['image'];

        $errors = [];
        if($name == '') {
            $errors[] = '商品名が入力されていません。';
        }

        if(checkPrice($price)) {
            $errors[] = '価格が正しく入力されていません';
        }

        if( $image['size'] > 1000000) {
            $errors[] = '画像が大きすぎます';
        }

        if(count($errors) != 0 ) {
            return $this->render([
                'errors' => $errors,
                'name' => $name,
                'price' => $price,
                '_token' => $this->generateCsrfToken('product/add')],
                'add');
        }

        $image_name = $image['name'];

        if( $image['size'] > 0) {
            $tmpName = $image['tmp_name'];
            $tmpFilePath = './uploads/' . $image_name;
            move_uploaded_file($tmpName,$tmpFilePath);
        }

        $this->db_manager->get('Product')->insert($name,$price,$image_name);

        return $this->render([
            'title'=>'商品追加',
            'msg' => $name . 'を追加しました。',
            'backTo'=>'/product'],
            '../done');
    }

    public function editAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Product')->get($code);
        $name = $result['name'];
        $price = $result['price'];
        $image_name = $result['image_name'];
        return $this->render(['code'  => $code,
                              'name'  => $name,
                              'price' => $price,
                              'image_name' => $image_name,
                              '_token' => $this->generateCsrfToken('product/edit')]);
    }

    public function edit_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('product/edit', $token)) {
            return $this->redirect('/product');
        }

        $code = $this->request->getPost('code');
        $changeName = $this->request->getPost('changename');
        $changePrice = $this->request->getPost('changeprice');
        $changeImage = $this->request->getPost('changeimage');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $image = $_FILES['image'];
        $image_name = $image['name'];

        $errors = [];
        $noChange = !$changeName && !$changePrice && !$changeImage;
        if($noChange) {
            $errors[] = '変更する項目がチェックされていません。';
        }
        if($changeName && $name=='') {
            $errors[] = 'スタッフ名が入力されていません。';
        }
        if($changePrice) {
            if(checkPrice($price)) {
                $errors[] = '価格が正しく入力されていません';
            }
        }
        if($changeImage) {
            if( $image['size'] > 1000000) {
                $errors[] = '画像が大きすぎます';
            }
        }

        if(count($errors) != 0){
            return $this->render([
                'errors' => $errors,
                'code'   => $code,
                'name'   => $name,
                'price'  => $price,
                'image_name' => $image_name,
                '_token' => $this->generateCsrfToken('product/edit')],
                'edit');
        }

        $repository = $this->db_manager->get('Product');
        $result = $repository->get($code);
        if(!$changeName) {
            $name = $result['name'];
        }
        if(!$changePrice) {
            $price = $result['price'];
        }
        if(!$changeImage) {
            $image_name = $result['image_name'];
        }
        $this->db_manager->get('Product')->update($code,$name,$price,$image_name);

        if($changeImage) {
            $prev_image_name =  $result['image_name'];
            if($prev_image_name != '' && !$repository->isImageUsed($prev_image_name)) {
                unlink('./uploads/'.$prev_image_name);
            }

            if( $image['size'] > 0) {
                $tmpName = $image['tmp_name'];
                $tmpFilePath = './uploads/' . $image_name;
                move_uploaded_file($tmpName,$tmpFilePath);
            }
        }

        return $this->render([
            'title'=>'商品修正',
            'msg' => '修正しました。',
            'backTo'=>'/product'],
            '../done');
    }

    public function deleteAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Product')->get($code);
        $name = $result['name'];
        $price = $result['price'];
        $image_name = $result['image_name'];
        return $this->render(['code' => $code,
                              'name' => $name,
                              'price' => $price,
                              'image_name' => $image_name,
                              '_token' => $this->generateCsrfToken('product/delete')]);
    }

    public function delete_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('product/delete', $token)) {
            return $this->redirect('/product');
        }
        $code = $this->request->getPost('code');
        $image_name = $this->request->getPost('image_name');

        $repository = $this->db_manager->get('Product');
        $repository->delete($code);

        if($image_name != '' && !$repository->isImageUsed($image_name)) {
            unlink('./uploads/'.$image_name);
        }

        return $this->render([
            'title'=>'商品削除',
            'msg' => '削除しました。',
            'backTo'=>'/product'],
            '../done');
    }

    private function checkPrice($price) {
        return preg_match('/\A[0-9]+\z/',$price) == 0;
    }

}