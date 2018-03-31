<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;

/**
 * Class Environment
 * @package CodeMommy\DevelopPHP;
 */
class Environment implements ScriptInterface
{
    /**
     * Environment constructor.
     */
    public function __construct()
    {
    }

    /**
     * Start
     */
    public static function start()
    {
        Console::printLine('Composer Version', 'information');
        system('composer -V');
        Console::printLine('PHP Version', 'information');
        system('php -v');
        Console::printLine('PHP Modules', 'information');
        system('php -m');
    }
}
