<?php

/*
 * This file is part of the Monofony demo.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Command\Installer;

use App\Command\Helper\CommandsRunner;
use App\Installer\Provider\DatabaseSetupCommandsProviderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class InstallDatabaseCommand extends Command
{
    /** @var DatabaseSetupCommandsProviderInterface */
    private $databaseSetupCommandsProvider;

    /** @var CommandsRunner */
    private $commandsRunner;

    /** @var string */
    private $environment;

    public function __construct(
        DatabaseSetupCommandsProviderInterface $databaseSetupCommandsProvider,
        CommandsRunner $commandsRunner,
        string $environment
    ) {
        $this->databaseSetupCommandsProvider = $databaseSetupCommandsProvider;
        $this->commandsRunner = $commandsRunner;
        $this->environment = $environment;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:install:database')
            ->setDescription('Install Monofony database.')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command creates Monofony database.
EOT
            )
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outputStyle = new SymfonyStyle($input, $output);
        $outputStyle->writeln(sprintf(
            'Creating Monofony database for environment <info>%s</info>.',
            $this->environment
        ));
        $commands = $this
            ->databaseSetupCommandsProvider
            ->getCommands($input, $output, $this->getHelper('question'))
        ;
        $this->commandsRunner->run($commands, $input, $output, $this->getApplication());
        $outputStyle->newLine();

        // Install Sample data command is available on monofony/fixtures-plugin
        if (class_exists(InstallSampleDataCommand::class)) {
            $commandExecutor = new CommandExecutor($input, $output, $this->getApplication());
            $commandExecutor->runCommand('app:install:sample-data', [], $output);
        }

        return 0;
    }
}
