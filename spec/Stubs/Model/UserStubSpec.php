<?php

namespace spec\DeSmart\DomainCore\Stubs\Model;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use DeSmart\DomainCore\Stubs\Entity\UserStubEntity;

class UserStubSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Stubs\Model\UserStub');
    }

    function it_returns_entity_class_name()
    {
        $this->getEntityClassName()->shouldReturn('DeSmart\DomainCore\Stubs\Entity\UserStubEntity');
    }

    function it_returns_entity_class_name_based_on_attribute()
    {
        $this->entityClassName = 'foo';
        $this->getEntityClassName()->shouldReturn('foo');
    }

    function it_converts_to_entity()
    {
        $this->name = 'Jon';
        $this->lastname = 'Snow';

        $entity = $this->toEntity();

        $entity->shouldHaveType(UserStubEntity::class);
        $entity->getName()->shouldReturn('Jon');
        $entity->getLastname()->shouldReturn('Snow');
    }

    function it_converts_to_entity_from_array_data()
    {
        $entity = $this->toEntity([
            'name' => 'Jon',
            'lastname' => 'Snow',
        ]);

        $entity->shouldHaveType(UserStubEntity::class);
        $entity->getName()->shouldReturn('Jon');
        $entity->getLastname()->shouldReturn('Snow');
    }
}
