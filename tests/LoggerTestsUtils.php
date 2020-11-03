<?php

declare(strict_types=1);

namespace Shaarli\NetscapeBookmarkParser;

/**
 * Class LoggerTestsUtils
 *
 * Utility class for tests regarding the logger.
 */
class LoggerTestsUtils
{
    /**
     * Retrieve the
     *
     * @param string|null $directory
     *
     * @return string|null
     */
    public static function getLogFile(?string $directory = 'logs'): ?string
    {
        $logs = glob($directory . '/import*.log');
        return ! empty($logs) ? $logs[0] : null;
    }
}
