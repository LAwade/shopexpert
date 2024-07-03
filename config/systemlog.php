<?php

ini_set('display_errors', 0);
// Configurações de log do PHP
ini_set('log_errors', 'On');
ini_set('error_log', CONF_LOGGER_PATH . '/system.log');

// Configura o nível de relatórios de erro
error_reporting(E_ALL);
