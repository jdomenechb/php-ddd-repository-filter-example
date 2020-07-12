<?php

namespace RepositoryFilterExample\Application\Service;

use RepositoryFilterExample\Application\DTO\StudentDTO;
use RepositoryFilterExample\Domain\Repository\StudentRepository;
use RepositoryFilterExample\Domain\ValueObject\StudentId;

class StudentByIdHandler
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function handle(StudentByIdRequest $request): StudentDTO
    {
        $id = new StudentId($request->id());

        $student = $this->studentRepository->byIdOrFail($id);

        return StudentDTO::from($student);
    }
}
