<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asset
 *
 * @author Witor
 */

namespace Assets {

    class Asset {

        private static $asset;
        private static $assetDir;

        public static function inc(string $asset) {
            self::httpUrl();
            if ($asset && strip_tags(filter_var(trim(ltrim($asset)), FILTER_SANITIZE_STRING))):
                return self::$asset = self::$assetDir . $asset;
            endif;
        }

        public static function httpUrl() {
            $REQUEST_SCHEME = filter_input(INPUT_SERVER, 'REQUEST_SCHEME');
            $SERVER_NAME = filter_input(INPUT_SERVER, 'SERVER_NAME');
            $REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
            self::$assetDir = "{$REQUEST_SCHEME}://{$SERVER_NAME}{$REQUEST_URI}";
        }

    }

}