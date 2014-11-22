<?php

namespace spec\DeSmart\DomainCore;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use DeSmart\DomainCore\Stubs\Model\UserStub;

class EntityTranslatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\EntityTranslator');
    }

    function it_returns_entity_name_based_on_model()
    {
        $this->fromModel(new UserStub)->shouldReturn('DeSmart\DomainCore\Stubs\Entity\UserStubEntity');
    }
}
