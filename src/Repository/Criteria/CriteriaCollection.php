<?php

namespace DeSmart\DomainCore\Repository\Criteria;

class CriteriaCollection implements CriteriaCollectionInterface
{
    /** @var CriterionInterface[] */
    protected $criteria;

    /**
     * @param CriterionInterface $criterion
     * @return void
     */
    public function add(CriterionInterface $criterion)
    {
        $this->criteria[] = $criterion;
    }

    /**
     * @return void
     */
    public function reset()
    {
        $this->criteria = [];
    }

    /**
     * @return CriterionInterface[]
     */
    public function getAll()
    {
        return $this->criteria;
    }
}