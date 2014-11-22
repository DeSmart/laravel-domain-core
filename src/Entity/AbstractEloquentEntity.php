<?php namespace DeSmart\DomainCore\Entity;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Commander\Events\EventGenerator;

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
    public function getModel()
    {
        return $this->model;
    }
}
