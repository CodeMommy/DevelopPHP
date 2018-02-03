<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use DOMDocument;

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
        return DevelopPHP::getConfig('PHPMessDetector.File', array(
            'autoload.php',
            'interface',
            'class',
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
    }

    /**
     * Start
     */
    public static function start()
    {
        Clean::workbench();
        self::removeRule();
        $files = implode(',', self::getFileList());
        $rules = implode(',', self::getRuleList());
        $command = sprintf('"vendor/bin/phpmd" %s text %s', $files, $rules);
        system($command);
    }
}
