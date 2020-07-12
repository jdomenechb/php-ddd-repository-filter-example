<?php

namespace RepositoryFilterExample\Application\Service;

/**
 * @psalm-immutable
 */
class StudentByIdRequest
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
