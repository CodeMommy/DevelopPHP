<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

/**
 * Class DevelopPHP
 * @package CodeMommy\DevelopPHP;
 */
class DevelopPHP
{
    /**
     * DevelopPHP constructor.
     */
    public function __construct()
    {
    }

    /**
     * Start
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getConfig($key = '', $default = null)
    {
        $file = '.develop.json';
        if (!is_file($file)) {
            return $default;
        }
        $content = file_get_contents($file);
        $json = json_decode($content, true);
        return isset($json[$key]) ? $json[$key] : $default;
    }
}
