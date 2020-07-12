<?php

namespace RepositoryFilterExample\Domain\Filter;

interface Filter
{
    public function apply($applier);
}
