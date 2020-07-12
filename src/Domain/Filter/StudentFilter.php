<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Filter;

use RepositoryFilterExample\Domain\ValueObject\SchoolClass;

interface StudentFilter extends Filter
{
    public function inSchoolClass(SchoolClass $schoolClass): self;
    public function registeredBeforeInclusive(\DateTimeImmutable $date): self;
    public function registeredAfterInclusive(\DateTimeImmutable $date): self;
}
