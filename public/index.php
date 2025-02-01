<?php
// phpinfo();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\UserController;

header("Content-Type: application/json");

$controller = new UserController();
$controller->createUser($_POST);