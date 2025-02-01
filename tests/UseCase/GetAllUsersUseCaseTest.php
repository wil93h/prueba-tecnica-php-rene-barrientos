<?php

use PHPUnit\Framework\TestCase;
use App\UseCase\GetAllUsersUseCase;
use App\Repository\UserRepositoryInterface;
use App\Entity\User;

class GetAllUsersUseCaseTest extends TestCase
{
    private GetAllUsersUseCase $useCase;
    private UserRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new GetAllUsersUseCase($this->repository);
    }

    public function testShouldReturnAllUsersSuccessfully(): void
    {
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn([
                new User("René Barrientos", "rene.barrientos@example.com", "password", 1),
                new User("René Barrientos 2", "rene.barrientos.2@example.com", "password2", 2)
            ]);

        $users = $this->useCase->execute();

        $this->assertCount(2, $users);
        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertEquals(1, $users[0]->getId());
        $this->assertEquals(2, $users[1]->getId());
    }

    public function testShouldReturnEmptyArrayIfNoUsersFound(): void
    {
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $users = $this->useCase->execute();

        $this->assertCount(0, $users);
    }
}