<?php namespace DeSmart\DomainCore\Commands;

use DeSmart\DomainCore\Commands\Contracts\CommandBus as CommandBusInterface;
use Illuminate\Contracts\Container\Container;

class CommandBus implements CommandBusInterface
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function handle($command)
    {
        $class_name = $this->getClassName($command);
        $validator = $this->getValidatorForCommand($class_name);

        if (null !== $validator) {
            $validator->validate($command);
        }

        $handler = $this->getHandlerForCommand($class_name);

        return $handler->handle($command);
    }

    /**
     * Retrieves the validator for a specified command
     *
     * @param $command
     * @return Object
     */
    private function getValidatorForCommand($command)
    {
        $factory = $this->app->make('DeSmart\DomainCore\Commands\Factory\Contracts\ValidatorLocator');

        return $factory->getValidatorForCommand($command);
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param $command
     * @return null|Object
     */
    private function getHandlerForCommand($command)
    {
        $factory = $this->app->make('DeSmart\DomainCore\Commands\Factory\Contracts\HandlerLocator');

        return $factory->getHandlerForCommand($command);
    }

    /**
     * Extract the name from a command
     *
     * @param $command
     * @return string
     */
    private function getClassName($command)
    {
        $extractor = $this->app->make('DeSmart\DomainCore\Commands\Extractor\Contracts\CommandNameExtractor');

        return $extractor->extract($command);
    }
}
