<?php

namespace RepositoryFilterExample\Application\DTO;

use RepositoryFilterExample\Domain\Entity\Student;

/**
 * @psalm-immutable
 */
class StudentDTO
{
    private string $name;
    private string $class;
    private \DateTimeImmutable $registeredIn;

    public function __construct(string $name, string $class, \DateTimeImmutable $registeredIn)
    {
        $this->name = $name;
        $this->class = $class;
        $this->registeredIn = $registeredIn;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function class(): string
    {
        return $this->class;
    }

    public function registeredIn(): \DateTimeImmutable
    {
        return $this->registeredIn;
    }

    public static function from(Student $student): self
    {
        return new self($student->name(), $student->schoolClass()->getValue(), $student->registeredIn());
    }
}
