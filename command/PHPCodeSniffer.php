<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use CodeMommy\TaskPHP\Console;
use CodeMommy\DevelopPHP\Library\Config;

/**
 * Class PHPCodeSniffer
 * @package CodeMommy\DevelopPHP;
 */
class PHPCodeSniffer implements ScriptInterface
{
    /**
     * PHPCodeSniffer constructor.
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
        return Config::get('PHPCodeSniffer.File', array(
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
        Console::printLine('Start PHP Code Sniffer', 'information');
        $files = implode(' ', self::getFileList());
        $command = sprintf('"vendor/bin/phpcs" %s --standard=PSR2', $files);
        system($command, $returnCode);
        if (intval($returnCode) == 0) {
            Console::printLine('PHP Code Sniffer Finished', 'success');
            return;
        }
        Console::printLine('PHP Code Sniffer Error', 'error');
        return;
    }
}
