<?php

namespace RepositoryFilterExample\Domain\Repository;

use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\Exception\StudentDoesNotExistException;
use RepositoryFilterExample\Domain\Filter\StudentFilter;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

interface StudentRepository
{
    /**
     * @throws StudentDoesNotExistException
     */
    public function byIdOrFail(StudentId $id): Student;

    public function by(StudentFilter $filter): array;
}