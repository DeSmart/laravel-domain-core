<?php namespace DeSmart\DomainCore\Entity;

use DeSmart\DomainCore\Events\EventGenerator;

abstract class AbstractArrayEntity
{
    use EventGenerator;

    protected $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    final public function toArray()
    {
        return $this->item;
    }

    /**
     * @param string $idKey
     * @return int
     */
    public function getId($idKey = 'id')
    {
        return $this->item[$idKey];
    }
}
