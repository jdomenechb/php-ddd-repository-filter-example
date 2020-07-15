<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Entity;

use MongoDB\BSON\Unserializable;
use MongoDB\BSON\UTCDateTime;
use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

class MongoStudent extends Student implements Unserializable
{
    /**
     * @param array{id: string, name: string, school_class: string, registered_in: UTCDateTime} $data
     */
    public function bsonUnserialize(array $data): void
    {
        $this->id = new StudentId($data['id']);
        $this->name = $data['name'];
        $this->schoolClass = SchoolClass::make($data['school_class']);
        $this->registeredIn = \DateTimeImmutable::createFromMutable($data['registered_in']->toDateTime());
    }
}
