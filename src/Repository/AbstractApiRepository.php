<?php namespace DeSmart\DomainCore\Repository;

use Illuminate\Support\Collection;

abstract class AbstractApiRepository
{

    public function hydrateItem(array $item, $entityClassName)
    {
        return new $entityClassName($item);
    }

    public function hydrate(Collection $collection, $entityClassName)
    {
        return $collection->map(function ($item) use($entityClassName) {
            return $this->hydrateItem($item, $entityClassName);
        });
    }
}
