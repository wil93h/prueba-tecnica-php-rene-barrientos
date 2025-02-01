<?php

use App\Database\DB;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $pdo = DB::getConnection();

    $query = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";

    $pdo->exec($query);

    echo "Table 'users' created successfully.";
} catch (Exception $e) {
    echo "Error creating table: " . $e->getMessage();
}