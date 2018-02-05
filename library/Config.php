<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP\Library;

/**
 * Class Config
 * @package CodeMommy\DevelopPHP\Library;
 */
class Config
{
    /**
     * @var array
     */
    private static $configCache = array();

    /**
     * Config constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key = '', $default = null)
    {
        if (isset(self::$configCache[$key])) {
            return self::$configCache[$key];
        }
        $file = '.develop.json';
        if (!is_file($file)) {
            return $default;
        }
        $content = file_get_contents($file);
        $config = json_decode($content, true);
        $keys = explode('.', $key);
        for ($index = 0; $index < count($keys); $index++) {
            if (!is_array($config) || !isset($config[$keys[$index]])) {
                return $default;
            }
            $config = $config[$keys[$index]];
        }
        self::$configCache[$key] = $config;
        return $config;
    }
}
