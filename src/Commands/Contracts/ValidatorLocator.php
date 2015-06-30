<?php namespace DeSmart\DomainCore\Commands\Contracts; 

interface ValidatorLocator 
{
    /**
     * Retrieves the validator for a specified command
     *
     * @param string $commandName
     * @return null|object
     */
    public function getValidatorForCommand($commandName);
}
