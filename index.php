<?php

ini_set('display_errors', 1);
require __DIR__ . '/config/includes.php';

use app\core\Core;

$core = new Core();
$core->run();
?>
