<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

/**
 * Class Test
 * @package CodeMommy\DevelopPHP;
 */
class Test
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
        PHPUnit::start();
        PHPCodeBeautifierAndFixer::start();
        PHPCodeSniffer::start();
        PHPMessDetector::start();
    }
}
