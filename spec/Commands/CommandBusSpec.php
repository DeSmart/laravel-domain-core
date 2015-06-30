<?php namespace spec\DeSmart\DomainCore\Commands;

use DeSmart\DomainCore\Commands\Extractor\Contracts\CommandNameExtractor;
use DeSmart\DomainCore\Commands\Factory\Contracts\HandlerLocator;
use DeSmart\DomainCore\Commands\Factory\Contracts\ValidatorLocator;
use DeSmart\DomainCore\Stubs\RegisterUserCommand;
use DeSmart\DomainCore\Stubs\RegisterUserHandler;
use DeSmart\DomainCore\Stubs\RegisterUserValidator;
use Illuminate\Contracts\Container\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandBusSpec extends ObjectBehavior
{
    public function let(Container $app)
    {
        $this->beConstructedWith($app);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Commands\CommandBus');
        $this->shouldImplement('DeSmart\DomainCore\Commands\Contracts\CommandBus');
    }

    public function it_should_make_handler_and_validator(
        Container $app,
        RegisterUserCommand $command,
        RegisterUserHandler $handler,
        RegisterUserValidator $validator,
        HandlerLocator $handlerLocator,
        ValidatorLocator $validatorLocator,
        CommandNameExtractor $commandNameExtractor
    ) {
        $app->make('DeSmart\DomainCore\Commands\Factory\Contracts\ValidatorLocator')
            ->willReturn($validatorLocator);
        $app->make('DeSmart\DomainCore\Commands\Factory\Contracts\HandlerLocator')
            ->willReturn($handlerLocator);
        $app->make('DeSmart\DomainCore\Commands\Extractor\Contracts\CommandNameExtractor')
            ->willReturn($commandNameExtractor);

        $command_name = 'ExampleName';

        $commandNameExtractor->extract($command)->willReturn($command_name);
        $validatorLocator->getValidatorForCommand($command_name)->willReturn($validator);
        $handlerLocator->getHandlerForCommand($command_name)->willReturn($handler);

        $validator->validate($command)->shouldBeCalled();
        $handler->handle($command)->shouldBeCalled();

        $this->handle($command);
    }

    public function it_should_make_only_handler(
        Container $app,
        RegisterUserCommand $command,
        RegisterUserHandler $handler,
        HandlerLocator $handlerLocator,
        ValidatorLocator $validatorLocator,
        CommandNameExtractor $commandNameExtractor
    ) {
        $app->make('DeSmart\DomainCore\Commands\Factory\Contracts\ValidatorLocator')
            ->willReturn($validatorLocator);
        $app->make('DeSmart\DomainCore\Commands\Factory\Contracts\HandlerLocator')
            ->willReturn($handlerLocator);
        $app->make('DeSmart\DomainCore\Commands\Extractor\Contracts\CommandNameExtractor')
            ->willReturn($commandNameExtractor);

        $command_name = 'ExampleName';

        $commandNameExtractor->extract($command)->willReturn($command_name);
        $validatorLocator->getValidatorForCommand($command_name)->willReturn(null);
        $handlerLocator->getHandlerForCommand($command_name)->willReturn($handler);

        $handler->handle($command)->shouldBeCalled();
        $this->handle($command);
    }
}
