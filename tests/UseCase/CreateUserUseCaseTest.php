<?php

use PHPUnit\Framework\TestCase;
use App\UseCase\CreateUserUseCase;
use App\Repository\UserRepositoryInterface;
use App\DTO\UserDTO;
use App\Entity\User;

class CreateUserUseCaseTest extends TestCase
{
    private CreateUserUseCase $useCase;
    private UserRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface ::class);
        $this->useCase = new CreateUserUseCase($this->repository);
    }

    public function testShouldCreateUserSuccessfully(): void
    {
        $request = new UserDTO([
            "name" => "René Barrientos",
            "email" => "rene.barrientos@example.com",
            "password" => "password"
        ]);

        $this->repository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(User::class)); 

        $this->useCase->execute($request);
    }

    public function testShouldThrowExceptionIfFieldsAreEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $request = new UserDTO(["name" => "", "email" => "", "password" => ""]);
        $this->useCase->execute($request);
    }

    public function testShouldThrowExceptionForInvalidEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $request = new UserDTO([
            "name" => "René Barrientos",
            "email" => "invalid-email",
            "password" => "securepassword"
        ]);

        $this->useCase->execute($request);
    }

    public function testShouldThrowExceptionForShortPassword(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $request = new UserDTO([
            "name" => "René Barrientos",
            "email" => "rene.barrientos@example.com",
            "password" => "123"
        ]);

        $this->useCase->execute($request);
    }
}