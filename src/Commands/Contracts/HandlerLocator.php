<?php namespace DeSmart\DomainCore\Commands\Contracts;

interface HandlerLocator
{
    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     * @return object
     *
     * @throws \DeSmart\DomainCore\Commands\Exceptions\MissingHandlerException
     */
    public function getHandlerForCommand($commandName);
}
