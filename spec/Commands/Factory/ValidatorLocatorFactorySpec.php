<?php namespace spec\DeSmart\DomainCore\Commands\Factory;

use DeSmart\DomainCore\Stubs\RegisterUserCommand;
use DeSmart\DomainCore\Stubs\RegisterUserValidator;
use Illuminate\Contracts\Container\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValidatorLocatorFactorySpec extends ObjectBehavior
{
    public function let(Container $app)
    {
        $this->beConstructedWith($app);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Commands\Factory\ValidatorLocatorFactory');
        $this->shouldImplement('DeSmart\DomainCore\Commands\Factory\Contracts\ValidatorLocator');
    }

    public function it_should_return_validator_class_instance(Container $app, RegisterUserValidator $validator) {
        $class_name = preg_replace('/Command$/', 'Validator', RegisterUserCommand::class);
        $app->make($class_name)->willReturn($validator)->shouldBeCalled();

        $this->getValidatorForCommand(RegisterUserCommand::class)->shouldBe($validator);
    }

    public function it_should_throw_exception_when_handler_class_does_not_exist()
    {
        $class_name = preg_replace('/Command$/', 'FooBar', RegisterUserCommand::class);
        $this->getValidatorForCommand($class_name)->shouldReturn(null);
    }
}
