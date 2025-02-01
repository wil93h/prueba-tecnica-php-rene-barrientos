<?php

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
    public function testUserCanBeCreatedWithValidData()
    {
        $user = new User("René Barrientos", "rene.barrientos@example.com", "password");
        
        $this->assertEquals("René Barrientos", $user->getName());
        $this->assertEquals("rene.barrientos@example.com", $user->getEmail());
        $this->assertTrue(password_verify('password', $user->getPassword()));
    }

    public function testUserThrowsExceptionIfNameIsEmpty()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("", "rene.barrientos@example.com", "password");
    }

    public function testUserThrowsExceptionIfEmailIsInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("René Barrientos", "invalid-email", "password");
    }

    public function testUserThrowsExceptionIfPasswordIsTooShort()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("René Barrientos", "rene.barrientos@example.com", "123");
    }
}
