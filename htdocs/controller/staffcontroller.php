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
        } elseif(isset($_POST['edit_check'])) {
            $this->edit_done();
        } else {
            $this->list();
        }    
    }

    function add_check() {
        $post = sanitize($_POST);
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $staff_pass2 = $post['pass2'];
        // $csfr_token = set_csfr_token();
        include('view/staff_add_check.php');
    }

    function add() {
        $post = sanitize($_POST);
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];

        $staffTable = new StaffTable();
        $staffTable->insert($staff_name,$staff_pass);
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
        $result = $staffTable->get($code);
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
        $result = $staffTable->get($code);
        $name = $result['name'];

        include('view/staff_edit_form.php');
    }

    function edit_check() {
        $post = sanitize($_POST);
        $staf_code = $post['code'];

        $changeName = isset($post['changename']);

        if($changeName) {
            $staff_name = $post['name'];
        } else {
            $staffTable = new StaffTable();
            $result = $staffTable->get($code);
            $staff_name = $result['name'];
        }

        $changePass = isset($post['changepass']);
        $staff_pass = $post['pass'];
        $staff_pass2 = $post['pass2'];

        include('view/staff_edit_check.php');
    }

    function list() {
        $staffTable = new StaffTable();
        $result = $staffTable->getAll();
        include('view/staff_list.php');    
    }
}