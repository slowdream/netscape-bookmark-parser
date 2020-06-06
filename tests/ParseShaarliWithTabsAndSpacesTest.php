<?php

namespace Shaarli\NetscapeBookmarkParser;

class ParseShaarliWithTabsAndSpacesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Delete log file.
     */
    public function tearDown()
    {
        @unlink(LoggerTestsUtils::getLogFile());
    }

    /**
     * Parse flat Chromium bookmarks (no directories)
     */
    public function testParseFlat()
    {
        $parser = new NetscapeBookmarkParser(false, null, '1');
        $bkm = $parser->parseFile('tests/input/shaarli_with_tabs_and_spaces.htm');

        static::assertSame(
            trim(file_get_contents('tests/output/shaarli_with_tabs_and_spaces.txt')),
            $bkm[0]['note']
        );
    }
}
