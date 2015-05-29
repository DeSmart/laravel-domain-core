<?php namespace DeSmart\DomainCore\Entity;

use DeSmart\DomainCore\Events\EventGenerator;

abstract class AbstractArrayEntity
{
    use EventGenerator;

    protected $item;

    public function __construct($item)
    {
        if (true === is_string($item) && true === is_object(json_decode($item))) {
            $item = json_decode($item, true);
        }

        if (false === is_array($item)) {
            throw new \InvalidArgumentException('Argument passed must be an array or JSON.');
        }

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
