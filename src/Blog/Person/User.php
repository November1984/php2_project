<?php

namespace GeekBrains\MainLevel\Blog\Person;

use GeekBrains\MainLevel\Blog\UUID;

class User {
    private UUID $id;
    private string $userName;
    private ?string $userLastName;
    private ?string $userLogin;
    function __construct(   UUID   $id, 
                            string $userLogin, 
                            ?string $userName = null, 
                            ?string $userLastName = null)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->userLastName = $userLastName;
        $this->userLogin = $userLogin;
    }
    function __toString(){
        return $this->userName. " " . 
               $this->userLastName . " ака " . 
               $this->userLogin;
    }

    public function getLogin(): string
    {
        return $this->userLogin;
    }
    public function getId(): UUID
    {
        return $this->id;
    }
    public function getUserName(): string
    {
        return $this->userName;
    }
    public function getUserLastName(): ?string
    {
        return $this->userLastName;
    }
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }
    public function setUserLastName(?string $userLastName): self
    {
        $this->userLastName = $userLastName;

        return $this;
    }
}