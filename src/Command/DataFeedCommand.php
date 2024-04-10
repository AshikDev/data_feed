<?php

namespace App\Command;

use App\Contract\DataStore\XmlDataHandlerInterface;
use App\Contract\FileValidator\FileValidatorInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'DataFeed'
)]
class DataFeedCommand extends Command
{
    protected static $defaultName = 'app:data-feed';

    public function __construct(
        private readonly FileValidatorInterface $xmlFileValidator,
        private readonly XmlDataHandlerInterface $xmlDataHandler
    ) {
        parent::__construct(self::$defaultName);
    }

    /**
     * Configures the command with a description and required argument
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Process feed.xml file and pushes data to a database.')
            ->addArgument('filepath', InputArgument::REQUIRED, 'The path to the XML file.');
    }

    /**
     * Executes the command to process an XML file and save data to the database
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());

        $filepath = $input->getArgument('filepath');

        if (
            !$this->processStep(
                $io,
                fn() => $this->xmlFileValidator->validateFile($filepath),
                'Validating XML file'
            ) ||
            !$this->processStep(
                $io,
                fn() => $this->xmlDataHandler->extractAndSave($filepath),
                'Parsing and Storing XML Data',
                true
            )
        ) {
            return Command::FAILURE;
        }

        $io->success('Done');
        return Command::SUCCESS;
    }

    /**
     * Processes a step of the command execution.
     */
    private function processStep(
        SymfonyStyle $io,
        callable $operation,
        string $message,
        bool $isStoreStep = false
    ): bool {
        $io->info($message);
        try {
            $result = $operation();
            if ($isStoreStep) {
                $io->note(sprintf('%d row are saved', $result));
            }

            return true;
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return false;
        }
    }
}
