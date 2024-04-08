<?php

namespace GeekBrains\MainLevel\Blog\Commands;

use GeekBrains\MainLevel\Blog\Person\User;
use GeekBrains\MainLevel\Blog\UUID;
use GeekBrains\MainLevel\Blog\Repositories\UserRepositoryInterface;
use GeekBrains\MainLevel\Blog\Exceptions\CommandException;

class CreateUserCommand
{
    public function __construct(
        private UserRepositoryInterface $repository
    )
    {}
    /**
     * Функция принимает массив из коммандной строки,
     * парсит его
     * запускает процесс создания пользователя
     */

    public function handle(array $input)
    {
        for ($i = 1; $i < count($input); $i++)
        {
            $part = mb_split("=", $input[$i]);
            // Параметры, записанные через пробел, отбрасываются
            if ((count($part) !== 2) || ($part[0] == "") || ($part[1] == ""))
            {
                continue;
            }
            $arr[$part[0]] = $part[1];
        }
        $err = false;
        $errMsg="";
        foreach (["login", "firstname", "lastname"] as $key) {
            if (!key_exists($key,$arr))
            {
                $errMsg = $errMsg . "Ключ $key не найден" . PHP_EOL;
                $err=true;
            }
        }
        if ($err)
        {
            throw new CommandException($errMsg);
        }
        
        $this->repository->saveUser(new User (
            UUID::random(),
            $arr["login"],
            $arr["firstname"],
            $arr["lastname"]
        ));
        die;
    }
}