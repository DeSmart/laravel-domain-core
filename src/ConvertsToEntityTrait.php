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
            $data = array_diff_key($this->toArray(), $this->relations);
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
            $mapperMethod = $name.'ToEntity';

            // if there's no custom entity factories use the generic one
            if (false === method_exists($this, $mapperMethod)) {
                $mapperMethod = 'relationsToEntity';
            }

            $relations = $this->$mapperMethod($relations, $entity);

            if (true === is_array($relations) || true === $relations instanceof \Traversable) {
                $entity->$method(...$relations);
            } else {
                $entity->$method($relations);
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
