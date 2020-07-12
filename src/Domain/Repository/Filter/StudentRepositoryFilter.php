<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Repository\Filter;

use RepositoryFilterExample\Domain\ValueObject\SchoolClass;

interface StudentRepositoryFilter extends RepositoryFilter
{
    public function inSchoolClass(SchoolClass $schoolClass): self;
    public function registeredBeforeInclusive(\DateTimeImmutable $date): self;
    public function registeredAfterInclusive(\DateTimeImmutable $date): self;
}
