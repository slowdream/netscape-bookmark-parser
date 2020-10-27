<?php

declare(strict_types=1);

namespace Shaarli\NetscapeBookmarkParser;

/**
 * Helper class extending \PHPUnit\Framework\TestCase.
 * Used to make Shaarli UT run on multiple versions of PHPUnit.
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * assertContains is now used for iterable, strings should use assertStringContainsString
     */
    public function assertContainsPolyfill($expected, $actual, string $message = ''): void
    {
        if (is_string($actual) && method_exists($this, 'assertStringContainsString')) {
            static::assertStringContainsString($expected, $actual, $message);
        } else {
            static::assertContains($expected, $actual, $message);
        }
    }

    /**
     * assertNotContains is now used for iterable, strings should use assertStringNotContainsString
     */
    public function assertNotContainsPolyfill($expected, $actual, string $message = ''): void
    {
        if (is_string($actual) && method_exists($this, 'assertStringNotContainsString')) {
            static::assertStringNotContainsString($expected, $actual, $message);
        } else {
            static::assertNotContains($expected, $actual, $message);
        }
    }
}
