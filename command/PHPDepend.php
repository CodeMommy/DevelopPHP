<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;
use CodeMommy\DevelopPHP\Library\Config;

/**
 * Class PHPDepend
 * @package CodeMommy\DevelopPHP;
 */
class PHPDepend implements ScriptInterface
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
     * Get File List
     * @return array
     */
    private static function getFileList()
    {
        return Config::get('PHPDepend.File', array(
            'autoload.php',
            'interface',
            'class',
            'library',
            'script',
            'test',
            'test_case'
        ));
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
        Console::printLine('Start Clean PHP Depend Report', 'information');
        $removeList = array(
            self::getBasePath()
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean PHP Depend Report Finished', 'success');
            return true;
        }
        Console::printLine('Clean PHP Depend Report Error', 'error');
        return false;
    }

    /**
     * Start
     */
    public static function start()
    {
        Clean::workbench();
        Console::printLine('Start PHP Depend', 'information');
        $path = sprintf('%s%sPHPDependReport', self::getWorkbenchPath(), DIRECTORY_SEPARATOR);
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $reportJdependChart = sprintf('%s%sjdepend.svg', $path, DIRECTORY_SEPARATOR);
        $reportOverviewPyramid = sprintf('%s%spyramid.svg', $path, DIRECTORY_SEPARATOR);
        $files = implode(',', self::getFileList());
        $command = sprintf(
            '"vendor/bin/pdepend" --jdepend-chart="%s" --overview-pyramid="%s" %s',
            $reportJdependChart,
            $reportOverviewPyramid,
            $files
        );
        system($command, $returnCode);
        if (intval($returnCode) != 0) {
            Console::printLine('PHP Depend Error', 'error');
            return;
        }
        Console::printLine('PHP Depend Finished', 'success');
        if (is_file($reportJdependChart)) {
            Console::printLine('Open Jdepend Chart Report', 'success');
            system(sprintf('start %s', $reportJdependChart));
        }
        if (is_file($reportOverviewPyramid)) {
            Console::printLine('Open Overview Pyramid Report', 'success');
            system(sprintf('start %s', $reportOverviewPyramid));
        }
        if (!is_file($reportJdependChart) && !is_file($reportOverviewPyramid)) {
            Console::printLine('No PHP Depend Report', 'information');
        }
    }
}
