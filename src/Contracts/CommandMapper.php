<?php
namespace DeSmart\DomainCore\Contracts;

interface CommandMapper
{
    public function toCommandHandler($command);

    public function toCommandValidator($command);
}