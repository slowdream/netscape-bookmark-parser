<?php

declare(strict_types=1);

namespace Shaarli\NetscapeBookmarkParser;

use Katzgrau\KLogger\Logger;
use Psr\Log\LogLevel;

/**
 * Class ImportLoggerTest
 *
 * Make sure that the log file is correctly generated.
 */
class ImportLoggerTest extends TestCase
{
    /**
     * @var NetscapeBookmarkParser instance
     */
    protected $parser = null;

    /**
     * Initialize test resources
     */
    protected function setUp(): void
    {
        $this->parser = new NetscapeBookmarkParser();
    }

    /**
     * Delete log file.
     */
    protected function tearDown(): void
    {
        @unlink(LoggerTestsUtils::getLogFile());
        @unlink(LoggerTestsUtils::getLogFile('tmp') ?? '');
        @rmdir('tmp');
    }

    /**
     * Make sure that the log is created an contains INFO logs, without DEBUG logs.
     */
    public function testLoggerInfo()
    {
        $this->parser->parseFile('tests/input/shaarli.htm');
        $this->assertFileExists(LoggerTestsUtils::getLogFile());
        $content = file_get_contents(LoggerTestsUtils::getLogFile());
        $this->assertContainsPolyfill('[info]', $content);
        $this->assertNotContainsPolyfill('[debug]', $content);
    }

    /**
     * Make sure that the log is created an contains INFO and DEBUG logs.
     */
    public function testLoggerDebug()
    {
        $this->parser = new NetscapeBookmarkParser(true, [], '0');
        $this->parser->setLogger(new Logger(
            'logs',
            LogLevel::DEBUG,
            [
                'prefix' => 'import.',
                'extension' => 'log',
            ]
        ));
        $this->parser->parseFile('tests/input/shaarli.htm');
        $this->assertFileExists(LoggerTestsUtils::getLogFile());
        $content = file_get_contents(LoggerTestsUtils::getLogFile());
        $this->assertContainsPolyfill('[info]', $content);
        $this->assertContainsPolyfill('[debug]', $content);
    }

    /**
     * Test custom directory for logs.
     */
    public function testLoggerAlternativeDir()
    {
        mkdir('tmp');
        $this->parser = new NetscapeBookmarkParser(true, [], '0');
        $this->parser->setLogger(new Logger(
            'tmp',
            LogLevel::INFO,
            [
                'prefix' => 'import.',
                'extension' => 'log',
            ]
        ));
        $this->parser->parseFile('tests/input/shaarli.htm');
        $this->assertFileExists(LoggerTestsUtils::getLogFile('tmp'));
    }
}
