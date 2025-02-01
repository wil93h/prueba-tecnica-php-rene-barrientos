<?php

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findAll(): array;
    public function findById(int $id): ?User;
    public function update(int $id, User $user): void;
    public function delete(int $id): void;
}