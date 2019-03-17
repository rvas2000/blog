<?php

use Opus\App;

//phpinfo();
ini_set('display_errors', 1);

if (! defined('BASE_PATH')) define('BASE_PATH', __DIR__);


require_once __DIR__ . '/autoload.php';

App::getInstance()->run();

