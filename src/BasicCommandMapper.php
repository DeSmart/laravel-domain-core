<?php

namespace DeSmart\DomainCore;

use DeSmart\DomainCore\Contracts\CommandMapper;

class BasicCommandMapper implements CommandMapper
{
    public function toCommandHandler($command)
    {
        $commandClassName = get_class($command);
        return $commandClassName . 'Handler@handle';
    }

    public function toCommandValidator($command)
    {
        return $command . 'Validator';
    }
}
