<?php
namespace App\UseCase;

use App\Repository\UserRepositoryInterface;
use App\Entity\User;

class GetUserByIdUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): ?User
    {
        $user = $this->repository->findById($id);
        
        if (!$user) {
            throw new \InvalidArgumentException("User not found");
        }

        return $user;
    }
}