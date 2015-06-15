<?php namespace DeSmart\DomainCore\Repository;

trait ConvertArrayToEntityTrait
{
    public function hydrateItem(array $item)
    {
        return $this->toEntity($item);
    }

    public function toEntity($item)
    {
       return $this->wrapArrayToEntity($item);
    }

    /**
     * @param $entity
     */
    public function wrapArrayToEntity($item)
    {
        $jsonMapper = new \JsonMapper();
        $entityClassName = $this->getEntityClassName();

        return $jsonMapper->map($item, new $entityClassName());
    }
}
