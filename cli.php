<?php

use GeekBrains\LevelTwo\Blog\Commands\Arguments;
use GeekBrains\MainLevel\Blog\Commands\Arguments as CommandsArguments;
use GeekBrains\MainLevel\Blog\Commands\CreateUserCommand;
use GeekBrains\MainLevel\Blog\Exceptions\UserNotFoundException;
use GeekBrains\MainLevel\Blog\Person\User;
use GeekBrains\MainLevel\Blog\Comment;
use GeekBrains\MainLevel\Blog\Exceptions\CommandException;
use GeekBrains\MainLevel\Blog\Post;
use GeekBrains\MainLevel\Blog\Repositories\InMemmoryUserRepository;
use GeekBrains\MainLevel\Blog\Repositories\SQLUserRepository;
use GeekBrains\MainLevel\Blog\UUID;

require_once "vendor/autoload.php";

$connection = new PDO ("sqlite:src/Blog/blog.sqlite");


// реализация хранения пользователя в памяти
// $repository = new InMemmoryUserRepository();


$repository = new SQLUserRepository($connection);


// $fake =  Faker\Factory::create("ru_RU");
// $user = new User(UUID::random(), "refremova", $fake->firstName(), $fake->lastName("female"));


// try
//   {$repository->saveUser($user);}
// catch (Exception $err)
//   {
//     echo $err->getMessage().PHP_EOL;
//     die;
//   }
// echo $i . PHP_EOL;
// echo ($repository->getUsersCount()) . PHP_EOL;
// try {
//   echo ($repository->getByID($user->getId())) . PHP_EOL;
//   echo ($repository->getByLogin($user->getLogin())) . PHP_EOL;
// }
// catch (UserNotFoundException $err)
// {
//   echo $err->getMessage().PHP_EOL;
//   die;
// }
// catch (Exception $err)
// {
//   echo "All alarms:" . PHP_EOL;
//   echo $err->getMessage().PHP_EOL;
//   die;
// }


// Обработка команды вида
//  php cli.php username=ivan first_name=Ivan last_name=Nikitin

$command = new CreateUserCommand($repository);

try
{$command->handle(CommandsArguments::fromArgv($argv));}
catch (Exception $err)
{
  echo $err->getMessage().PHP_EOL;
}
die;

$post = new Post(1, $user->getId(), $fake->realText(rand(10,20)), $fake->realText(rand(50,100)));
$comment = new Comment(1, $user->getId(), $post->getId(), $fake->realText(rand(30,40)));

echo match ($argv[1]){
    "user" => $user,
    "post" => $post,
    "comment" => $comment
} . PHP_EOL;


// Задача:
/* 
  +  Подключить базу данных
        +реализовать запись юзера в БД
        +реализовать чтение из БД
  +Реализовать паттерн Репозиторий
    Сделать обработчик комманд
*/