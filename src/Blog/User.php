<?php

namespace GeekBrains\LevelTwo\Blog;

class User {
    function __construct(
        private int $id,
        private string $userName,
        private string $userLastName
        ){

    }
}