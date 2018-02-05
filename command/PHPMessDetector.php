<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use DOMDocument;
use CodeMommy\TaskPHP\Console;

/**
 * Class PHPMessDetector
 * @package CodeMommy\DevelopPHP;
 */
class PHPMessDetector implements ScriptInterface
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
        return Config::get('PHPMessDetector.File', array(
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
     * Get Rule To Delete
     * @return array
     */
    private static function getRuleToDelete()
    {
        return array(
            'cleancode' => array(
                'StaticAccess'
            )
        );
    }

    /**
     * Remove Rule
     */
    private static function removeRule()
    {
        Console::printLine('Start Remove Rule', 'information');
        $ruleToDelete = self::getRuleToDelete();
        foreach ($ruleToDelete as $fileName => $ruleName) {
            $file = sprintf('vendor/phpmd/phpmd/src/main/resources/rulesets/%s.xml', $fileName);
            $ruleDocument = new DOMDocument();
            $ruleDocument->load($file);
            $ruleSet = $ruleDocument->getElementsByTagName('rule');
            foreach ($ruleSet as $rule) {
                foreach ($rule->attributes as $attribute) {
                    if ($attribute->nodeName == 'name' && in_array($attribute->nodeValue, $ruleName)) {
                        $rule->parentNode->removeChild($rule);
                    }
                }
            }
            $ruleDocument->save($file);
        }
        Console::printLine('Remove Rule Finished', 'success');
    }

    /**
     * Start
     */
    public static function start()
    {
        Clean::workbench();
        self::removeRule();
        Console::printLine('Start PHP Mess Detector', 'information');
        $files = implode(',', self::getFileList());
        $rules = implode(',', self::getRuleList());
        $command = sprintf('"vendor/bin/phpmd" %s text %s', $files, $rules);
        system($command, $returnCode);
        if(intval($returnCode) == 0){
            Console::printLine('PHP Mess Detector Finished', 'success');
            return;
        }
        Console::printLine('PHP Mess Detector Error', 'error');
        return;
    }
}
