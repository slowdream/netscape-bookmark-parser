<?php

namespace Shaarli\NetscapeBookmarkParser;

/**
 * Ensure that trying to import an empty file is handled properly.
 */
class ParseEmptyFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Delete log file.
     */
    public function tearDown()
    {
        @unlink(LoggerTestsUtils::getLogFile());
    }

    /**
     * Parse flat Firefox bookmarks (no directories)
     */
    public function testParseFlat()
    {
        $parser = new NetscapeBookmarkParser();
        $data = $parser->parseFile('tests/input/empty.htm');

        static::assertTrue(is_array($data));
        static::assertCount(0, $data);
    }
}
