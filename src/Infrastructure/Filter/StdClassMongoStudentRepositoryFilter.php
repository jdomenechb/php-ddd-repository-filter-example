<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Infrastructure\Filter;

use MongoDB\BSON\UTCDateTime;

class StdClassMongoStudentRepositoryFilter extends AbstractStudentRepositoryFilter
{
    public function apply(object $applier): void
    {
        if (!$applier instanceof \stdClass) {
            throw new \RuntimeException('Expected stdClass');
        }

        if ($this->inSchoolClass !== null) {
            $applier->school_class = strtolower($this->inSchoolClass->getValue());
        }

        $registeredIn = [];

        if ($this->registeredBeforeInclusive !== null) {
            $registeredIn['$lte'] = new UTCDateTime($this->registeredBeforeInclusive);
        }

        if ($this->registeredAfterInclusive !== null) {
            $registeredIn['$gte'] = new UTCDateTime($this->registeredAfterInclusive);
        }

        if ($registeredIn) {
            $applier->registered_in = new \stdClass();

            foreach ($registeredIn as $key => $value) {
                $applier->registered_in->{$key} = $value;
            }
        }
    }
}
