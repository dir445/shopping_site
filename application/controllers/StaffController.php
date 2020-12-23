<?php

class StaffController extends Controller {
    protected $auth_actions = ['list', 'disp', 'add' , 'add_done' ,
                               'edit' , 'edit_done' , 'delete' , 'delete_done'];

    public function listAction() {
        $staffs = $this->db_manager->get('Staff')->getAll();

        return $this->render([
            'item_name' => 'スタッフ',
            'controller' => 'staff',
            'items' => $staffs,
            'attributes' => ['コード' => 'code','名前' => 'name'],
            'code_key' => 'code'],
            '../list');            
    }

    public function dispAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Staff')->get($code);
        $name = $result['name'];
        return $this->render([
            'code'=>$code,
            'name'=>$name]);
    }

    public function addAction() {
        return $this->render([
            'name' => '',
            '_token' => $this->generateCsrfToken('staff/add')]);
    }

    public function add_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('staff/add', $token)) {
            return $this->redirect('/staff');
        }

        $name = $this->request->getPost('name');
        $pass = $this->request->getPost('pass');
        $pass2 = $this->request->getPost('pass2');

        $errors = [];
        if($name == '') {
            $errors[] = 'スタッフ名が入力されていません。';
        }
        if($pass == '') {
            $errors[] = 'パスワードが入力されていません';
        }
        if($pass != $pass2) {
            $errors[] = 'パスワードが一致しません';
        }

        if(count($errors) != 0) {
            return $this->render([
                'name' => '',
                'errors' => $errors,
                '_token' => $this->generateCsrfToken('staff/add')],'add');
        }

        $pass_md5 = md5($pass);
        $this->db_manager->get('Staff')->insert($name,$pass);

        return $this->render([
            'title'=>'スタッフ追加',
            'msg' => $name . 'さんを追加しました。',
            'backTo'=>'/staff'
        ],'../done');
    }

    public function editAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Staff')->getName($code);
        $name = $result['name'];
        return $this->render([
            'code'=>$code,
            'name'=>$name,
            '_token' => $this->generateCsrfToken('staff/edit')]);
    }

    public function edit_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('staff/edit', $token)) {
            return $this->redirect('/staff');
        }

        $code = $this->request->getPost('code');
        $changeName = $this->request->getPost('changename');
        $changePass = $this->request->getPost('changepass');
        $name = $this->request->getPost('name');
        $pass = $this->request->getPost('pass');
        $pass2 = $this->request->getPost('pass2');

        $errors = [];
        if(!$changeName && !$changePass) {
            $errors[] = '変更する項目がチェックされていません。';
        }
        if($changeName && $name=='') {
            $errors[] = 'スタッフ名が入力されていません。';
        }
        if($changePass) {
            if($pass == '') {
                $errors[] = 'パスワードが入力されていません。';
            }
            if($pass != $pass2) {
                $errors[] = 'パスワードが一致しません。>';
            }
        }

        if(count($errors) != 0) {
            return $this->render([
                'code'   => $code,
                'name'   => $name,
                'errors' => $errors,
                '_token' => $this->generateCsrfToken('staff/edit')],'edit');
        }

        $pass_md5 = md5($pass);
 
        $repository = $this->db_manager->get('Staff');       
        if(!$changeName || !$changePass) {
            $result = $repository->get($code);
            if(!$changeName) {
                $name = $result['name'];
            }
            if(!$changePass) {
                $pass_md5 = $result['password'];
            }
        }

        $repository->update($code,$name,$pass_md5);

        return $this->render([
            'title'=>'スタッフ修正',
            'msg' => '修正しました。',
            'backTo'=>'/staff'
        ],'../done');
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

        return $this->render([
            'title'=>'スタッフ削除',
            'msg' => '削除しました。',
            'backTo'=>'/staff'
        ],'../done');
    }
}