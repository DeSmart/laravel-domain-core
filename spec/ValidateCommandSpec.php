<?php

namespace spec\DeSmart\DomainCore;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Contracts\Container\Container;
use DeSmart\DomainCore\BasicCommandMapper;
use DeSmart\DomainCore\Stubs\CommandStub;
use DeSmart\DomainCore\Stubs\CommandStubValidator;
use DeSmart\DomainCore\Stubs\CommandWithoutValidatorStub;

class ValidateCommandSpec extends ObjectBehavior
{
    function let(Container $container)
    {
        $mapper = new BasicCommandMapper();
        $this->beConstructedWith($container, $mapper);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\ValidateCommand');
    }
    
    function it_runs_next_function_in_pipe(CommandStub $commandStub)
    {
        $this->handle($commandStub, function ($param) { return $param; })->shouldReturn($commandStub);
    }
    
    function it_applies_validation_if_validator_exists(Container $container, CommandStubValidator $validatorStub)
    {
        $commandStub = new CommandStub;
        $container->make('DeSmart\DomainCore\Stubs\CommandStubValidator')->willReturn($validatorStub);
        $validatorStub->validate($commandStub)->shouldBeCalled();
        $this->handle($commandStub, function ($param) { return $param; });
    }
    
    function it_will_not_apply_validation_if_validator_doesnt_exist(Container $container)
    {
        $commandStub = new CommandWithoutValidatorStub;
        $container->make('DeSmart\DomainCore\Stubs\CommandWithoutValidatorStubValidator')->shouldNotBeCalled();
        $this->handle($commandStub, function ($param) { return $param; });
    }
}
