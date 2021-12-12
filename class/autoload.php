<?php

date_default_timezone_set('Asia/Bangkok');
header('HTTP/1.1 200 OK');
ob_start();


require_once './class/View.php';
require_once './class/backs.php';
require_once './class/routes.php';
require_once './class/Base.php';

//require_once './class/config.php';
require './controller/MasterController.php';
require './controller/AuthController.php';


$controller;
$action;
echo $controller;
if(isset($_GET['controller'])&&isset($_GET['action'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];   
}else{
    $controller="Master";
    $action="index"; 
}

$route = new routes();
$route->submit($controller, $action);
