<?php

ob_start();

/**
 * Inicia aplicação
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_src' . DIRECTORY_SEPARATOR . 'app.php';

ob_end_flush();
