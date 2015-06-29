<?php namespace DeSmart\DomainCore\Stubs\Repository;

use Illuminate\Support\Collection;
use DeSmart\DomainCore\Repository\ConvertsCollectionToEntitiesTrait;

class RepositoryStub
{

    use ConvertsCollectionToEntitiesTrait;

    protected $users;

    public function __construct(array $users = [])
    {
        $this->users = $users;
    }

    public function fromCollection()
    {
        return $this->convertCollectionToEntities(new Collection($this->users));
    }

    public function fromArray()
    {
        return $this->convertCollectionToEntities($this->users);
    }
}
