<?php

function redirect($link) {
    $REQUEST_SCHEME = filter_input(INPUT_SERVER, 'REQUEST_SCHEME');
    $SERVER_NAME = filter_input(INPUT_SERVER, 'SERVER_NAME');
    $PHP_SELF = filter_input(INPUT_SERVER, 'PHP_SELF');

    $http = str_replace('index.php', '', "{$REQUEST_SCHEME}://{$SERVER_NAME}{$PHP_SELF}{$link}");
    return $http;
}

