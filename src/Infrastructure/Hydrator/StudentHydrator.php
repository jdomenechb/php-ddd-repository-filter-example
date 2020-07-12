<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Hydrator;

use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

class StudentHydrator
{
    /**
     * @param array<string, string> $data
     * @return Student
     * @throws \Exception
     */
    public function fromArray(array $data): Student
    {
        return new Student(
            new StudentId($data['id']),
            $data['name'],
            SchoolClass::make($data['school_class']),
            new \DateTimeImmutable($data['registered_in'], new \DateTimeZone('UTC'))
        );
    }
}
