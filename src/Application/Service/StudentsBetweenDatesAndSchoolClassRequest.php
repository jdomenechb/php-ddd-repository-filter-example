<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Application\Service;

/**
 * @psalm-immutable
 */
class StudentsBetweenDatesAndSchoolClassRequest
{
    private string $schoolClass;
    private string $startDate;
    private string $endDate;

    public function __construct(string $startDate, string $endDate, string $schoolClass)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->schoolClass = $schoolClass;
    }

    public function schoolClass(): string
    {
        return $this->schoolClass;
    }

    public function startDate(): string
    {
        return $this->startDate;
    }

    public function endDate(): string
    {
        return $this->endDate;
    }
}
