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

    protected function toArrayWithoutRelations()
    {
        return array_diff_key($this->toArray(), $this->relationsToArray());
    }

    protected function mapEntityRelationships($entity)
    {

        if (true === empty($this->relations)) {
            return;
        }

        foreach ($this->relations as $name => $relations) {
            $setterMethod = 'set'.ucfirst($name);
            $mapperMethod = $name.'ToEntity';

            if (false === method_exists($entity, $setterMethod)) {
                continue;
            }

            // if there's no custom entity factories use the generic one
            if (false === method_exists($this, $mapperMethod)) {
                $mapperMethod = 'relationsToEntity';
            }

            $relations = $this->$mapperMethod($relations, $entity);

            if (true === is_array($relations) || true === $relations instanceof \Traversable) {
                $entity->$setterMethod(...$relations);
            } else {
                $entity->$setterMethod($relations);
            }
        }
    }

    protected function relationsToEntity($items)
    {
        if (true === $items instanceof Collection) {

            return $items->map(function ($item) {
                return $item->toEntity();
            });
        }

        return $items->toEntity();
    }
}
