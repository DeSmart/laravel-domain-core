<?php

namespace spec\DeSmart\DomainCore;

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
        $this->toCommandHandler('App/Acme/SomeCommand')->shouldReturn('App/Acme/SomeCommandHandler@handle');
    }
    
    function it_translates_command_to_handler_in_commands_namespace()
    {
        $this->toCommandHandler('App/Commands/SomeCommand')->shouldReturn('App/Commands/SomeCommandHandler@handle');
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
