<?php

use App\Application;

require_once realpath('../vendor/autoload.php');
require_once realpath('../config/config.php');

try {
    Application::getInstance()->boot();
} catch (RuntimeException $e) {
    print_r($e->getMessage());
}