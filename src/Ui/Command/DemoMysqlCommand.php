<?php

declare(strict_types=1);

namespace RepositoryFilterExample\Ui\Command;

use Doctrine\DBAL\DriverManager;
use RepositoryFilterExample\Infrastructure\Filter\QueryBuilderStudentRepositoryFilter;
use RepositoryFilterExample\Infrastructure\Repository\DbalStudentRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoMysqlCommand extends AbstractDemoCommand
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
        $repository = new DbalStudentRepository($conn);

        return $this->runDemo($repository, new QueryBuilderStudentRepositoryFilter(), 'MySQL', $output);
    }
}
