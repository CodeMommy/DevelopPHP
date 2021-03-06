<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;

/**
 * Class PHPUnit
 * @package CodeMommy\DevelopPHP;
 */
class PHPUnit implements ScriptInterface
{
    const BASE_PATH_NAME = 'CodeMommy';

    /**
     * Base Path
     * @var string
     */
    private static $basePath = '';

    /**
     * Workbench Path
     * @var string
     */
    private static $workbenchPath = '';

    /**
     * PHPUnit constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get Base Path
     * @return string
     */
    private static function getBasePath()
    {
        if (empty(self::$basePath)) {
            self::$basePath = sprintf('%s%s%s', sys_get_temp_dir(), DIRECTORY_SEPARATOR, self::BASE_PATH_NAME);
        }
        return self::$basePath;
    }

    /**
     * Get Workbench Path
     * @return string
     */
    private static function getWorkbenchPath()
    {
        if (empty(self::$workbenchPath)) {
            self::$workbenchPath = sprintf(
                '%s%s%s%s',
                self::getBasePath(),
                DIRECTORY_SEPARATOR,
                time(),
                rand(100, 999)
            );
        }
        return self::$workbenchPath;
    }

    /**
     * Clean
     * @return bool
     */
    public static function clean()
    {
        Console::printLine('Start Clean PHPUnit Report', 'information');
        $removeList = array(
            self::getBasePath()
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean PHPUnit Report Finished', 'success');
            return true;
        }
        Console::printLine('Clean PHPUnit Report Error', 'error');
        return false;
    }

    /**
     * Start
     */
    public static function start()
    {
        Clean::workbench();
        Console::printLine('Start PHPUnit', 'information');
        $coveragePath = sprintf('%s%sCodeCoverageReport', self::getWorkbenchPath(), DIRECTORY_SEPARATOR);
        $coveragePathHTML = sprintf('%s%sHTML', $coveragePath, DIRECTORY_SEPARATOR);
        $coverageFileHTML = sprintf('%s%sindex.html', $coveragePathHTML, DIRECTORY_SEPARATOR);
        $coverageFileClover = sprintf(
            '%s%sClover%sclover.xml',
            $coveragePath,
            DIRECTORY_SEPARATOR,
            DIRECTORY_SEPARATOR
        );
        $command = sprintf(
            '"vendor/bin/phpunit" -v --coverage-html="%s" --coverage-clover="%s"',
            $coveragePathHTML,
            $coverageFileClover
        );
        system($command, $returnCode);
        if (intval($returnCode) != 0) {
            Console::printLine('PHPUnit Error', 'error');
            return;
        }
        Console::printLine('PHPUnit Finished', 'success');
        if (is_file($coverageFileHTML)) {
            Console::printLine('Open PHPUnit Report', 'success');
            system(sprintf('start %s', $coverageFileHTML));
            return;
        }
        Console::printLine('No PHPUnit Report', 'information');
    }
}
