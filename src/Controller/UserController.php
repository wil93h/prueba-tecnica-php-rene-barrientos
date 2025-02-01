<?php

namespace App\Controller;

use App\UseCase\CreateUserUseCase;
use App\Repository\UserRepository;
use App\DTO\UserDTO;

class UserController
{
    private CreateUserUseCase $createUserUseCase;

    public function __construct()
    {
        $this->createUserUseCase = new CreateUserUseCase(new UserRepository());
    }

    public function createUser(array $requestData): void {
        $userDTO = new UserDTO($requestData);
        $this->createUserUseCase->execute($userDTO);
    }
}