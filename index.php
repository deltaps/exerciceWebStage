<?php
set_include_path("./src");
require_once('src/Router.php');

$router = new Router();
$dsn = 'mysql:host=sql4.freemysqlhosting.net;dbname=sql4465366;charset=utf8mb4';
$bd = new PDO($dsn,"sql4465366","EyBu6WbYMw");
$accountStorage = new AccountStorageMySQL($bd);
$router->main($accountStorage,$bd);