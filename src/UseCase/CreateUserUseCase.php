<?php

namespace App\UseCase;

use App\Repository\UserRepositoryInterface;
use App\Entity\User;
use App\DTO\UserDTO;

class CreateUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserDTO $request): void
    {
        $request->validate();
        $user = new User($request->name, $request->email, $request->password,null);
        $this->repository->save($user);
    }
}