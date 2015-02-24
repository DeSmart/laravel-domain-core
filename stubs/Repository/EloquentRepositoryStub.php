<?php namespace DeSmart\DomainCore\Stubs\Repository;

use DeSmart\DomainCore\Contracts\EntityTranslatorInterface;
use DeSmart\DomainCore\Repository\AbstractEloquentRepository;

class EloquentRepositoryStub extends AbstractEloquentRepository
{
    protected $translator;

    public function setTranslator(EntityTranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    protected function getTranslator()
    {
        return $this->translator;
    }
}
