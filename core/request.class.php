<?php

class Request {

    private static $sef_data = array();
    private $data;
    private static $instance;

    public function __construct() {
        $this->data = $this->xss(array_merge($_REQUEST, self::$sef_data));
    }

    private function __clone() {
        
    }

    public static function getInstance() {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }

    function __get($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }

    private function xss($data) {
        if (is_array($data)) {
            $escaped = array();
            foreach ($data as $key => $value) {
                  
                $escaped[trim($key, '/')] = $this->xss($value);
            }
            return $escaped;
        }
        return trim(htmlspecialchars($data));
    }

    function generateHash($length = 6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }

}
