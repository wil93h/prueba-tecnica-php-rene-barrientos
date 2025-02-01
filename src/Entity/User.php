<?php

namespace App\Entity;

class User
{
    private ?int $id;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name, string $email, string $password, ?int $id = null)
    {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException("Name cannot be empty.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format.");
        }

        if (strlen($password) < 6) {
            throw new \InvalidArgumentException("Password must be at least 6 characters.");
        }
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
}
