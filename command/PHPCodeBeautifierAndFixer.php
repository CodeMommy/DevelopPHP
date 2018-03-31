<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;
use CodeMommy\DevelopPHP\Library\Config;

/**
 * Class PHPCodeBeautifierAndFixer
 * @package CodeMommy\DevelopPHP;
 */
class PHPCodeBeautifierAndFixer implements ScriptInterface
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
        return Config::get('PHPCodeBeautifierAndFixer.File', array(
            'autoload.php',
            'interface',
            'class',
            'library',
            'script',
            'test',
            'test_case'
        ));
    }

    /**
     * Start
     */
    public static function start()
    {
        Clean::workbench();
        Console::printLine('Start PHP Code Beautifier And Fixer', 'information');
        $files = implode(' ', self::getFileList());
        $command = sprintf('"vendor/bin/phpcbf" %s --standard=PSR2', $files);
        system($command, $returnCode);
        if (intval($returnCode) == 0) {
            Console::printLine('PHP Code Beautifier And Fixer Finished', 'success');
            return;
        }
        Console::printLine('PHP Code Beautifier And Fixer Error', 'error');
        return;
    }
}
