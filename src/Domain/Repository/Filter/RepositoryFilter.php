<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Repository\Filter;

interface RepositoryFilter
{
    /**
     * @param mixed $applier
     * @return mixed
     */
    public function apply($applier);
}
