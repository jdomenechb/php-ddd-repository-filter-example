<?php

namespace RepositoryFilterExample\Infrastructure\Filter;

use RepositoryFilterExample\Domain\Repository\Filter\StudentRepositoryFilter;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;

abstract class AbstractStudentRepositoryFilter implements StudentRepositoryFilter
{
    protected ?SchoolClass $inSchoolClass;
    protected ?\DateTimeImmutable $registeredBeforeInclusive;
    protected ?\DateTimeImmutable $registeredAfterInclusive;

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
}
