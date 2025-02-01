<?php

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use App\UseCase\DeleteUserUseCase;
use App\Repository\UserRepositoryInterface;

class DeleteUserUseCaseTest extends TestCase
{
    private DeleteUserUseCase $useCase;
    private UserRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new DeleteUserUseCase($this->repository);
    }

    public function testShouldDeleteUserSuccessfully(): void
    {
      $user = new User("René Barrientos", "rene.barrientos@example.com", "password", 1);

      $this->repository->expects($this->once())
          ->method('findById')
          ->with(1)
          ->willReturn($user);

      $this->repository->expects($this->once())
          ->method('delete')
          ->with(1);

      $this->useCase->execute(1);
    }

    public function testShouldThrowExceptionIfUserNotFound(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        
        $this->repository->expects($this->once())
            ->method('findById')
            ->with(999)
            ->willReturn(null);

        $this->useCase->execute(999);
    }
}