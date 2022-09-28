<?php
ini_set('display_errors', 0);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';
require __DIR__ . '/config/helpers.php';

use app\core\Core;

$core = new Core();
$core->run();
?>
