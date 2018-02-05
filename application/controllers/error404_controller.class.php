<?php

class Error404_Controller extends ControllerAbstract{
    function  action_index(){
        $this->view->header('HTTP/1.1 404 Not Found');
        $this->view->setInnerTemplate('_404');   
    }
}