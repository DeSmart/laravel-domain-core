<?php namespace DeSmart\DomainCore;

use Illuminate\Support\Collection;
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

        if (null === $data) {
            $data = $this->toArrayWithoutRelations();
        }

        $data = (object) $data;

        $entity = $mapper->map($data, new $className);
        $this->mapEntityRelationships($entity);

        return $entity;
    }

    protected function mapEntityRelationships($entity)
    {

        if (true === empty($this->relations)) {
            return;
        }

        foreach ($this->relations as $name => $relations) {
            $uppercase = ucfirst($name);
            $method = 'set'.$uppercase;

            if (true === $relations instanceof Collection) {
                $relations = $relations->map(function ($item) {
                    return $item->toEntity();
                });

                $entity->$method(...$relations);
            } else {
                $entity->$method($relations->toEntity());
            }
        }
    }

    protected function toArrayWithoutRelations()
    {
        $data = $this->toArray();

        if (true === empty($this->relations)) {
            return $data;
        }

        foreach (array_keys($this->relations) as $name) {
            unset($data[$name]);
        }

        return $data;
    }
}
