<?php
use PHPUnit\Framework\TestCase;
use App\UseCase\GetUserByIdUseCase;
use App\Repository\UserRepositoryInterface;
use App\Entity\User;

class GetUserByIdUseCaseTest extends TestCase
{
    private GetUserByIdUseCase $useCase;
    private UserRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new GetUserByIdUseCase($this->repository);
    }

    public function testShouldReturnUserByIdSuccessfully(): void
    {

    $user = new User("René Barrientos", "rene.barrientos@example.com", "password", 1);

    $this->repository->expects($this->once())
        ->method('findById')
        ->with(1)
        ->willReturn($user);

    $result = $this->useCase->execute(1);

    $this->assertNotNull($result);
    $this->assertEquals("René Barrientos", $result->getName());
    }

    public function testShouldReturnNullIfUserNotFound(): void
    {
      $this->repository->expects($this->once())
      ->method('findById')
      ->with(999)
      ->willReturn(null);

      $this->expectException(\InvalidArgumentException::class);
      $this->expectExceptionMessage("User not found");

      $this->useCase->execute(999);
    }
}