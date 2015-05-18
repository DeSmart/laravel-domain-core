<?php namespace DeSmart\DomainCore\Entity;

use DeSmart\DomainCore\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentEntity
{

    use EventGenerator;

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    final public function getEloquentModel()
    {
        return $this->model;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->model->getKey();
    }
}
