<?php namespace spec\DeSmart\DomainCore\Commands\Factory;

use DeSmart\DomainCore\Stubs\RegisterUserCommand;
use DeSmart\DomainCore\Stubs\RegisterUserHandler;
use Illuminate\Contracts\Container\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandlerLocatorFactorySpec extends ObjectBehavior
{
    public function let(Container $app)
    {
        $this->beConstructedWith($app);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Commands\Factory\HandlerLocatorFactory');
        $this->shouldImplement('DeSmart\DomainCore\Commands\Contracts\HandlerLocator');
    }

    public function it_should_return_handler_class_instance(Container $app, RegisterUserHandler $handler) {
        $class_name = preg_replace('/Command$/', 'Handler', RegisterUserCommand::class);
        $app->make($class_name)->willReturn($handler)->shouldBeCalled();

        $this->getHandlerForCommand(RegisterUserCommand::class)->shouldBe($handler);
    }

    public function it_should_throw_exception_when_handler_class_does_not_exist()
    {
        $class_name = preg_replace('/Command$/', 'FooBar', RegisterUserCommand::class);

        $this->shouldThrow('DeSmart\DomainCore\Commands\Exceptions\MissingHandlerException')
            ->during('getHandlerForCommand', [$class_name]);
    }
}
