<?php namespace DeSmart\DomainCore\Stubs\Model;

use DeSmart\DomainCore\ConvertsToEntityTrait;

class UserCommentStub
{
    use ConvertsToEntityTrait;

    /**
     * @var string
     */
    protected $message;

    public $entityClassName;

    public $relations = [];

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function toArray()
    {
        return ['message' => $this->message];
    }

    protected function relationsToArray()
    {
        return $this->relations;
    }
}
