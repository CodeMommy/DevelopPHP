<?php

/**
 * CodeMommy DevelopPHP
 * @author Candison November <www.kandisheng.com>
 */

require_once('library/Autoload.php');

use CodeMommy\DevelopPHP\Library;

$autoloaDirectory = array(
    'class' => 'CodeMommy\\DevelopPHP',
    'interface' => 'CodeMommy\\DevelopPHP',
    'library' => 'CodeMommy\\DevelopPHP',
    'command' => 'CodeMommy\\DevelopPHP'
);

Library\Autoload::directory($autoloaDirectory);
