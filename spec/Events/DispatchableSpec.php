<?php namespace spec\DeSmart\DomainCore\Events;

use DeSmart\DomainCore\Events\Contracts\Dispatcher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DispatchableSpec extends ObjectBehavior {

    function let()
    {
        $this->beAnInstanceOf(HandlerStub::class);
    }

    function it_dispatches_stuff(Dispatcher $dispatcher)
    {
        $this->setDispatcher($dispatcher);

        $this->dispatchEventsFor(new EntityStub);

        $dispatcher->dispatch([])->shouldBeCalled();
    }

}


class HandlerStub {
    use \DeSmart\DomainCore\Events\DispatchableTrait;
}

class EntityStub {

    public function releaseEvents()
    {
        return [];
    }

}