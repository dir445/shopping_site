<?php

class ProductController extends Controller {
    protected $auth_actions = ['list', 'disp', 'add' , 'add_check' , 'add_done' ,
                               'edit' , 'edit_check' , 'edit_done' , 'delete' , 'delete_done'];

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
        return $this->render(['_token' => $this->generateCsrfToken('product/add')]);
    }

    public function add_checkAction() {
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

        if(preg_match('/\A[0-9]+\z/',$price) == 0) {
            $errors[] = '価格が正しく入力されていません';
        }

        if( $image['size'] > 0) {
            if( $image['size'] > 1000000) {
                $errors[] = '画像が大きすぎます';
            }
            else {
                $tmpName = $image['tmp_name'];
                $tmpFilePath = './uploads/' . $image['name'];
                move_uploaded_file($tmpName,$tmpFilePath);
            }
        }

        return $this->render(['name' => $name,
                              'price' => $price,
                              'image_name' => $image['name'],
                              'errors' => $errors,
                              '_token' => $this->generateCsrfToken('product/add_check')]);
    }

    public function add_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('product/add_check', $token)) {
            return $this->redirect('/product');
        }

        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $image_name = $this->request->getPost('image_name');
        $this->db_manager->get('Product')->insert($name,$price,$image_name);

        return $this->render(['name'=>$name]);
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

    public function edit_checkAction() {
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

        $errors = [];
        $noChange = !$changeName && !$changePrice && !$changeImage;
        if($noChange) {
            $errors[] = '変更する項目がチェックされていません。';
        }
        if($changeName && $name=='') {
            $errors[] = 'スタッフ名が入力されていません。';
        }
        if($changePrice) {
            if(preg_match('/\A[0-9]+\z/',$price) == 0) {
                $errors[] = '価格が正しく入力されていません';
            }
        }
        if($changeImage) {
            if( $image['size'] > 1000000) {
                $errors[] = '画像が大きすぎます';
            }
            else {
                $tmpName = $image['tmp_name'];
                $tmpFilePath = './uploads/' . $image['name'];
                move_uploaded_file($tmpName,$tmpFilePath);
            }
        }

        $image_name = $image['name'];
        if(count($errors) === 0 && !$noChange) {
            $result = $this->db_manager->get('Product')->get($code);
            if(!$changeName) {
                $name = $result['name'];
            }
            if(!$changePrice) {
                $price = $result['price'];
            }
            if(!$changeImage) {
                $image_name = $result['image_name'];
            }
        }

        return $this->render(['errors' => $errors,
                              'code' => $code,
                              'name' => $name,
                              'price' => $price,
                              'image_name' => $image_name,
                              '_token' => $this->generateCsrfToken('product/edit_check')]);
    }

    public function edit_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('product/edit_check', $token)) {
            return $this->redirect('/product');
        }
        $code = $this->request->getPost('code');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $image_name = $this->request->getPost('image_name');

        $this->db_manager->get('Product')->update($code,$name,$price,$image_name);

        return $this->render();
    }

    public function deleteAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Staff')->getName($code);
        $name = $result['name'];
        return $this->render(['code' => $code,
                              'name' => $name,
                              '_token' => $this->generateCsrfToken('staff/delete')]);
    }

    public function delete_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('staff/delete', $token)) {
            return $this->redirect('/staff');
        }
        $code = $this->request->getPost('code');
        $this->db_manager->get('Staff')->delete($code);
        return $this->render();
    }

}