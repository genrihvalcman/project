<?php

class Prices_Controller extends ControllerAbstract {

    function action_index() {
        $this->view->setMainTemplate('_inner');
        $this->view->setInnerTemplate('tpl_prices');
        $page = $this->model->getCurrentPages($this->prefixLang(TBLE_SITE_PAGES), array($this->router->getSelfAlias()));
        $this->view->setTitle($page['html_title']);
        $this->view->setKeywords($page['html_keywords']);
        $this->view->setDescription($page['html_description']);
        
        $pricesSite = $this->model->whereAllSelect($this->prefixLang('site_prices'), 'type_prices = ? ORDER BY sort_prices ASC', array('сайты'));
        $this->view->setTemplateVar('pricesSite', $pricesSite);
        
    }
}
