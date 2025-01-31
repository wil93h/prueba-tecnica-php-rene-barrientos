<?php

namespace App\Validation;

class UserValidator {
    public static function validate(array $data): array {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = 'El nombre es obligatorio.';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El correo electrónico no es válido.';
        }

        if (strlen($data['password']) < 6) {
            $errors[] = 'La contraseña debe tener al menos 6 caracteres.';
        }

        return $errors;
    }
}