<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;

/**
 * Class UpdateProject
 * @package CodeMommy\DevelopPHP;
 */
class UpdateProject implements ScriptInterface
{
    /**
     * UpdateProject constructor.
     */
    public function __construct()
    {
    }

    /**
     * Start
     */
    public static function start()
    {
        Console::printLine('Git Pull', 'information');
        system('git pull');
        Console::printLine('Update Composer', 'information');
        system('composer self-update');
        Console::printLine('Update Vendor', 'information');
        system('composer update');
    }
}
