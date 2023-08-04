<?php

/**
 * Description of Routing
 *
 * @author Witor
 */

namespace Route {

    class Routing {

        private static $route;
        private static $request;

        public static function get(string $route, string $request) {
            (string) self::$route = filter_var(trim($route), FILTER_SANITIZE_STRING);
            (array) self::$request = array_values(explode('@', filter_var(strip_tags(trim($request)), FILTER_SANITIZE_STRING)));
            self::getUrl();
        }

        private static function getUrl() {
            $url = explode('/', filter_var(strip_tags(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING)), FILTER_SANITIZE_STRING));
            if (isset($url) && $url[0] === self::$route):
                unset($url[0]);
                self::$request[2] = array_values($url);
                self::execute();
            endif;
        }

        private static function execute() {
            $controller = "Controllers\\" . self::$request[0];
            $controller = new $controller();
            if ($controller && method_exists($controller, self::$request[1])):
                call_user_func_array([$controller, self::$request[1]], self::$request[2]);
            endif;
        }

    }

}
