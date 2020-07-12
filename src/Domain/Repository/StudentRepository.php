<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Repository;

use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\Exception\StudentDoesNotExistException;
use RepositoryFilterExample\Domain\Repository\Filter\StudentRepositoryFilter;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

interface StudentRepository
{
    /**
     * @throws StudentDoesNotExistException
     */
    public function byIdOrFail(StudentId $id): Student;

    public function by(StudentRepositoryFilter $filter): \Generator;
}
