<?php

class ProductRepository extends DbRepository {
    public function insert($name,$price,$image_name) {
        $sql = 'INSERT INTO mst_product(name,price,image_name) VALUES(?,?,?)';
        $params = [$name , $price ,$image_name];
        $this->execute($sql,$params);
    }

    public function delete($code) {
        $sql = 'DELETE FROM mst_product WHERE code=?';
        $params = [$code];
        $this->execute($sql,$params);
    }

    public function get($code) {
        $sql = 'SELECT name,price,image_name FROM mst_product WHERE code=?';
        $params = [$code];
        return $this->fetch($sql,$params);
    }

    public function getAll() {
        $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
        return $this->fetchAll($sql);
    }

    public function update($code,$name,$price,$image_name) {
        $sql = 'UPDATE mst_product SET name=?,price=?,image_name=? WHERE code=?';
        $params = [$name,$price,$image_name,$code];
        $this->execute($sql,$params);
    }
}