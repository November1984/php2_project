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

    public function handle(array $rawInput)
    {
        $input = $this->parseRawInput($rawInput);
        
        $this->repository->saveUser(new User (
            UUID::random(),
            $input["login"],
            $input["firstname"],
            $input["lastname"]
        ));
        die;
    }

    private function parseRawInput(array $rawInput): array
    {
        $input = [];

        foreach ($rawInput as $argument)
        {
            $parts = explode("=", $argument);
            // Параметры, записанные через пробел, отбрасываются (# username=ab cd)
            if ((count($parts) !== 2) || ($parts[0] == "") || ($parts[1] == ""))
            {
                continue;
            }
            $input[$parts[0]] = $parts[1];
        }
        $err = false;
        $errMsg="";
        foreach (["login", "firstname", "lastname"] as $key) {
            if (!key_exists($key,$input))
            {
                $errMsg = $errMsg . "Ключ $key не найден" . PHP_EOL;
                $err=true;
            }
        }
        if ($err)
        {
            throw new CommandException($errMsg);
        }
        return $input;
    }
}