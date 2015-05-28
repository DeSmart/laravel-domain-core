<?php

namespace spec\DeSmart\DomainCore\Stubs\Repository;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Illuminate\Support\Collection;

class ApiRepositoryStubSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Stubs\Repository\ApiRepositoryStub');
    }

    function it_hydrates_item()
    {
        $user = [
            'id' => 'foo',
        ];
        $hydrated = $this->hydrateItem($user, 'DeSmart\DomainCore\Stubs\Entity\ClientEntityStub');

        $hydrated->shouldHaveType('DeSmart\DomainCore\Stubs\Entity\ClientEntityStub');
        $hydrated->toArray()->shouldReturn($user);
    }

    function it_hydrates_collection()
    {
        $user = [
            'id' => 'foo',
        ];
        $collection = new Collection;
        $collection->push($user);

        $hydrated_collection = $this->hydrate($collection, 'DeSmart\DomainCore\Stubs\Entity\ClientEntityStub');
        $hydrated_collection->shouldHaveType('Illuminate\Support\Collection');

        $first = $hydrated_collection->first();
        $first->shouldHaveType('DeSmart\DomainCore\Stubs\Entity\ClientEntityStub');
        $first->toArray()->shouldBe($user);
    }
}
