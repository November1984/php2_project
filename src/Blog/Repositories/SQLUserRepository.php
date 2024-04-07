<?php

namespace GeekBrains\MainLevel\Blog\Repositories;

use GeekBrains\MainLevel\Blog\Exceptions\UserExistException;
use GeekBrains\MainLevel\Blog\Exceptions\UserNotFoundException;
use GeekBrains\MainLevel\Blog\Person\User;
use GeekBrains\MainLevel\Blog\UUID;
use PDO;
use PDOStatement;

class SQLUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private PDO $pdo
    )
    {}
    public function getByID(UUID $id): User
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM users WHERE uuid = :uuid"
        );

        $statement->execute([
            ":uuid" => $id,
        ]);

        return $this->makeUser($statement, $id);
    }
    public function getByLogin(string $login): User
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM users WHERE login = :login"
        );

        $statement->execute([
            ":login" => strip_tags(htmlspecialchars_decode($login)),
        ]);

        return $this->makeUser($statement, $login);
    }
    public function saveUser(User $user)
    {
        if ($this->isUserNameExist($user->getLogin()))
        {
            $statement = $this->pdo->prepare(
                "INSERT INTO users (uuid, first_name, last_name, login) 
                VALUES            (:uuid, :first_name, :last_name, :login)");

            $statement->execute([
                ":uuid"       => (string) $user->getId(),
                ":first_name" => $user->getUserName(),
                ":last_name"  => $user->getUserLastName(),
                ":login"      => $user->getLogin(),
            ]);
        }
    }
    
    private function makeUser(PDOStatement $statement, string $value): User
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result === false)
        {
            throw new UserNotFoundException("User not found: ".$value);
        }
        
        return new User (new UUID ($result["uuid"]), 
                         $result["login"], 
                         $result["first_name"], 
                         $result["last_name"]);
    }
    private function isUserNameExist(string $user): bool
    {
        $statement = $this->pdo->prepare("SELECT * FROM users
                                          WHERE login = :login");
        $statement->execute([
            ":login" => strip_tags(htmlspecialchars_decode($user))
        ]);
        
        if (!$statement->fetch(PDO::FETCH_ASSOC))
        {
            return false;
        };

        throw new UserExistException ("Login is taken");
    }
}