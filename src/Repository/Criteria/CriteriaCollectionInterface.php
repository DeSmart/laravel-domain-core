<?php

namespace DeSmart\DomainCore\Repository\Criteria;

interface CriteriaCollectionInterface
{
    /**
     * @param CriterionInterface $criterion
     * @return void
     */
    public function add(CriterionInterface $criterion);

    /**
     * @return void
     */
    public function reset();

    /**
     * @return CriterionInterface[]
     */
    public function getAll();
}
