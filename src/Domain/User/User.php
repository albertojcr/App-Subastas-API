<?php

namespace IESLaCierva\Domain\User;

use IESLaCierva\Domain\User\Exceptions\EmailNotValidException;

class User implements \JsonSerializable
{
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(string $id, string $name, string $email, string $password, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function create(string $name, string $email, string $password, string $role): User
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new EmailNotValidException();
        }
        return new self(uniqid(), $name, $email, $password, $role );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function role(): string
    {
        return $this->role;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'email' => $this->email(),
            'role' => $this->role()
        ];
    }


}