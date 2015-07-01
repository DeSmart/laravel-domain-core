<?php namespace DeSmart\DomainCore\Command\Factory\Contracts;

interface HandlerLocator
{
    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     * @return object
     *
     * @throws \DeSmart\DomainCore\Command\Exceptions\MissingHandlerException
     */
    public function getHandlerForCommand($commandName);
}
