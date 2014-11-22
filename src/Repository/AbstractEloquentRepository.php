<?php namespace DeSmart\DomainCore\Repository;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $query;

    protected function getTranslator()
    {
        return \App::make('DeSmart\DomainCore\EntityTranslatorInterface');
    }

    public function hydrateItem(Model $item)
    {
        $entity_class = $this->getTranslator()->fromModel($item);

        return new $entity_class($item);
    }

    public function hydrate(Collection $collection)
    {
        return $collection->map(function ($item) {
            return $this->hydrateItem($item);
        });
    }
}
