<?php

require_once('db.php');

function add_staff($dbh,$name,$password) {
    $sql = 'INSERT INTO mst_staff(name,password) VALUES(?,?)';
    $param = [$name , $password];
    return execute_query($dbh,$sql,$param);
}

function get_staff($dbh,$code) {
    $sql = 'SELECT name FROM mst_staff WHERE code=?';
    $param = [$code];
    return execute_query($dbh,$sql,$param);
}

function update_staff($dbh,$code,$name,$pass) {
    $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
    $param = [$name,$pass,$code];
    return execute_query($dbh,$sql,$param);
}

function update_staff_name($dbh,$code,$name) {
    $sql = 'UPDATE mst_staff SET name=? WHERE code=?';
    $param = [$name,$code];
    return execute_query($dbh,$sql,$param);
}

function update_staff_pass($dbh,$code,$pass) {
    $sql = 'UPDATE mst_staff SET password=? WHERE code=?';
    $param = [$pass,$code];
    return execute_query($dbh,$sql,$param);
}

function delete_staff($dbh,$code) {
    $sql = 'DELETE FROM mst_staff WHERE code=?';
    $param = [$code];
    return execute_query($dbh,$sql,$param);
}
