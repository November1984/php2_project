<?php

namespace GeekBrains\LevelTwo\Blog;

class User {
    private int $id;
    private string $userName;
    private string $userLastName;
    function __construct(int $id, string $userName, string $userLastName){
            $this->id = $id;
            $this->userName = $userName;
            $this->userLastName = $userLastName;
    }
    function __toString(){
        return $this->userName. " " . $this->userLastName;
    }

    public function getId(): int
    {
        return $this->id;
    }
}