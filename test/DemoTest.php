<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace CodeMommy\Test;

use Exception;
use CodeMommy\DevelopPHP\PHPUnitBase;

/**
 * Class DemoTest
 * @package CodeMommy\Test
 */
class DemoTest extends PHPUnitBase
{
    /**
     * DemoTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Demo
     * @throws Exception
     * @return void
     */
    public function testDemo()
    {
        $this->assertTrue(true);
    }
}
