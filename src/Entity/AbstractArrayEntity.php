<?php namespace DeSmart\DomainCore\Entity;

use DeSmart\DomainCore\Events\EventGenerator;

abstract class AbstractArrayEntity
{
    use EventGenerator;

    /**
     * @param string $idKey
     * @return int
     */
    public function getId($idKey = 'id')
    {
        return $this->$idKey;
    }
}
