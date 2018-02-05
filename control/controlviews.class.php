<?php

class ControlViews extends View{
    
    public function __construct() {
        parent::__construct();
        $this->lang = new LangParse(CNTRL_DIR_LANG);
    }
}

