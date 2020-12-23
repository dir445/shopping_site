<?php

class AccountController extends Controller {
    protected $auth_actions = ['top'];

    public function topAction() {
        return $this->render();
    }

    public function loginAction() {
        if ($this->session->isAuthenticated()) {
            return $this->redirect('/');
        }
        return $this->render([
            'code' => '',
            'pass' => '',
            '_token' => $this->generateCsrfToken('account/login')]);
    }

    public function authenticateAction() {
        if ($this->session->isAuthenticated()) {
            return $this->redirect('/');
        }

        if (!$this->request->isPost()) {
            $this->forward404();
        }

        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('account/login', $token)) {
            return $this->redirect('/');
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
                '_token' => $this->generateCsrfToken('account/login')
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

        return $this->redirect('/');
    }

}