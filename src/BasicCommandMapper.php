<?php

namespace DeSmart\DomainCore;

use DeSmart\DomainCore\Contracts\CommandMapper;

class BasicCommandMapper implements CommandMapper
{
    public function toCommandHandler($command)
    {
        return $command . 'Handler@handle';
    }

    public function toCommandValidator($command)
    {
        return $command . 'Validator';
    }
}
