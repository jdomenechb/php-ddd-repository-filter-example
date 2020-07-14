<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Repository;

use MongoDB\Collection;
use MongoDB\Database;
use MongoDB\Model\BSONDocument;
use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\Exception\StudentDoesNotExistException;
use RepositoryFilterExample\Domain\Repository\Filter\StudentRepositoryFilter;
use RepositoryFilterExample\Domain\Repository\StudentRepository;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

class MongoStudentRepository implements StudentRepository
{
    private Collection $collection;

    public function __construct(Database $client)
    {
        $this->collection = $client
            ->selectCollection('students');
    }

    /**
     * @throws \Exception
     */
    public function byIdOrFail(StudentId $id): Student
    {
        $document = $this->collection->findOne(['id' => $id->id()]);

        if (!$document) {
            throw new StudentDoesNotExistException();
        }

        /** @var BSONDocument $document */
        return $this->buildObject($document);
    }

    /**
     * @throws \Exception
     */
    public function by(StudentRepositoryFilter $filter): \Generator
    {
        $mongoFilters = new \stdClass();
        $filter->apply($mongoFilters);

        $cursor = $this->collection->find($mongoFilters);

        foreach ($cursor as $document) {
            yield $this->buildObject($document);
        }
    }

    private function buildObject(BSONDocument $data): Student
    {
        return new Student(
            new StudentId($data['id']),
            $data['name'],
            SchoolClass::make($data['school_class']),
            \DateTimeImmutable::createFromMutable($data['registered_in']->toDateTime())
        );
    }
}
