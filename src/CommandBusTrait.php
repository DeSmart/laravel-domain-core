<?php namespace DeSmart\DomainCore;

use Laracasts\Commander\CommandBus;

trait CommandBusTrait
{

    /**
    * @var \Laracasts\Commander\CommandBus
    */
    protected $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }
}
