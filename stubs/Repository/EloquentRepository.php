<?php namespace DeSmart\DomainCore\Stubs\Repository;

use DeSmart\DomainCore\EntityTranslatorInterface;
use DeSmart\DomainCore\Repository\AbstractEloquentRepository;

class EloquentRepository extends AbstractEloquentRepository
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
