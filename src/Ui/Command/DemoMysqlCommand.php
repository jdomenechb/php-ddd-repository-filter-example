<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Ui\Command;

use Doctrine\DBAL\DriverManager;
use RepositoryFilterExample\Application\DTO\StudentDTO;
use RepositoryFilterExample\Application\Service\StudentByIdHandler;
use RepositoryFilterExample\Application\Service\StudentByIdRequest;
use RepositoryFilterExample\Application\Service\StudentsBetweenDatesAndSchoolClassHandler;
use RepositoryFilterExample\Application\Service\StudentsBetweenDatesAndSchoolClassRequest;
use RepositoryFilterExample\Infrastructure\Filter\QueryBuilderStudentFilter;
use RepositoryFilterExample\Infrastructure\Hydrator\StudentHydrator;
use RepositoryFilterExample\Infrastructure\Repository\DbalStudentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoMysqlCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('app:demo:mysql')
            ->setDescription('Runs the demo against a MySQL database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Hardcoded configuration only for demo purposes. Remember kids, never hardcode any config in your files!
        $connectionParams = ['url' => 'mysql://root:root@127.0.0.1:3306/demo'];

        // As it is a little demo, we don't need anything powerful like a service container. We will handle dependencies
        // ourselves
        $conn = DriverManager::getConnection($connectionParams);
        $repository = new DbalStudentRepository($conn, new StudentHydrator());

        $firstUseCase = new StudentByIdHandler($repository);
        $secondUseCase = new StudentsBetweenDatesAndSchoolClassHandler($repository);

        // :Rick voice: And away we go!
        $output->writeln("MySQL Demo");
        $output->writeln("==========\n");

        $output->writeln("USE CASE 1: Fetch an student by its ID\n");
        $student = $firstUseCase->handle(new StudentByIdRequest('a1b2c3'));

        $this->outputStudents([$student], $output);

        $output->writeln("\n==============================================================================\n");

        $output->writeln("USE CASE 2: Fetch all students in 2019 in THIRD class\n");
        $students = $secondUseCase->handle(
            new StudentsBetweenDatesAndSchoolClassRequest('2019-01-01', '2019-12-31', 'third'),
            new QueryBuilderStudentFilter()
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
