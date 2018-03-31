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
 * Class Clean
 * @package CodeMommy\DevelopPHP;
 */
class Clean implements ScriptInterface
{
    /**
     * Clean constructor.
     */
    public function __construct()
    {
    }

    /**
     * Workbench
     */
    public static function workbench()
    {
        Console::printLine('Start Clean Workbench', 'information');
        $removeList = Config::get('Clean.Workbench', array(
            'workbench'
        ));
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean Workbench Finished', 'success');
            return;
        }
        Console::printLine('Clean Workbench Error', 'error');
        return;
    }

    /**
     * PHPUnit
     */
    public static function phpUnit()
    {
        PHPUnit::clean();
    }

    /**
     * PHP Depend
     */
    public static function phpDepend()
    {
        PHPDepend::clean();
    }

    /**
     * All
     */
    public static function all()
    {
        self::workbench();
        self::phpUnit();
        self::phpDepend();
    }

    /**
     * Start
     */
    public static function start()
    {
        self::all();
    }
}
