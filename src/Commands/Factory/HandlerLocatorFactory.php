<?php namespace DeSmart\DomainCore\Commands\Factory;

use DeSmart\DomainCore\Commands\Exceptions\MissingHandlerException;
use DeSmart\DomainCore\Commands\Factory\Contracts\HandlerLocator;
use Illuminate\Contracts\Container\Container;

class HandlerLocatorFactory implements HandlerLocator
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     * @return object
     *
     * @throws \DeSmart\DomainCore\Commands\Exceptions\MissingHandlerException
     */
    public function getHandlerForCommand($commandName)
    {
        $class_name = preg_replace('/Command$/', 'Handler', $commandName);

        if (false === class_exists($class_name)) {
            throw new MissingHandlerException("Class $class_name does not exist!");
        }

        return $this->app->make($class_name);
    }
}
