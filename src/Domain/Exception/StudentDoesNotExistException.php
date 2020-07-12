<?php

namespace RepositoryFilterExample\Domain\Exception;

use Throwable;

class StudentDoesNotExistException extends \RuntimeException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('The student does not exist', ExceptionCodes::STUDENT_NOT_FOUND, $previous);
    }
}
