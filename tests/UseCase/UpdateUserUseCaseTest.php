<?php
use PHPUnit\Framework\TestCase;
use App\UseCase\UpdateUserUseCase;
use App\Repository\UserRepositoryInterface;
use App\DTO\UserDTO;
use App\Entity\User;

class UpdateUserUseCaseTest extends TestCase
{
    private UpdateUserUseCase $useCase;
    private UserRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new UpdateUserUseCase($this->repository);
    }

    public function testShouldUpdateUserSuccessfully(): void
    {
      $user = new User("René Barrientos", "rene.barrientos@example.com", "password", 1);

      $userDTO = new UserDTO([
          "name" => "René Barrientos Updated",
          "email" => "rene.updated@example.com",
          "password" => "newpassword"
      ]);

      $this->repository->expects($this->once())
          ->method('findById')
          ->with(1)
          ->willReturn($user);

      $this->repository->expects($this->once())
          ->method('update')
          ->with(1, $this->isInstanceOf(User::class));

      $this->useCase->execute(1, $userDTO);
    }

    public function testShouldThrowExceptionIfUserNotFound(): void
    {
      $userDTO = new UserDTO([
          "name" => "René Barrientos",
          "email" => "rene.barrientos@example.com",
          "password" => "newpassword"
      ]);

    $this->repository->expects($this->once())
        ->method('findById')
        ->with(1)
        ->willReturn(null);

    $this->expectException(\InvalidArgumentException::class);

    $this->useCase->execute(1, $userDTO);
    }
}