<?php

session_start();
require_once './router.php';

$title = 'Home';
$page = $_GET['page'] ?? 'home';
$get = $_GET['get'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

$route = new Router();
$route->route($method, $page, $get, $_POST);