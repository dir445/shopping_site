<?php

class StaffController extends Controller {
    protected $auth_actions = ['list', 'disp', 'add' , 'add_check' , 'add_done' ,
                               'edit' , 'edit_check' , 'edit_done' , 'delete' , 'delete_done'];

    public function listAction() {
        $staffs = $this->db_manager->get('Staff')->getAll();
        return $this->render(['staffs'=> $staffs]);              
    }

    public function dispAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Staff')->get($code);
        $name = $result['name'];
        return $this->render(['code'=>$code,'name'=>$name]);
    }

    public function addAction() {
        return $this->render();
    }

    public function add_checkAction() {
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

        $pass_md5 = md5($pass);

        return $this->render(['name' => $name,
                              'pass_md5' => $pass_md5,
                              'errors' => $errors,
                              '_token' => $this->generateCsrfToken('staff/add_check')]);
    }

    public function add_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('staff/add_check', $token)) {
            return $this->redirect('/staff');
        }

        $name = $this->request->getPost('name');
        $pass = $this->request->getPost('pass');
        $this->db_manager->get('Staff')->insert($name,$pass);

        return $this->render(['name'=>$name]);
    }

    public function editAction() {
        $code = $this->request->getPost('code');
        $result = $this->db_manager->get('Staff')->getName($code);
        $name = $result['name'];
        return $this->render(['code'=>$code,'name'=>$name]);
    }

    public function edit_checkAction() {
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

        $pass_md5 = md5($pass);
        if(count($errors) === 0 && (!$changeName || !$changePass)) {
            $result = $this->db_manager->get('Staff')->get($code);
            if(!$changeName) {
                $name = $result['name'];
            }
            if(!$changePass) {
                $pass_md5 = $result['password'];
            }
        }

        return $this->render(['errors' => $errors,
                              'code' => $code,
                              'name' => $name,
                              'pass_md5' => $pass_md5,
                              '_token' => $this->generateCsrfToken('staff/edit_check')]);
    }

    public function edit_doneAction() {
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('staff/edit_check', $token)) {
            return $this->redirect('/staff');
        }
        $code = $this->request->getPost('code');
        $name = $this->request->getPost('name');
        $pass = $this->request->getPost('pass');

        $this->db_manager->get('Staff')->update($code,$name,$pass);

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

    public function loginAction() {
        if ($this->session->isAuthenticated()) {
            return $this->redirect('/staff');
        }
        return $this->render([
            'code' => '',
            'pass' => '',
            '_token' => $this->generateCsrfToken('staff/login')]);
    }

    public function authenticateAction() {
        if ($this->session->isAuthenticated()) {
            return $this->redirect('/staff');
        }

        if (!$this->request->isPost()) {
            $this->forward404();
        }

        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('staff/login', $token)) {
            return $this->redirect('/staff/login');
        }
        
        $code = $this->request->getPost('code');
        $pass = $this->request->getPost('pass');
        
        $errors = [];
        $result = $this->db_manager->get('Staff')->get($code);
        if(!$result || $result['password'] !== md5($pass)) {
            $errors[] = 'スタッフコードかパスワードが間違っています。';
            return $this->render([
                'code' => $code,
                'pass' => $pass,
                'errors' => $errors,
                '_token' => $this->generateCsrfToken('staff/login')
            ], 'login');
        }

        $this->session->setAuthenticated(true);
        $this->session->set('login' , 1);
        $this->session->set('staff_code' , $code);
        $this->session->set('staff_name' , $result['name']);
        return $this->redirect('/');
    }

    public function logoutAction() {
        $this->session->clear();
        $this->session->setAuthenticated(false);

        return $this->redirect('/staff/login');
    }
}