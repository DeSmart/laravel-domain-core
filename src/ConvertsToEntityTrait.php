<?php namespace DeSmart\DomainCore;

use DeSmart\DomainCore\EntityTranslator;

trait ConvertsToEntityTrait
{

    public function getEntityClassName()
    {

        if (null !== $this->entityClassName) {
            return $this->entityClassName;
        }

        return (new EntityTranslator)->fromModel($this);
    }

    public function toEntity(array $data = null)
    {
        $className = $this->getEntityClassName();
        $mapper = new \JsonMapper;

        return $mapper->map($data ?: $this->toArray(), new $className);
    }
}
