<?php

class LangParse {
	
	private $data;
        private static $instance;
        private $pathlang;

        public function __construct($file = CNTRL_DIR_LANG) {
		$this->data = parse_ini_file($file);
	}
        
        public static function getInstance() {
           if (self::$instance === null)
               self::$instance = new self;
           return self::$instance;
       }
	
	public function getLangText($name) {
		return $this->data[$name];
	}
	
}