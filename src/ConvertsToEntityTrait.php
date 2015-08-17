<?php namespace DeSmart\DomainCore;

use Illuminate\Support\Collection;
use DeSmart\DomainCore\EntityTranslator;
use Illuminate\Database\Eloquent\Relations\Pivot;

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

            if (false === $this->isRelationSettableForEntity($name, $relations, $entity)) {
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

    /**
     * Test if given relation can be set in entity
     *
     * @param string $name name of the relation
     * @param mixed $relations fetched related record(s)
     * @param mixed $entity
     * @return boolean
     */
    protected function isRelationSettableForEntity($name, $relations, $entity)
    {

        if (null === $relations) {
            return false;
        }

        // Pivots shouldn't be converted to entities
        if (true === $relations instanceof Pivot) {
            return false;
        }

        $setterMethod = 'set'.ucfirst($name);

        if (false === method_exists($entity, $setterMethod)) {
            return false;
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
