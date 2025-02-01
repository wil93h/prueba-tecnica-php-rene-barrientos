<?php

namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(array $data)
    {
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            throw new \InvalidArgumentException("All fields are required.");
        }
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException("Name is required.");
        }
        if (empty($this->email)) {
            throw new \InvalidArgumentException("Email is required.");
        }
        if (empty($this->password)) {
            throw new \InvalidArgumentException("Password is required.");
        }
    
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format.");
        }
    
        if (strlen($this->password) < 6) {
            throw new \InvalidArgumentException("Password must be at least 6 characters.");
        }
    }
}