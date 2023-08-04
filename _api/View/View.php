<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author Witor
 */

namespace View {

    use Exception;

    class View {

        private static $view;
        private static $data;

        public static function run(string $view, array $data = null) {
            if (filter_var(trim(ltrim($view)), FILTER_SANITIZE_STRING)):
                (string) self::$view = $view;
                return self::includeView($data);
            endif;
            throw new Exception('Error na view');
        }

        private static function data($data) {
            if (!is_null($data) && filter_var_array($data, FILTER_DEFAULT)):
                global $data;
                return true;
            else:
                return false;
            endif;
            throw new Exception('Error ao enviar dados para a view!');
        }

        private static function includeView($data) {
            $view = APP_ROOT . DS . 'resources' . DS . 'Views' . DS . self::$view . '.phtml';
            require APP_ROOT . DS . 'resources' . DS . 'Views' . DS . 'default' . DS . 'header.phtml';
            if (!include $view):
                throw new Exception('Error ao incluir a view: ', self::$view);
            endif;
            require_once APP_ROOT . DS . 'resources' . DS . 'Views' . DS . 'default' . DS . 'footer.phtml';

            self::data($data);
        }

    }

}