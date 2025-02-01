<?php

use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Database\DB;

class UserRepositoryTest extends TestCase
{
    private UserRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new UserRepository();
    }

    public function testShouldReturnAllUsers(): void
    {
        $user1 = new User("René Barrientos", "rene.barrientos@example.com", "password", null);
        $user2 = new User("Ana Pérez", "ana.perez@example.com", "securepassword", null);
        $this->repository->save($user1);
        $this->repository->save($user2);
    
        $users = $this->repository->findAll();
    
        $this->assertCount(2, $users);
        $this->assertEquals("René Barrientos", $users[0]['name']);
        $this->assertEquals("Ana Pérez", $users[1]['name']);
    }

    public function testShouldSaveUserSuccessfully(): void
    {
        $user = new User("René Barrientos", "rene.barrientos@example.com", "password", null);
        $userId = $this->repository->save($user);
    
        $savedUser = $this->repository->findById($userId);
        $this->assertNotNull($savedUser);
        $this->assertEquals("René Barrientos", $savedUser->getName());
    }

    public function testShouldFindUserById(): void
    {
        $user = new User("René Barrientos", "rene.barrientos@example.com", "password", null);
        $userId = $this->repository->save($user);

        $foundUser = $this->repository->findById($userId);
        $this->assertNotNull($foundUser);
        $this->assertEquals("René Barrientos", $foundUser->getName());
    }

    public function testShouldReturnNullIfUserNotFound(): void
    {
        $user = $this->repository->findById(999);
        $this->assertNull($user);
    }

    public function testShouldUpdateUserSuccessfully(): void
    {
        $user = new User("René Barrientos", "rene.barrientos@example.com", "password", null);
        $userId = $this->repository->save($user);
    
        $updatedUser = new User("René Barrientos Updated", "rene.updated@example.com", "newpassword", null);
        $this->repository->update($userId, $updatedUser);

        $userFromDb = $this->repository->findById($userId);
        $this->assertNotNull($userFromDb);
        $this->assertEquals("René Barrientos Updated", $userFromDb->getName());
        $this->assertEquals("rene.updated@example.com", $userFromDb->getEmail());
    }

    public function testShouldDeleteUserSuccessfully(): void
    {
        $user = new User("René Barrientos", "rene.barrientos@example.com", "password", null);
        $userId = $this->repository->save($user);
    
        $this->repository->delete($userId);
    
        $userFromDb = $this->repository->findById($userId);
        $this->assertNull($userFromDb);
    }
}