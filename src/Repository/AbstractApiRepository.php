<?php namespace DeSmart\DomainCore\Repository;

use Illuminate\Support\Collection;

abstract class AbstractApiRepository
{
    protected $entityClassName;

    public function hydrateItem(array $item)
    {
        return $this->toEntity($item);
    }

    public function toEntity($item)
    {
        return $this->wrapArrayToEntity($item);
    }

    /**
     * @param $item
     *
     * @return object
     * @throws \JsonMapper_Exception
     * @internal param $entity
     */
    public function wrapArrayToEntity($item)
    {
        $jsonMapper = new \JsonMapper();
        $entityClassName = $this->getEntityClassName();

        return $jsonMapper->map($item, new $entityClassName());
    }

    public function hydrate(Collection $collection)
    {
        return $collection->map(function ($item) {
            return $this->hydrateItem($item);
        });
    }

    public function getEntityClassName()
    {
        return $this->entityClassName;
    }
}
