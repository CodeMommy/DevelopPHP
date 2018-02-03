<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

/**
 * Class PHPCodeBeautifierAndFixer
 * @package CodeMommy\DevelopPHP;
 */
class PHPCodeBeautifierAndFixer
{
    /**
     * PHPCodeBeautifierAndFixer constructor.
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
     * Start
     */
    public static function start()
    {
        Clean::workbench();
        $files = implode(' ', self::getFileList());
        $command = sprintf('"vendor/bin/phpcbf" %s --standard=PSR2', $files);
        system($command);
    }
}
