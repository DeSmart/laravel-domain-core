<?php namespace spec\DeSmart\DomainCore\Command\Extractor;

use DeSmart\DomainCore\Stubs\RegisterUserCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassNameExtractorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Command\Extractor\ClassNameExtractor');
        $this->shouldImplement('DeSmart\DomainCore\Command\Extractor\Contracts\CommandNameExtractor');
    }

    public function it_return_class_name()
    {
        $command = new RegisterUserCommand;

        $this->extract($command)->shouldReturn('DeSmart\DomainCore\Stubs\RegisterUserCommand');
    }
}
