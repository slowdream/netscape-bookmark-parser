<?php

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
     * @param string $directory
     * @return bool
     */
    public static function getLogFile($directory = 'logs')
    {
        $logs = glob($directory . '/import*.log');
        return ! empty($logs) ? $logs[0] : false;
    }
}
