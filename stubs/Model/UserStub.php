<?php namespace DeSmart\DomainCore\Stubs\Model;

use DeSmart\DomainCore\ConvertsToEntityTrait;

class UserStub
{
    use ConvertsToEntityTrait;

    /**
     * @var string
     */
    public $entityClassName;

    public $name;

    public $lastname;

    public $relations = [];

    public function __construct($name = null, $lastname = null)
    {
        $this->name = $name;
        $this->lastname = $lastname;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'lastname' => $this->lastname
        ];
    }

    /**
     * @param array $relations
     */
    public function setRelations(array $relations)
    {
        $this->relations = $relations;
    }
}
