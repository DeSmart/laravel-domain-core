<?php

namespace DeSmart\DomainCore;

use DeSmart\DomainCore\Contracts\CommandMapper;
use Illuminate\Contracts\Container\Container;

class ValidateCommand
{
    /**
     * @var Container
     */
    protected $app;
    
    /**
     * @var CommandMapper
     */
    protected $mapper;

    /**
     * @param Container     $app
     * @param CommandMapper $mapper
     */
    public function __construct(Container $app, CommandMapper $mapper)
    {
        $this->app = $app;
        $this->mapper = $mapper;
    }

    /**
     * Checks if validator for command exits and
     *
     * @param $command
     * @param $next
     *
     * @return mixed
     */
    public function handle($command, $next)
    {
        $validator_class = $this->mapper->toCommandValidator(get_class($command));

        if (true === class_exists($validator_class)) {
            $validator = $this->app->make($validator_class);
            $validator->validate($command);
        }
        
        return $next($command);
    }
}
