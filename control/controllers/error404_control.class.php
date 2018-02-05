<?php

class Error404_Control extends ControlController {
    
    function  action_index(){
        $this->view->header('HTTP/1.1 404 Not Found'); 
        $this->authUser();
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('_404', CNTRL_DIR_TPL);
        $this->view->setTitle('404 | Onero Technology');
        
    }
    
}