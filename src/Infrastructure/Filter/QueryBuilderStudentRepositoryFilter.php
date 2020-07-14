<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Filter;

use Doctrine\DBAL\Query\QueryBuilder;

class QueryBuilderStudentRepositoryFilter extends AbstractStudentRepositoryFilter
{
    public function apply($qb): void
    {
        if (!$qb instanceof QueryBuilder) {
            throw new \RuntimeException('Expected query builder');
        }

        if ($this->inSchoolClass !== null) {
            $qb->andWhere('school_class = :schoolClass')
                ->setParameter('schoolClass', $this->inSchoolClass->getValue());
        }

        if ($this->registeredBeforeInclusive !== null) {
            $qb->andWhere('registered_in <= :registeredBefore')
                ->setParameter('registeredBefore', $this->registeredBeforeInclusive->format('Y-m-d H:i:s'));
        }

        if ($this->registeredAfterInclusive !== null) {
            $qb->andWhere('registered_in >= :registeredAfter')
                ->setParameter('registeredAfter', $this->registeredAfterInclusive->format('Y-m-d H:i:s'));
        }
    }
}
