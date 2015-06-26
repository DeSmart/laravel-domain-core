<?php namespace DeSmart\DomainCore\Repository;

use Illuminate\Support\Collection;

trait ConvertsCollectionToEntitiesTrait
{

    protected function convertCollectionToEntities($collection)
    {

        if (true === $collection instanceof Collection) {
            $collection = $collection->toArray();
        }

        return array_map(
            function ($item) {
                return $item->toEntity();
            },
            $collection
        );
    }
}
