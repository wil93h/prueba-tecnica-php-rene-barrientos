<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Validation\UserValidator;

class UserService {
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data) {
        $errors = UserValidator::validate($data);
        if (!empty($errors)) {
            return ['errors' => $errors];
        }

        $dto = new UserDTO($data['name'], $data['email'], $data['password']);
        $user = new User($dto->name, $dto->email, password_hash($dto->password, PASSWORD_DEFAULT));
        $this->userRepository->save($user);

        return ['message' => 'Usuario creado exitosamente.'];
    }
}