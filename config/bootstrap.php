<?php

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => CONF_DB_DRIVER,
    'host' => CONF_DB_HOST,
    'port' => CONF_DB_PORT,
    'database' => CONF_DB_BASE,
    'username' => CONF_DB_USER,
    'password' => CONF_DB_PASSWD,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));

// Torne o Capsule disponível globalmente
$capsule->setAsGlobal();

// Inicialize o Eloquent ORM
$capsule->bootEloquent();

try {
    $capsule->getConnection()->getPdo();
} catch (PDOException $e) {
    logger('logs')->error($e->getMessage());
}