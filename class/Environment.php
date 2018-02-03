<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

/**
 * Class Environment
 * @package CodeMommy\DevelopPHP;
 */
class Environment
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
        system('composer -V');
        system('php -v');
        system('php -m');
    }
}
