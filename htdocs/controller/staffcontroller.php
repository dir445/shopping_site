<?php
require_once('model/staffTable.php');
require_once('common/common.php');

class StaffController {
    function __construct() {

    }

    public function mvcHandler() {
        if(isset($_POST['add'])) {
            include('view/staff_add_form.php');
        } elseif(isset($_POST['add_check'])) {
            $this->add_check();
        } elseif(isset($_POST['add_done'])) {
            $this->add();
        } elseif(isset($_POST['disp'])) {
            $this->disp();
        } elseif(isset($_POST['delete'])) {
            $this->delete_check();
        } elseif(isset($_POST['delete_done'])) {
            $this->delete();
        } elseif(isset($_POST['edit'])) {
            $this->edit_form();
        } elseif(isset($_POST['edit_check'])) {
            $this->edit_check();
        } elseif(isset($_POST['edit_done'])) {
            $this->edit_done();
        } else {
            $this->list();
        }    
    }

    function add_check() {
        $post = sanitize($_POST);
        $name = $post['name'];
        $pass = $post['pass'];
        $pass2 = $post['pass2'];
        $pass_md5 = md5($pass);
        // $csfr_token = set_csfr_token();
        include('view/staff_add_check.php');
    }

    function add() {
        $post = sanitize($_POST);
        $name = $post['name'];
        $pass = $post['pass'];
        
        $staffTable = new StaffTable();
        $staffTable->insert($name,$pass);
        include('view/staff_add_done.php');
    }

    function disp() {        
        if(isset($_POST['staffcode'])==false) {
            include('view/staff_ng.php');
            exit();
        }
        $post = sanitize($_POST);
        $code = $_POST['staffcode'];

        $staffTable = new StaffTable();
        $result = $staffTable->get($code);
        $name = $result['name'];
        include('view/staff_disp.php');    
    }

    function delete_check() {
        if(isset($_POST['staffcode'])==false) {
            include('view/staff_ng.php');
            exit();
        }
        $post = sanitize($_POST);
        $code = $_POST['staffcode'];

        $staffTable = new StaffTable();
        $result = $staffTable->getName($code);
        $name = $result['name'];
        // $csfr_token = set_csfr_token();
        include('view/staff_delete.php');       
    }

    function delete() {
        $post = sanitize($_POST);
        $code = $post['code'];

        $staffTable = new StaffTable();
        $staffTable->delete($code);
        
        include('view/staff_delete_done.php');       
    }

    function edit_form() {
        if(isset($_POST['staffcode'])==false) {
            include('view/staff_ng.php');
            exit();
        }
        $post = sanitize($_POST);
        $code = $_POST['staffcode'];

        $staffTable = new StaffTable();
        $result = $staffTable->getName($code);
        $name = $result['name'];

        include('view/staff_edit_form.php');
    }

    function edit_check() {
        $post = sanitize($_POST);
        $code = $post['code'];
        $name = $post['name'];
        $pass = $post['pass'];
        $pass2 = $post['pass2'];
        $pass_md5 = md5($pass);
        $changeName = isset($post['changename']);
        $changePass = isset($post['changepass']);

        if(!$changeName || !$changePass) {
            $staffTable = new StaffTable();
            $result = $staffTable->get($code);
            if(!$changeName) {
                $name = $result['name'];       
            }
            if(!$changePass) {
                $pass_md5 = $result['password'];
            }
        } 
        include('view/staff_edit_check.php');
    }

    function edit_done() {        
        $post = sanitize($_POST);
        $code = $post['code'];
        $name = $post['name'];
        $pass = $post['pass'];

        $staffTable = new StaffTable();
        $success = $staffTable->update($code,$name,$pass);
        include('view/staff_edit_done.php'); 
    }

    function list() {
        $staffTable = new StaffTable();
        $result = $staffTable->getAll();
        include('view/staff_list.php');    
    }
}