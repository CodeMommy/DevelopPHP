<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

require_once('library/Autoload.php');

use CodeMommy\DevelopPHP\Library\Autoload;

$autoloadDirectory = array(
    'library' => 'CodeMommy\\DevelopPHP\\Library',
    'interface' => 'CodeMommy\\DevelopPHP',
    'class' => 'CodeMommy\\DevelopPHP',
    'command' => 'CodeMommy\\DevelopPHP'
);

Autoload::directory($autoloadDirectory);
