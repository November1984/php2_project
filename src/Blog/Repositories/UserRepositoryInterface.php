<?php

namespace GeekBrains\MainLevel\Blog\Repositories;

use GeekBrains\MainLevel\Blog\Person\User;
use GeekBrains\MainLevel\Blog\UUID;

interface UserRepositoryInterface
{
    public function getByID(UUID $id): User;
    public function getByLogin(string $login): User;
    public function saveUser(User $user);
}
