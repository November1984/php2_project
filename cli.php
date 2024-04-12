<?php

use Faker\Extension\Extension;
use GeekBrains\LevelTwo\Blog\Commands\Arguments;
use GeekBrains\MainLevel\Blog\Commands\Arguments as CommandsArguments;
use GeekBrains\MainLevel\Blog\Commands\CreateUserCommand;
use GeekBrains\MainLevel\Blog\Exceptions\UserNotFoundException;
use GeekBrains\MainLevel\Blog\Person\User;
use GeekBrains\MainLevel\Blog\Comment;
use GeekBrains\MainLevel\Blog\Exceptions\CommandException;
use GeekBrains\MainLevel\Blog\Post;
use GeekBrains\MainLevel\Blog\Repositories\CommentsRepository;
use GeekBrains\MainLevel\Blog\Repositories\InMemmoryUserRepository;
use GeekBrains\MainLevel\Blog\Repositories\PostRepository;
use GeekBrains\MainLevel\Blog\Repositories\SQLUserRepository;
use GeekBrains\MainLevel\Blog\UUID;

require_once "vendor/autoload.php";

$connection = new PDO ("sqlite:src/Blog/blog.sqlite");


// реализация хранения пользователя в памяти
// $repository = new InMemmoryUserRepository();


$userRepository = new SQLUserRepository($connection);


$fake =  Faker\Factory::create("ru_RU");
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

// echo match ($argv[1]){
//     "user" => $user,
//     "post" => $post,
//     "comment" => $comment
// } . PHP_EOL;

// Обработка команды вида
//  php cli.php username=ivan first_name=Ivan last_name=Nikitin

$command = new CreateUserCommand($userRepository);

try
{
  if (false)
  {
    echo "i'm here";
    $command->handle(CommandsArguments::fromArgv($argv));
  }
}
catch (Exception $err)
{
  echo $err->getMessage().PHP_EOL;
  die;
}
try
{
  $user = $userRepository->getByLogin($argv[1]);}
catch (Exception $err)
{
  echo $err->getMessage().PHP_EOL;
  die;
}
try 
{
  $post = new Post(UUID::random(), $user->getId(), $fake->realText(rand(10,20)), $fake->realText(rand(50,100)), date("yyyy-mm-dd h:i"));
  $comment = new Comment(UUID::random(), $user->getId(), $post->getId(), $fake->realText(rand(30,40)), date("yyyy-mm-dd h:i"));
}
catch (Exception $err)
{
  echo $err->getMessage();
  die;
}
$postID = $post->getId();
$commentID = $comment->getId();

$postRepository = new PostRepository($connection);
$commentRepository = new CommentsRepository($connection);

$postRepository->save($post);
$commentRepository->save($comment);
var_dump($postRepository->get($postID));
var_dump($commentRepository->get($commentID));