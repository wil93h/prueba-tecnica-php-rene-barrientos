<?php

// Cargar el autoload de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Definir rutas simples para probar
if ($_SERVER['REQUEST_URI'] === '/users') {
    echo "Página de usuarios";
} else {
    echo "Bienvenido a la aplicación de gestión de usuarios.";
}