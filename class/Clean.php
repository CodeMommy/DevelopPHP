<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;

/**
 * Class Clean
 * @package CodeMommy\DevelopPHP;
 */
class Clean
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
        $removeList = DevelopPHP::getConfig('Clean.Workbench', array(
            'workbench'
        ));
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean Workbench Finished.', 'success');
            return;
        }
        Console::printLine('Clean Workbench Error.', 'error');
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
     * All
     */
    public static function all()
    {
        self::workbench();
        self::phpUnit();
    }
}
