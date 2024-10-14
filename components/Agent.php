<?php

namespace app\components;

class Agent
{
    private string $name;
    private int $age;
    private string $email;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
}