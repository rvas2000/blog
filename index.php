<?php
//phpinfo();
ini_set('display_errors', 1);

use Opus\App;

require_once __DIR__ . '/autoload.php';

App::getInstance()->run();

