<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Filter;

interface Filter
{
    public function apply($applier);
}
