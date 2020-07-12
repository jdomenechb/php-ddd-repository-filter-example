<?php

namespace RepositoryFilterExample\Infrastructure\Hydrator;

use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

class StudentHydrator
{
    public function fromArray($data): Student
    {
        return new Student(
            new StudentId($data['id']),
            $data['name'],
            SchoolClass::make($data['school_class']),
            new \DateTimeImmutable($data['registered_in'], new \DateTimeZone('UTC'))
        );
    }
}
