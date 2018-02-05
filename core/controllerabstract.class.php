<?php

abstract class ControllerAbstract {

    protected $model;
    protected $view;
    protected $router;
    protected $request;
    protected $pagenav;
    protected $upload;
    protected $sendmail;


    public function __construct() {
        $this->view = View::getInstance();
        $this->model = new SiteModel();
        $this->router = Route::getInstance();
        $this->request = Request::getInstance();
        $this->pagenav = new PageNav();
        $this->upload = new UPDFile();
        $this->sendmail = new SendMail();
    }

    public function &getView() {
        return $this->view;
    }
    
    function prefixLang($table){
		$cookie = trim($_COOKIE['siteLang']);
        if($cookie !== SITE_LANG && !empty($cookie)){$prefixLang = $cookie;}
        if(!empty($prefixLang)){ return $table = $table.'_'.$prefixLang;}else{ return $table;}
    }
     
    final protected function redirect($url) {
        header("Location: $url");
        exit;
    }
    


}
