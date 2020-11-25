<?php
require_once('db.php');

// function add_staff($dbh,$name,$password) {
//     $sql = 'INSERT INTO mst_staff(name,password) VALUES(?,?)';
//     $param = array($name , $password);
//     return execute_query($dbh,$sql,$param);
// }

// function get_staff($dbh,$code) {
//     $sql = 'SELECT name FROM mst_staff WHERE code=?';
//     $param = [$code];
//     return fetch_all_query($dbh,$sql,$param);
// }

// function get_staffs($dbh) {
//     $sql = 'SELECT code,name FROM mst_staff WHERE 1';
//     return fetch_all_query($dbh,$sql);
// }

// function update_staff($dbh,$code,$name,$pass) {
//     $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
//     $params = [$name,$pass,$code];
//     return execute_query($dbh,$sql,$params);
// }

// function delete_staff($dbh,$code) {
//     $sql = 'DELETE FROM mst_staff WHERE code=?';
//     $params = [$code];
//     return execute_query($dbh,$sql,$params);
// }

class StaffTable {
    function __construct() {
        $this->$dbh = connect_shop_database();
    }

    public function insert($name,$password) {
        $sql = 'INSERT INTO mst_staff(name,password) VALUES(?,?)';
        $param = [$name , $password];
        return execute_query($this->$dbh,$sql,$param);
    }

    public function delete($code) {
        $sql = 'DELETE FROM mst_staff WHERE code=?';
        $params = [$code];
        return execute_query($this->$dbh,$sql,$params);
    }

    public function get($code) {
        $sql = 'SELECT name,password FROM mst_staff WHERE code=?';
        $param = [$code];
        return fetch_query($this->$dbh,$sql,$param);
    }

    public function getName($code) {
        $sql = 'SELECT name FROM mst_staff WHERE code=?';
        $param = [$code];
        return fetch_query($this->$dbh,$sql,$param);
    }

    public function getAll() {
        $sql = 'SELECT code,name FROM mst_staff WHERE 1';
        return fetch_all_query($this->$dbh,$sql);
    }

    public function update($code,$name,$pass) {
        $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
        $params = [$name,$pass,$code];
        return execute_query($this->$dbh,$sql,$params);
    }
}