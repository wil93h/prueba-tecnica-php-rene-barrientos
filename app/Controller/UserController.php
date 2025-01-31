<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController {
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function store() {
        $data = $_POST;
        $response = $this->userService->createUser($data);
        echo json_encode($response);
    }
}