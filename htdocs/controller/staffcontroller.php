<?php
require_once('model/staff.php');
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
        } else {
            $this->list();
        }    
    }

    function add_check() {
        $post = sanitize($_POST);
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $staff_pass2 = $post['pass2'];
        include('view/staff_add_check.php');
    }

    function add() {
        $post = sanitize($_POST);
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];

        $dbh = connect_shop_database();
        add_staff($dbh,$staff_name,$staff_pass);
        $dbh = null;

        include('view/staff_add_done.php');
    }


    function list() {
        $dbh = connect_shop_database();
        $result = get_staffs($dbh);
        $dbh = null;
        include('view/staff_list.php');        
    }
}