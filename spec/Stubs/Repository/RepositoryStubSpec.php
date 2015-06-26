<?php

namespace spec\DeSmart\DomainCore\Stubs\Repository;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use DeSmart\DomainCore\Stubs\Model\UserStub;
use DeSmart\DomainCore\Stubs\Entity\UserStubEntity;

class RepositoryStubSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([
            new UserStub('Jon', 'Snow'),
            new UserStub('Bob', 'The builder'),
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Stubs\Repository\RepositoryStub');
    }

    function it_returns_entities_from_array()
    {
        $entities = $this->fromArray();
        $entities[0]->shouldHaveType(UserStubEntity::class);
        $entities[1]->shouldHaveType(UserStubEntity::class);
        $entities[0]->getName()->shouldReturn('Jon');
        $entities[1]->getName()->shouldReturn('Bob');
    }

    function it_returns_entities_from_collection()
    {
        $entities = $this->fromCollection();
        $entities[0]->shouldHaveType(UserStubEntity::class);
        $entities[1]->shouldHaveType(UserStubEntity::class);
        $entities[0]->getName()->shouldReturn('Jon');
        $entities[1]->getName()->shouldReturn('Bob');
    }
}
