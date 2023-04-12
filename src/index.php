<?php
require 'bootstrap/bootstrap.php';
use App\Controller\HierarchyController;

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");

$controller = new HierarchyController($_SERVER["REQUEST_METHOD"]);
$controller->processRequest();