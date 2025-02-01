<?php
namespace App\UseCase;

use App\Repository\UserRepositoryInterface;

class DeleteUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): void
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new \InvalidArgumentException("User not found");
        }

        $this->repository->delete($id);
    }
}