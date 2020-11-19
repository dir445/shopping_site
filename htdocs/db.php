<?php

function connect_shop_database() {
    $dsn = 'mysql:dbname=shop;host=mysql;charset=utf8';
    $user = 'root';
    $password = 'password';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function execute_query($dbh, $sql , $params = []) {
    $stmt = $dbh->prepare($sql);
    return $stmt->execute(params);
}
