<?php

namespace app\core;
use \PDO;
use \PDOException;

class Connect {

    private static $instance;

    public static function getInstance(): PDO {
        if (empty(self::$instance)) {
            try {
                self::$instance = new PDO(
                        CONF_DB_DRIVER . ":host=" . CONF_DB_HOST
                        . ";port=" . CONF_DB_PORT
                        . ";dbname=" . CONF_DB_BASE,
                        CONF_DB_USER,
                        CONF_DB_PASSWD,
                        CONF_DB_OPTIONS);
            } catch (PDOException $ex) {
                
                include __DIR__."/../views/maintenance.php";
                die("<div class='form-group text-center py-4'><h3>Error connect to database: {$ex->getMessage()}!</h3></div>");
            }
        }

        return self::$instance;
    }

    public function __construct() { }

    public function __clone() { }

}
