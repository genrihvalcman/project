<?php

class View {

    protected $mainTpl = '_main';
    protected $mainTplPath = DIR_TPL;
    protected $viewNamePath = DIR_TPL;
    protected $templateVar = null;
    protected $viewName = '_main';
    protected $pageBlock = null;
    protected $lang ;
    public static $key;
    private static $instance;
    protected $lanfFile = DIR_LANG;

    public function __construct() {
        $this->templateVar = Array();
        $this->pageBlock = Array();
        $this->lang = new LangParse($this->lanfFile);
    }

    private function __clone() {
        
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setInnerTemplate($fileName, $filePath = '') {
        $this->viewName = $fileName;
        if (!empty($filePath)) {
            $this->viewNamePath = $filePath;
        }
    }

    public function setMainTemplate($fileName, $filePath = '') {
        $this->mainTpl = $fileName;
        if (!empty($filePath)) {
            $this->mainTplPath = $filePath;
        }
    }

    protected function glueWithSlash($leftPart, $rightPart) {
        if (substr($leftPart, -1, 1) === '/') {
            $leftPart = substr($leftPart, 0, -1);
        }
        if (substr($rightPart, 0, 1) === '/') {
            $rightPart = substr($leftPart, 1);
        }
        return $leftPart . '/' . $rightPart;
    }

    public function display() {

        $viewFile = $this->glueWithSlash(strtolower($this->mainTplPath), $this->mainTpl . '.php');
          
        if (file_exists($viewFile)) {
            $viewRef = $this;
            //открываем переменные для шаблона
            foreach ($this->templateVar as $key => $val) {

                global $$key;
                $$key = $val;
            }
            if (!empty($this->headers)) {
                $this->sendHeaders();
            }
            
            include_once($viewFile);
        }
    }
    
    public function printPageBlock($blockName, $filePath = DIR_TPL_BLOCKS) {
        foreach ($this->templateVar as $key => $val) {
            global $$key;
        }
         $blockFile = $this->glueWithSlash(strtolower($filePath), $blockName . '.php');
        if (file_exists($blockFile)) {
            include $blockFile;
        }
}

public function getPageContent() {
        $viewFile = $this->viewNamePath . strtolower($this->viewName) . '.php';
        if (!file_exists($viewFile)) {
            //добавить вариант с .аякс
            $viewFile = $this->viewNamePath . strtolower($this->viewName) . '.ajax.php';
        }
        if (file_exists($viewFile)) {
            //открываем переменные для шаблона
            foreach ($this->templateVar as $key => $val) {
                global $$key;
            }
            include_once($viewFile);
        } else {
            echo "Шаблон не найден  \"" . $this->viewName . "\"";
        }
    }

    public function setTitle($title) {
        $this->pageTitle = $title;
    }

    public function title() {
        return '<title>' . $this->pageTitle . '</title>';
    }
    
    public function setDescription($desc) {
        $this->desc = $desc;
    }

    public function description() {
        return '<meta name="description" content="'. $this->desc .'"> ';
    }
    
    public function setKeywords($keyw) {
        $this->keyw = $keyw;
    }

    public function keywords() {
        return '<meta name="Keywords" content="'. $this->keyw .'"> ';
    }
    
    public function setScript($script){
        $this->script = $script;        
    }
    
    public function script(){
        if(!empty($this->script)){
            if(is_array($this->script)){
                foreach ($this->script as $value) {
                  $script .=  '<script src="'.DIR_JS.$value.'.js" type="text/javascript"></script>';
                }
            }else{
                $script =  '<script src="'.DIR_JS.$value.'.js" type="text/javascript"></script>';
            }
             return $script; 
        }
    }
    
    public function setCss($css){
        $this->css = $css;        
    }
    
    public function css(){
        if(!empty($this->css)){
            if(is_array($this->css)){
                foreach ($this->css as $value) {
                  $css .=  ' <link href="'.DIR_CSS.$value.'.css" rel="stylesheet" type="text/css" />';
                }
            }else{
                $css =  '<link href="'.DIR_CSS.$value.'.css" rel="stylesheet" type="text/css" />';
            }
            return $css;
        }
    }

    public function setTemplateVar($key, $value) {
        $this->templateVar[$key] = $value;
    }
    
    //Добавляет новый хедер к текущему списку (но НЕ отправляет хедеры браузеру!) 
    public function header($directive) {
        $this->headers[] = $directive;
    }
    
    //Отправляет хедер или список хедеров браузеру
    public function sendHeaders($headers = null) {
        if (empty($headers)) {
            foreach ($this->headers as $header) {
                header($header);
            }
        } else
        if (is_array($headers)) {
            foreach ($headers as $header) {
                header($header);
            }
        } else {
            header($headers);
        }
    }
    
    function getLang($name) {
      return $this->lang->getLangText($name);    
    }

}
