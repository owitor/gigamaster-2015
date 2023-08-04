<?php


/**
 * Inicia o autoload da aplicação e inicia as funcionalidades
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'bootstrap.php';

/**
 * Carregamento das rotas
 */
require_once APP_ROOT . DS . 'app' . DS . 'route.php';

/**
 * Carregando as rotas
 */
$app = new Application\App();

return $app->run();