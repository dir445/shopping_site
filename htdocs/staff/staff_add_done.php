<?php
require_once('staff.php');

$dbh = connect_shop_database();

$name = $_POST['name'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

add_staff($dbh,$name,$pass);


