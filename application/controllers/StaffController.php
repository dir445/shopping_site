<?php

class StaffController extends Controller {
    public function listAction() {
        $staffs = $this->db_manager->get('Staff')->getAll();
        return $this->render(['staffs'=> $staffs]);              
    }

    public function dispAction() {
        $code = $this->request->getPost('staffcode');
        if(is_null($code)) {

        }
        $result = $this->db_manager->get('Staff')->get($code);
        $name = $result['name'];
        return $this->render(['code'=>$code,'name'=>$name]);
    }

    public function addAction() {
        return $this->render();
    }

    public function addCheckAction() {
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

        if (count($errors) === 0) {
            $pass_md5 = md5($pass);
        }

        return $this->render(['name'=>$name,'pass_md5'=>$pass_md5,'errors'=>$errors]);
    }
}