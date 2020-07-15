<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Domain\Repository\Filter;

interface RepositoryFilter
{
    /**
     * @return mixed
     */
    public function apply(object $applier);
}
