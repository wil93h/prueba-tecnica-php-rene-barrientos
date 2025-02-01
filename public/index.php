<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\UserController;

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($data && isset($data['name'], $data['email'], $data['password'])) {
        try {
            $controller = new UserController();
            $controller->createUser($data);
            echo json_encode(['message' => 'User created successfully']);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid input: name, email, and password are required']);
    }
} else {
    echo json_encode(['error' => 'Method Not Allowed. Only POST requests are allowed']);
}