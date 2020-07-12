<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Entity;

use RepositoryFilterExample\Domain\ValueObject\SchoolClass;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

class Student
{
    private StudentId $id;
    private string $name;
    private SchoolClass $schoolClass;
    private \DateTimeImmutable $registeredIn;

    public function __construct(StudentId $id, string $name, SchoolClass $schoolClass, \DateTimeImmutable $registeredIn)
    {
        $this->id = $id;
        $this->name = $name;
        $this->schoolClass = $schoolClass;
        $this->registeredIn = $registeredIn;
    }

    public function id(): StudentId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function schoolClass(): SchoolClass
    {
        return $this->schoolClass;
    }

    public function registeredIn(): \DateTimeImmutable
    {
        return $this->registeredIn;
    }
}
