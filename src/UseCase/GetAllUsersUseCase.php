<?php
namespace App\UseCase;

use App\Repository\UserRepositoryInterface;
use App\Entity\User;

class GetAllUsersUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}