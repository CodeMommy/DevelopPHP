<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

/**
 * Class UpdateProject
 * @package CodeMommy\DevelopPHP;
 */
class UpdateProject
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
        system('git pull');
        system('composer self-update');
        system('composer update');
    }
}
