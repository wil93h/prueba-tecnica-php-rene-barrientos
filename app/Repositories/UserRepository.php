<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    private array $users = [];
    private int $nextId = 1; 

    public function save(User $user): void {
        if ($user->getId() === 0) {
            $user->setId($this->nextId++);
        }
        $this->users[$user->getId()] = $user;
    }
    
    public function findAll(): array {
        return array_values($this->users);
    }
    
    public function findById(int $id): ?User {
        return $this->users[$id] ?? null; 
    }
    
    public function update(int $id, User $user): void {
        if (isset($this->users[$id])) {
            $existingUser = $this->users[$id];
            $existingUser->setName($user->getName());
            $existingUser->setEmail($user->getEmail());
            $existingUser->setPassword($user->getPassword());
        }
    }
    
    public function delete(int $id): void {
        if (isset($this->users[$id])) {
            unset($this->users[$id]);
        }
    }
}