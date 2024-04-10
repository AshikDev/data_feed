<?php

namespace App\Tests\Command;

use App\Command\DataFeedCommand;
use App\Service\CatalogItem\XmlDataStore;
use App\Service\CatalogItem\XmlDataHandler;
use App\Service\FileValidator\XmlFileValidator;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class DataFeedCommandTest extends KernelTestCase
{
    private CommandTester $commandTester;

    /**
     * Creates the DataFeed command and set up the CommandTester for testing
     */
    protected function setUp(): void
    {
        // sets up the kernel and container to provide necessary dependencies
        $kernel = static::bootKernel();
        $container = static::getContainer();

        // fetches and injects dependencies for the constructor from the container
        $xmlFileValidator = $container->get(XmlFileValidator::class);
        $xmlDataHandler = $container->get(XmlDataHandler::class);

        // instantiates the application using constructor's required parameters
        $application = new Application($kernel);
        $dataFeedCommand = new DataFeedCommand($xmlFileValidator, $xmlDataHandler);
        $application->add($dataFeedCommand);

        // initializes the command
        $command = $application->find('DataFeed');
        $this->commandTester = new CommandTester($command);
    }

    /**
     * Tests the successful execution by providing a valid file path
     */
    public function testExecute()
    {
        // executes command with a valid file path
        $filePath = 'public/files/feed.xml';
        $this->commandTester->execute(['filepath' => $filePath]);

        // shows and verifies output in terms of success
        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Done', $output);
        $this->assertEquals(0, $this->commandTester->getStatusCode());
    }

    /**
     * Tests the failure execution by providing an invalid file path
     */
    public function testExecuteFailure()
    {
        // execute command with an invalid file path
        $invalidFilePath = 'public/files/nonexistent.xml';
        $this->commandTester->execute(['filepath' => $invalidFilePath]);

        // shows and verifies output in terms of a failure
        $output = $this->commandTester->getDisplay();
        $this->assertStringNotContainsString('Done', $output);
        $this->assertNotEquals(0, $this->commandTester->getStatusCode());
    }
}
