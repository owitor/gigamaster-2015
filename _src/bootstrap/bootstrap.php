<?php

/**
 * Configurações da aplicação
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'app.php';

/**
 * Funções Auxiliares
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'conf.php';


/**
 * Configurações do PHP
 */
require_once APP_ROOT . DS . 'conf' . DS . 'phpconf.php';

/**
 * Configurações do Banco
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'db.php';


/**
 * Autoload :: Carga Automatica da aplicação
 */
$autoload = APP_ROOT . DS . '..' . DS . '_api' . DS . 'Autoload' . DS . 'autoload.php';

if (!include($autoload)) {
    throw new Exception('Error ao incluir autoload');
}

return $autoload = new Autoload\Autoload(1);




