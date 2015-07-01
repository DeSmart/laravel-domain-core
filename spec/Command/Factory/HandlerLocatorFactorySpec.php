<?php namespace spec\DeSmart\DomainCore\Command\Factory;

use DeSmart\DomainCore\Stubs\RegisterUserCommand;
use DeSmart\DomainCore\Stubs\RegisterUserCommandHandler;
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
        $this->shouldHaveType('DeSmart\DomainCore\Command\Factory\HandlerLocatorFactory');
        $this->shouldImplement('DeSmart\DomainCore\Command\Factory\Contracts\HandlerLocator');
    }

    public function it_should_return_handler_class_instance(Container $app, RegisterUserCommandHandler $handler) {
        $class_name = sprintf('%sHandler', RegisterUserCommand::class);
        $app->make($class_name)->willReturn($handler)->shouldBeCalled();

        $this->getHandlerForCommand(RegisterUserCommand::class)->shouldBe($handler);
    }

    public function it_should_throw_exception_when_handler_class_does_not_exist()
    {
        $class_name = preg_replace('/Command$/', 'FooBar', RegisterUserCommand::class);

        $this->shouldThrow('DeSmart\DomainCore\Command\Exceptions\MissingHandlerException')
            ->during('getHandlerForCommand', [$class_name]);
    }
}
