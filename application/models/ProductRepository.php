<?php

class ProductRepository extends DbRepository {
    public function insert($name,$price,$gazou) {
        $sql = 'INSERT INTO mst_product(name,price,gazou) VALUES(?,?,?)';
        $params = [$name , $price ,$image];
        $this->execute($sql,$params);
    }

    public function delete($code) {
        $sql = 'DELETE FROM mst_product WHERE code=?';
        $params = [$code];
        $this->execute($sql,$params);
    }

    public function get($code) {
        $sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
        $params = [$code];
        return $this->fetch($sql,$params);
    }

    public function getAll() {
        $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
        return $this->fetchAll($sql);
    }

    public function update($code,$name,$price,$gazou) {
        $sql = 'UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
        $params = [$name,$price,$gazou,$code];
        $this->execute($sql,$params);
    }
}