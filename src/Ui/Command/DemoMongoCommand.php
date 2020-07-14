<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Ui\Command;

use MongoDB\Client;
use RepositoryFilterExample\Infrastructure\Filter\StdClassMongoStudentRepositoryFilter;
use RepositoryFilterExample\Infrastructure\Repository\MongoStudentRepository;
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
