<?php



require __DIR__ . '/config/includes.php';

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

use app\core\Core;

$core = new Core();
$core->run();
?>
