<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\Exception\StudentDoesNotExistException;
use RepositoryFilterExample\Domain\Repository\Filter\StudentRepositoryFilter;
use RepositoryFilterExample\Domain\Repository\StudentRepository;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;
use RepositoryFilterExample\Domain\ValueObject\StudentId;
use RepositoryFilterExample\Infrastructure\Hydrator\StudentHydrator;

class DbalStudentRepository implements StudentRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function byIdOrFail(StudentId $id): Student
    {
        $qb = $this->createSelect()
            ->andWhere('id = :id') ->setParameter('id', $id->id());

        $result = $qb->execute();

        if (!is_object($result)) {
            throw new \RuntimeException('Expected result object');
        }

        /** @var array<string, string>|null $row */
        $row = $result->fetch();

        if ($row === null) {
            throw new StudentDoesNotExistException();
        }

        return $this->buildObject($row);
    }

    /**
     * @throws \Exception
     */
    public function by(StudentRepositoryFilter $filter): \Generator
    {
        $qb = $this->createSelect();
        $filter->apply($qb);

        $result = $qb->execute();

        if (!is_object($result)) {
            throw new \RuntimeException('Expected result object');
        }

        while (
            /** @var array<string, string>|null $row */
            $row = $result->fetch()
        ) {
            yield $this->buildObject($row);
        }
    }

    private function createSelect(): QueryBuilder
    {
        return (new QueryBuilder($this->connection))
            ->select('*')
            ->from('students');
    }

    private function buildObject(array $data)
    {
        return new Student(
            new StudentId($data['id']),
            $data['name'],
            SchoolClass::make($data['school_class']),
            new \DateTimeImmutable($data['registered_in'], new \DateTimeZone('UTC'))
        );
    }
}
