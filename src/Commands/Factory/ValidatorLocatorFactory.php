<?php namespace DeSmart\DomainCore\Commands\Factory;

use DeSmart\DomainCore\Commands\Contracts\ValidatorLocator;
use Illuminate\Contracts\Container\Container;

class ValidatorLocatorFactory implements ValidatorLocator
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
     * Retrieves the validator for a specified command
     *
     * @param string $commandName
     * @return null|object
     */
    public function getValidatorForCommand($commandName)
    {
        $class_name = preg_replace('/Command$/', 'Validator', $commandName);

        if (false === class_exists($class_name)) {
            return null;
        }

        return $this->app->make($class_name);
    }
}
