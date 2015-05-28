<?php

namespace spec\DeSmart\DomainCore;

use DeSmart\DomainCore\Stubs\CommandStub;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasicCommandMapperSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\BasicCommandMapper');
    }
    
    function it_translates_command_to_handler()
    {
        $this->toCommandHandler(new \DeSmart\DomainCore\Stubs\Commands\CommandStub())->shouldReturn('DeSmart\DomainCore\Stubs\Commands\CommandStubHandler@handle');
    }
    
    function it_translates_command_to_handler_in_commands_namespace()
    {
        $this->toCommandHandler(new \DeSmart\DomainCore\Stubs\Commands\CommandStub())->shouldReturn('DeSmart\DomainCore\Stubs\Commands\CommandStubHandler@handle');
    }
    
    function it_translates_command_to_validator()
    {
        $this->toCommandValidator('App/Acme/SomeCommand')->shouldReturn('App/Acme/SomeCommandValidator');
    }

    function it_translates_command_to_validator_in_valitators_namespace()
    {
        $this->toCommandValidator('App/Validators/SomeCommand')->shouldReturn('App/Validators/SomeCommandValidator');
    }
}
