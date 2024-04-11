<?php

namespace GeekBrains\MainLevel\Blog\Commands;

use GeekBrains\MainLevel\Blog\Exceptions\ArgumentsException;

final class Arguments
{
    private array $arguments = [];

    static public function fromArgv(array $argv): self
    {
        $arguments =[];

        foreach ($argv as $argument)
        {
            $parts = explode("=", $argument);
            // Параметры, записанные через пробел, отбрасываются (# username=ab cd)
            if ((count($parts) !== 2) || ($parts[0] == "") || ($parts[1] == ""))
            {
                continue;
            }
            $arguments[$parts[0]] = $parts[1];
        }
        return new self($arguments);
    }
    
    private function __construct(iterable $arguments)
    {
        foreach ($arguments as $argument => $value)
        {
            $stringValue = trim((string)$value);
            $this->arguments[(string)$argument] = $stringValue;
        }
    }
    public function get(string $argument): ?string
    {
        if (!array_key_exists($argument, $this->arguments))
        {
            return null;
            /* throw new ArgumentsException(
                "Аргумент не существует: $argument"
            ); */
        }
        return $this->arguments[$argument];
    }
}
