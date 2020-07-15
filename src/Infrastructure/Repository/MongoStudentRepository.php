<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Repository;

use MongoDB\Collection;
use MongoDB\Database;
use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\Exception\StudentDoesNotExistException;
use RepositoryFilterExample\Domain\Repository\Filter\StudentRepositoryFilter;
use RepositoryFilterExample\Domain\Repository\StudentRepository;
use RepositoryFilterExample\Domain\ValueObject\StudentId;
use RepositoryFilterExample\Infrastructure\Entity\MongoStudent;

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
        /** @var MongoStudent|null $document */
        $document = $this->collection->findOne(['id' => $id->id()], ['typeMap' => ['root' => MongoStudent::class]]);

        if (!$document) {
            throw new StudentDoesNotExistException();
        }

        return $document;
    }

    /**
     * @throws \Exception
     */
    public function by(StudentRepositoryFilter $filter): \Generator
    {
        $mongoFilters = new \stdClass();
        $filter->apply($mongoFilters);

        $cursor = $this->collection->find($mongoFilters);
        $cursor->setTypeMap(['root' => MongoStudent::class]);

        /** @var MongoStudent[] $cursor */
        foreach ($cursor as $document) {
            yield $document;
        }
    }
}
