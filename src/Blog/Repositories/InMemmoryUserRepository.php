<?php

namespace GeekBrains\MainLevel\Blog\Repositories;

use Exception;
use GeekBrains\MainLevel\Blog\Exceptions\UserExistException;
use GeekBrains\MainLevel\Blog\Exceptions\UserNotFoundException;
use GeekBrains\MainLevel\Blog\Person\User;
use GeekBrains\MainLevel\Blog\UUID;

class InMemmoryUserRepository implements UserRepositoryInterface
{
    private array $users;
    public function getByID(UUID $id): User
    {
        foreach ($this->users as $user)
        {
            if ($user->getId() === $id)
            {
                return $user;
            }
        }
        throw new UserNotFoundException ("User not found.");
    }
    public function getByLogin(string $login): User
    {
        foreach ($this->users as $user)
        {
            if ($user->getLogin() === $login)
            {
                return $user;
            }
        }
        throw new UserNotFoundException ("User not found.");
    }
    public function saveUser(User $user)
    {
        if (!$this->isUserExist($user->getLogin()))
        {$this->users[] = $user;}
    }
    private function isUserExist(string $login): bool
    {
        foreach ($this->users as $userLogin)
        {
            if ($userLogin = $login)
            {return false;}
        }
        throw new UserExistException("Login is taken...");
    }


    public function getAllUsers(): array
    {
        return $this->users;
    }
    public function getUsersCount(): int
    {
        return count($this->users);
    }
}