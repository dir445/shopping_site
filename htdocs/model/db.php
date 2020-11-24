<?php

function connect_shop_database() {
    try {
        $dsn = 'mysql:dbname=shop;host=mysql;charset=utf8';
        $user = 'root';
        $password = 'password';
        $dbh = new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    } catch(Exception $e) {
        exit('データベースに接続できませんでした。:' + $e->getMessage());
    }
}

function execute_query($dbh, $sql , $params = []) {
    try {
        $stmt = $dbh->prepare($sql);
        return $stmt->execute($params);
    } catch(Exception $e) {
        exit('データを更新できませんでした。' + $e->getMessage());
    }

}

function fetch_query($dbh,$sql,$params = []) {
    try{
        $stmt = $dbh->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(Exception $e) {
        exit('データを取得できませんでした。' + $e->getMessage());
    }
}

function fetch_all_query($dbh, $sql, $params = []) {
    try{
        $stmt = $dbh->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch(Exception $e) {
        exit('データを取得できませんでした。' + $e->getMessage());
    }
}