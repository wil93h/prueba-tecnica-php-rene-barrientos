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
