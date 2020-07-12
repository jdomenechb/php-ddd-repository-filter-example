<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use RepositoryFilterExample\Domain\Repository\Filter\StudentRepositoryFilter;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;

class QueryBuilderStudentFilter implements StudentRepositoryFilter
{
    private ?SchoolClass $inSchoolClass;
    private ?\DateTimeImmutable $registeredBeforeInclusive;
    private ?\DateTimeImmutable $registeredAfterInclusive;

    public function __construct()
    {
        $this->inSchoolClass = null;
        $this->registeredBeforeInclusive = null;
        $this->registeredAfterInclusive = null;
    }


    public function inSchoolClass(SchoolClass $schoolClass): self
    {
        $this->inSchoolClass = $schoolClass;

        return $this;
    }

    public function registeredBeforeInclusive(\DateTimeImmutable $date): self
    {
        $this->registeredBeforeInclusive = $date;

        return $this;
    }

    public function registeredAfterInclusive(\DateTimeImmutable $date): self
    {
        $this->registeredAfterInclusive = $date;

        return $this;
    }

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
