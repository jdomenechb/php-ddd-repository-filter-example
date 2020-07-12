<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\Exception\StudentDoesNotExistException;
use RepositoryFilterExample\Domain\Filter\StudentFilter;
use RepositoryFilterExample\Domain\Repository\StudentRepository;
use RepositoryFilterExample\Domain\ValueObject\StudentId;
use RepositoryFilterExample\Infrastructure\Hydrator\StudentHydrator;

class DbalStudentRepository implements StudentRepository
{
    private Connection $connection;
    private StudentHydrator $hydrator;

    public function __construct(Connection $connection, StudentHydrator $hydrator)
    {
        $this->connection = $connection;
        $this->hydrator = $hydrator;
    }

    public function byIdOrFail(StudentId $id): Student
    {
        $qb = $this->createSelect()
            ->andWhere('id = :id') ->setParameter('id', $id->id());

        $result = $qb->execute();
        $row = $result->fetch();

        if ($row === null) {
            throw new StudentDoesNotExistException();
        }

        return $this->hydrator->fromArray($row);
    }

    public function by(StudentFilter $filter): array
    {
        $qb = $this->createSelect();
        $filter->apply($qb);

        $result = $qb->execute();

        $toReturn = [];

        while ($row = $result->fetch()) {
            $toReturn[] = $this->hydrator->fromArray($row);
        }

        return $toReturn;
    }

    private function createSelect(): QueryBuilder
    {
        return (new QueryBuilder($this->connection))
            ->select('*')
            ->from('students');
    }
}
