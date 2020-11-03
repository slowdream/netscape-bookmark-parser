<?php

namespace Shaarli\NetscapeBookmarkParser;

class ParseShaarliWithWhitespaceTagsTest extends TestCase
{
    /**
     * Delete log file.
     */
    public function tearDown(): void
    {
        @unlink(LoggerTestsUtils::getLogFile());
    }

    /**
     * Parse flat Chromium bookmarks (no directories)
     */
    public function testParseFlat()
    {
        $parser = new NetscapeBookmarkParser(false, null, '1');
        $bkm = $parser->parseFile('tests/input/shaarli_with_whitespace_tags.htm');

        static::assertSame(
            trim(file_get_contents('tests/output/shaarli_with_whitespace_tags.txt')),
            $bkm[0]['note']
        );
        static::assertSame(
            [
                'dev',
                'php dev',
                'php 7.x',
            ],
            $bkm[0]['tags']
        );
    }
}
