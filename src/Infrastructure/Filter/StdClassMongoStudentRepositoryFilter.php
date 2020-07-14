<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Filter;

use MongoDB\BSON\UTCDateTime;

class StdClassMongoStudentRepositoryFilter extends AbstractStudentRepositoryFilter
{
    public function apply($applier): void
    {
        if (!$applier instanceof \stdClass) {
            throw new \RuntimeException('Expected stdClass');
        }

        if ($this->inSchoolClass !== null) {
            $applier->school_class = strtolower($this->inSchoolClass->getValue());
        }

        if ($this->registeredBeforeInclusive !== null) {
            $applier->registered_in ??= new \stdClass();
            $applier->registered_in->{'$lte'} = new UTCDateTime($this->registeredBeforeInclusive);
        }

        if ($this->registeredAfterInclusive !== null) {
            $applier->registered_in ??= new \stdClass();
            $applier->registered_in->{'$gte'} = new UTCDateTime($this->registeredAfterInclusive);
        }
    }
}
