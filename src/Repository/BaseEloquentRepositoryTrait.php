<?php namespace DeSmart\DomainCore\Repository;

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
     * Store record in DB
     *
     * @param \DeSmart\DomainCore\Entity\AbstractEloquentEntity
     */
    public function save($entity)
    {
        $entity->getModel()->save();
    }
}
