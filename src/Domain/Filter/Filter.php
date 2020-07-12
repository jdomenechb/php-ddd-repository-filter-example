<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Filter;

interface Filter
{
    /**
     * @param mixed $applier
     * @return mixed
     */
    public function apply($applier);
}
