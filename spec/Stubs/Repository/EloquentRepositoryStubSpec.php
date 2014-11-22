<?php

namespace spec\DeSmart\DomainCore\Stubs\Repository;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Illuminate\Support\Collection;
use DeSmart\DomainCore\Stubs\Model\UserStub;
use DeSmart\DomainCore\EntityTranslator;

class EloquentRepositoryStubSpec extends ObjectBehavior
{
    function let()
    {
        $this->setTranslator(new EntityTranslator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Stubs\Repository\EloquentRepositoryStub');
    }

    function it_hydrates_item()
    {
        $user = new UserStub;
        $hydrated = $this->hydrateItem($user);

        $hydrated->shouldHaveType('DeSmart\DomainCore\Stubs\Entity\UserStubEntity');
        $hydrated->getModel()->shouldReturn($user);
    }

    function it_hydrates_collection()
    {
        $user = new UserStub;
        $collection = new Collection;
        $collection->push($user);

        $hydrated_collection = $this->hydrate($collection);
        $hydrated_collection->shouldHaveType('Illuminate\Support\Collection');

        $first = $hydrated_collection->first();
        $first->shouldHaveType('DeSmart\DomainCore\Stubs\Entity\UserStubEntity');
        $first->getModel()->shouldBe($user);
    }
}
