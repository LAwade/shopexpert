<?php

ini_set('display_errors', 0);
require __DIR__ . '/config/includes.php';

use app\core\Core;

$core = new Core();
$core->run();
?>
