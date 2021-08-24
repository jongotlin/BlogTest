<?php

namespace App\Model;

class UsernameAndLoginCount
{
    private string $username;

    private int $loginCount;

    public function __construct(string $username, int $loginCount)
    {
        $this->username = $username;
        $this->loginCount = $loginCount;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLoginCount(): int
    {
        return $this->loginCount;
    }
}
