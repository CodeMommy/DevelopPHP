<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\DevelopPHP;

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class PHPUnitBase
 * @package CodeMommy\DevelopPHP
 */
abstract class PHPUnitBase extends TestCase
{
    const TEST_CASE_PATH = 'test_case';

    /**
     * Test Case Path
     * @var string
     */
    private $testCasePath = '';

    /**
     * PHPUnitBase constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->testCasePath = self::TEST_CASE_PATH;
    }

    /**
     * Get Test Case Path
     * @param string $path
     * @return string
     */
    protected function getTestCasePath($path = '')
    {
        if (empty($path)) {
            return $this->testCasePath;
        }
        $path = trim($path, '/\\');
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        return sprintf('%s%s%s', $this->testCasePath, DIRECTORY_SEPARATOR, $path);
    }
}
