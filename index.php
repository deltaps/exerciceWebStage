<?php
set_include_path("./src");
require_once('src/Router.php');

$router = new Router();
$dsn = 'mysql:host=mysql.info.unicaen.fr;dbname=21901956_bd;charset=utf8mb4';
$bd = new PDO($dsn,"21901956","Yae5aiKuphai6aiy");
$accountStorage = new AccountStorageMySQL($bd);
$router->main($accountStorage);