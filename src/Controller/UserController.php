<?php

namespace App\Controller;

use App\UseCase\CreateUserUseCase;
use App\Repository\UserRepository;
use App\DTO\UserDTO;

class UserController
{
    private CreateUserUseCase $createUserUseCase;

    public function __construct()
    {
        $this->createUserUseCase = new CreateUserUseCase(new UserRepository());
    }

    // public function store()
    // {
    //     try {
    //         $data = json_decode(file_get_contents("php://input"), true);
    //         $request = new UserDTO($data);
    //         $this->createUserUseCase->execute($request);
    //         echo json_encode(["message" => "User created successfully"]);
    //     } catch (\Exception $e) {
    //         http_response_code(400);
    //         echo json_encode(["error" => $e->getMessage()]);
    //     }
    // }
    public function createUser(array $requestData): void {
        $userDTO = new UserDTO($requestData);
        $this->createUserUseCase->execute($userDTO);
    }
}