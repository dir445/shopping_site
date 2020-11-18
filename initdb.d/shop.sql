DROP SCHEMA IF EXISTS shop;
CREATE SCHEMA shop;
USE shop;

DROP TABLE IF EXISTS mst_staff;

CREATE TABLE mst_staff
(
    code INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(15),
    password VARCHAR(32)
);

INSERT INTO mst_staff (name, password) VALUES("Staff1","12345678901234567890123456789012");
INSERT INTO mst_staff (name, password) VALUES("Staff2","12345678901234567890123456789012");

DROP TABLE IF EXISTS mst_product;

CREATE TABLE mst_product
(
    code INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(30),
    price int,
    gazou VARCHAR(30)
);

INSERT INTO mst_product (name, price,gazou) VALUES("商品１",100,"");

DROP TABLE IF EXISTS dat_sales;

CREATE TABLE dat_sales
(
    code INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    date TIMESTAMP,
    name VARCHAR(15),
    email VARCHAR(50),
    postal1 VARCHAR(3),
    postal2 VARCHAR(4),
    address VARCHAR(50),
    tel VARCHAR(13)
);

DROP TABLE IF EXISTS dat_sales_product;

CREATE TABLE dat_sales_product
(
    code INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    code_seles INT,
    code_product INT,
    price INT,
    quantity INT
);

DROP TABLE IF EXISTS dat_member;

CREATE TABLE dat_member
(
    code INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    date TIMESTAMP,
    password VARCHAR(32),
    name VARCHAR(15),
    email VARCHAR(50),
    postal1 VARCHAR(3),
    postal2 VARCHAR(4),
    address VARCHAR(50),
    tel VARCHAR(13),
    danjo INT,
    born INT
);