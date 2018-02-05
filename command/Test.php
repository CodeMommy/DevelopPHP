<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;

/**
 * Class Test
 * @package CodeMommy\DevelopPHP;
 */
class Test implements ScriptInterface
{
    /**
     * Test constructor.
     */
    public function __construct()
    {
    }

    /**
     * Start
     */
    public static function start()
    {
        Console::printLine('Start Test', 'information');
        PHPUnit::start();
        PHPCodeBeautifierAndFixer::start();
        PHPCodeSniffer::start();
        PHPMessDetector::start();
        Console::printLine('Test Finished', 'success');
    }
}
