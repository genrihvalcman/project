<?php

class Main_Control extends ControlController {

    function __construct() {
        parent::__construct();
        $this->authUser();
    }

    function action_index() {

        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('_main', CNTRL_DIR_TPL);
        $this->view->setTitle('Advokat');
        
        
    }

}
