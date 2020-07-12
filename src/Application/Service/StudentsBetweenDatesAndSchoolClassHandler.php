<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Application\Service;

use RepositoryFilterExample\Application\DTO\StudentDTO;
use RepositoryFilterExample\Domain\Entity\Student;
use RepositoryFilterExample\Domain\Filter\StudentFilter;
use RepositoryFilterExample\Domain\Repository\StudentRepository;
use RepositoryFilterExample\Domain\ValueObject\SchoolClass;

class StudentsBetweenDatesAndSchoolClassHandler
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @return StudentDTO[]
     * @throws \Exception
     */
    public function handle(StudentsBetweenDatesAndSchoolClassRequest $request, StudentFilter $filter): array
    {
        $students = $this->studentRepository->by(
            $filter
                ->inSchoolClass(SchoolClass::make($request->schoolClass()))
                ->registeredAfterInclusive(new \DateTimeImmutable($request->startDate()))
                ->registeredBeforeInclusive(new \DateTimeImmutable($request->endDate()))
        );

        return array_map(static function (Student $student) {
            return StudentDTO::from($student);
        }, iterator_to_array($students));
    }
}
