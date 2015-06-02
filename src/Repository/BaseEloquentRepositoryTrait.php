<?php namespace DeSmart\DomainCore\Repository;

use DeSmart\DomainCore\Entity\AbstractEloquentEntity;

trait BaseEloquentRepositoryTrait
{

    /**
     * Fetch all records
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return $this->hydrate($this->query->all());
    }

    /**
     * Find record by primary key
     *
     * @param mixed $id
     * @return \DeSmart\DomainCore\Entity\AbstractEloquentEntity
     */
    public function find($id)
    {
        return $this->findBy($this->query->getKeyName(), $id);
    }

    /**
     * Find record by given key
     *
     * @param string $field
     * @param mixed $value
     * @return \DeSmart\DomainCore\Entity\AbstractEloquentEntity
     */
    public function findBy($field, $value)
    {
        $item = $this->query->where($field, $value)
            ->first();

        return is_null($item) ? null : $this->hydrateItem($item);
    }

    /**
     * Find records by given key
     *
     * @param string $field
     * @param mixed $value
     * @param string $orderByField
     * @param string $orderDirection
     * @return \Illuminate\Support\Collection
     */
    public function findAllBy($field, $value, $orderByField = null, $orderDirection = 'asc')
    {
        $items = $this->query->where($field, $value);

        if(false === empty($orderByField)){
            $items = $items->orderBy($orderByField, $orderDirection);
        }

        $items = $items->get();

        return $items->isEmpty() ? null : $this->hydrate($items);
    }

    /**
     * Store record in DB
     *
     * @param \DeSmart\DomainCore\Entity\AbstractEloquentEntity
     */
    public function save(AbstractEloquentEntity $entity)
    {
        $entity->getEloquentModel()->save();
    }
}
