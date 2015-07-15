<?php namespace DeSmart\DomainCore\Repository;

use Illuminate\Support\Collection;

trait ConvertsCollectionToEntitiesTrait
{

    protected function convertCollectionToEntities($collection)
    {

        if (true === $collection instanceof Collection) {
            $collection = $collection->all();
        }

        if (false === empty($collection) && false === method_exists(current($collection), 'toEntity')) {
            throw new \InvalidArgumentException('Items need to convert to entity');
        }

        return array_map(
            function ($item) {
                return $item->toEntity();
            },
            $collection
        );
    }
}
