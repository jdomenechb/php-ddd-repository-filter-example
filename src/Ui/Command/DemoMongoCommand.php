<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Ui\Command;

use Doctrine\DBAL\DriverManager;
use MongoDB\Client;
use RepositoryFilterExample\Application\DTO\StudentDTO;
use RepositoryFilterExample\Application\Service\StudentByIdHandler;
use RepositoryFilterExample\Application\Service\StudentByIdRequest;
use RepositoryFilterExample\Application\Service\StudentsBetweenDatesAndSchoolClassHandler;
use RepositoryFilterExample\Application\Service\StudentsBetweenDatesAndSchoolClassRequest;
use RepositoryFilterExample\Infrastructure\Filter\QueryBuilderStudentRepositoryFilter;
use RepositoryFilterExample\Infrastructure\Filter\StdClassMongoStudentRepositoryFilter;
use RepositoryFilterExample\Infrastructure\Hydrator\StudentHydrator;
use RepositoryFilterExample\Infrastructure\Repository\DbalStudentRepository;
use RepositoryFilterExample\Infrastructure\Repository\MongoStudentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoMongoCommand extends AbstractDemoCommand
{
    protected function configure(): void
    {
        $this->setName('app:demo:mongo')
            ->setDescription('Runs the demo against a Mongo database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Hardcoded configuration only for demo purposes. Remember kids, never hardcode any config in your files!
        $client = new Client('mongodb://root:root@localhost/');
        $database = $client->selectDatabase('demo');


        // As it is a little demo, we don't need anything powerful like a service container. We will handle dependencies
        // ourselves
        $repository = new MongoStudentRepository($database);

        return $this->runDemo($repository, new StdClassMongoStudentRepositoryFilter(), 'Mongo', $output);
    }
}
