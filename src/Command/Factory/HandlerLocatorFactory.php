<?php namespace DeSmart\DomainCore\Command\Factory;

use DeSmart\DomainCore\Command\Exceptions\MissingHandlerException;
use DeSmart\DomainCore\Command\Factory\Contracts\HandlerLocator;
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
     * @throws \DeSmart\DomainCore\Command\Exceptions\MissingHandlerException
     */
    public function getHandlerForCommand($commandName)
    {
        $class_name = sprintf('%sHandler', $commandName);

        if (false === class_exists($class_name)) {
            throw new MissingHandlerException("Class $class_name does not exist!");
        }

        return $this->app->make($class_name);
    }
}
