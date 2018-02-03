<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

/**
 * Class PHPMessDetector
 * @package CodeMommy\DevelopPHP;
 */
class PHPMessDetector
{
    /**
     * PHPMessDetector constructor.
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
        return array(
            'autoload.php',
            'interface',
            'class',
            'script',
            'test',
            'test_case'
        );
    }

    /**
     * Get Rule List
     * @return array
     */
    private static function getRuleList()
    {
        return array(
            'cleancode',
            'codesize',
            'controversial',
            'design',
            'naming',
            'unusedcode'
        );
    }

    /**
     * Start
     */
    public static function start()
    {
        Clean::workbench();
        RemoveRule::start();
        $files = implode(',', self::getFileList());
        $rules = implode(',', self::getRuleList());
        $command = sprintf('"vendor/bin/phpmd" %s text %s', $files, $rules);
        system($command);
    }
}
