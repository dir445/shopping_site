<?php

class StaffRepository extends DbRepository {
    public function insert($name,$password) {
        $sql = 'INSERT INTO mst_staff(name,password) VALUES(?,?)';
        $params = [$name , $password];
        $this->execute($sql,$params);
    }

    public function delete($code) {
        $sql = 'DELETE FROM mst_staff WHERE code=?';
        $params = [$code];
        $this->execute($sql,$params);
    }

    public function get($code) {
        $sql = 'SELECT name,password FROM mst_staff WHERE code=?';
        $params = [$code];
        return $this->fetch($sql,$params);
    }

    public function getName($code) {
        $sql = 'SELECT name FROM mst_staff WHERE code=?';
        $params = [$code];
        return $this->fetch($sql,$params);
    }

    public function getAll() {
        $sql = 'SELECT code,name FROM mst_staff WHERE 1';
        return $this->fetchAll($sql);
    }

    public function update($code,$name,$pass) {
        $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
        $params = [$name,$pass,$code];
        $this->execute($sql,$params);
    }
}