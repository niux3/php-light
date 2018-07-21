<?php

    namespace App\Libs\cookie;

    class Cookie{
        private static $_instance = null;

        private function __construct(){}

        public static function initialize() {
            if(is_null(self::$_instance)) {
                self::$_instance = new Cookie();
            }
            return self::$_instance;
        }

        public function make($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false){
            if(!setcookie($name, $value, $expire, $path, $domain, $secure, $httponly)){
                throw new Exception("Le cookie ne peut être créé");
            }
        }

        public function get($key, $default = null){
            if (array_key_exists($key, $_COOKIE)) {
                return $_COOKIE[$key];
            }
            return $default;
        }

        public function set($key, $value){
            $_COOKIE[$key] = $value;
        }

        public function delete($key){
            if (array_key_exists($key, $_COOKIE)) {
                unset($_COOKIE[$key]);
            }
        }

        public function __set($key, $value){
            $this->set($key, $value);
        }

        public function __get($key){
            return $this->get($key);
        }

        public function __isset($key){
            return array_key_exists($key, $_COOKIE);
        }

        public function __unset($key){
            $this->delete($key);
        }
    }
