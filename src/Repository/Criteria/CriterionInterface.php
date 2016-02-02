<?php

namespace DeSmart\DomainCore\Repository\Criteria;

interface CriterionInterface
{
    /**
     * @param $query
     * @return mixed
     */
    public function apply($query);
}