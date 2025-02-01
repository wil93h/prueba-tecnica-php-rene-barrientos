<?php
namespace App\UseCase;

use App\Repository\UserRepositoryInterface;
use App\DTO\UserDTO;
use App\Entity\User;

class UpdateUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id, UserDTO $userDTO): void
    {
        $userDTO->validate();

        $user = $this->repository->findById($id);
        
        if (!$user) {
            throw new \InvalidArgumentException("User not found");
        }

        $updatedUser = new User(
            $userDTO->name,
            $userDTO->email,
            $userDTO->password,
            $user->getId() // Ensure we use the existing user's ID
        );

        $this->repository->update($id, $updatedUser);
    }
}
