<?php

class StaffController extends Controller {
    public function listAction() {
        $staffs = $this->$db_manager->get('Staff')->getAll();
        return $this->render(['staffs'=> $staffs]);              
    }

}