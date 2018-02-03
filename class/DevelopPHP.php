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
        $content = file_get_contents('.develop.json');
        $json = json_decode($content, true);
        return isset($json[$key]) ? $json[$key] : $default;
    }
}
