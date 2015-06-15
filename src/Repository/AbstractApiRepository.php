<?php namespace DeSmart\DomainCore\Repository;

use Illuminate\Support\Collection;

abstract class AbstractApiRepository
{
    protected $entityClassName;

    public function hydrateItem(array $item)
    {
        if (null == $entityClassName) {
            $entityClassName = $this->getEntityClassName();
        }

        return new $entityClassName($item);
    }

    public function hydrate(Collection $collection, $entityClassName = null)
    {
        if (null == $entityClassName) {
            $entityClassName = $this->getEntityClassName();
        }

        return $collection->map(function ($item) use($entityClassName) {
            return $this->hydrateItem($item, $entityClassName);
        });
    }

    public function getEntityClassName()
    {
        return $this->entityClassName;
    }
}
