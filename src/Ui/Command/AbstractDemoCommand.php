<?php

namespace RepositoryFilterExample\Ui\Command;

use Doctrine\DBAL\DriverManager;
use RepositoryFilterExample\Application\DTO\StudentDTO;
use RepositoryFilterExample\Application\Service\StudentByIdHandler;
use RepositoryFilterExample\Application\Service\StudentByIdRequest;
use RepositoryFilterExample\Application\Service\StudentsBetweenDatesAndSchoolClassHandler;
use RepositoryFilterExample\Application\Service\StudentsBetweenDatesAndSchoolClassRequest;
use RepositoryFilterExample\Domain\Repository\Filter\StudentRepositoryFilter;
use RepositoryFilterExample\Domain\Repository\StudentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractDemoCommand extends Command
{
    protected function runDemo(StudentRepository $repository, StudentRepositoryFilter $filter, string $dbType, OutputInterface $output): int
    {
        $firstUseCase = new StudentByIdHandler($repository);
        $secondUseCase = new StudentsBetweenDatesAndSchoolClassHandler($repository);

        // :Rick voice: And away we go!
        $output->writeln("$dbType Demo");
        $output->writeln("==========\n");

        $output->writeln("USE CASE 1: Fetch an student by its ID\n");
        $student = $firstUseCase->handle(new StudentByIdRequest('a1b2c3'));

        $this->outputStudents([$student], $output);

        $output->writeln("\n==============================================================================\n");

        $output->writeln("USE CASE 2: Fetch all students registered in 2019 in THIRD class\n");
        $students = $secondUseCase->handle(
            new StudentsBetweenDatesAndSchoolClassRequest('2019-01-01', '2019-12-31', 'third'),
            $filter
        );

        $this->outputStudents($students, $output);

        return 0;
    }

    /**
     * @param StudentDTO[] $students
     * @param OutputInterface $output
     */
    public function outputStudents(array $students, OutputInterface $output): void
    {
        $table = new Table($output);
        $table->setHeaders(['Name', 'Class', 'Registered in']);
        $table->setRows(array_map(static function (StudentDTO $student) {
            return [$student->name(), $student->class(), $student->registeredIn()->format('Y-m-d H:i:s')];
        }, $students))
        ;

        $table->render();
    }
}
