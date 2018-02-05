<?php

class Index_Controller extends ControllerAbstract {

    function action_index() {
        $this->view->setMainTemplate('_main');
        $this->view->setInnerTemplate('tpl_index');
        $page = $this->model->getCurrentPages($this->prefixLang(TBLE_SITE_PAGES), array($this->router->getSelfAlias()));
            $this->view->setTitle($page['html_title']);
            $this->view->setKeywords($page['html_keywords']);
            $this->view->setDescription($page['html_description']);
            $this->view->setTemplateVar('textPage', $page['text_page']);
            $this->view->setTemplateVar('titlePage', $page['short_title']);
            
    }
    
}
