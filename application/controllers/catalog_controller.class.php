<?php

class Catalog_Controller extends ControllerAbstract {

    function action_index() {
        $this->view->setMainTemplate('_inner');
        
        $alias = $this->router->getParameter('alias');
        $page = $this->model->getCurrentPages($this->prefixLang(TBLE_SITE_PAGES), array($this->router->getSelfAlias()));
        
        if (!empty($alias)) {
			$this->view->setInnerTemplate('/blocks/inner');
            $textCatalog = $this->model->whereRowSelect($this->prefixLang('site_catalog'), 'alias = ? AND page_parent = ?', array($alias, $page['id']));
            if (empty($textCatalog)) {
                $this->view->header('HTTP/1.1 404 Not Found');
                $this->view->setInnerTemplate('_404');
            } else {
                $this->view->setTitle($textCatalog['html_title']);
                $this->view->setKeywords($textCatalog['html_keywords']);
                $this->view->setDescription($textCatalog['html_description']);
                $this->view->setTemplateVar('textPage', $textCatalog['text_page']);
                $this->view->setTemplateVar('titlePage', $textCatalog['title_page']);
            }
        } 
		else if ($page['alias']=='services'){
			$this->view->setInnerTemplate('tpl_services');
			$this->view->setTitle($page['html_title']);
            $this->view->setKeywords($page['html_keywords']);
            $this->view->setDescription($page['html_description']);
            $this->view->setTemplateVar('textPage', $page['text_page']);
            $this->view->setTemplateVar('titlePage', $page['short_title']);
		}
		else {
			$this->view->setInnerTemplate('/blocks/inner');
            $this->view->setTitle($page['html_title']);
            $this->view->setKeywords($page['html_keywords']);
            $this->view->setDescription($page['html_description']);
            $this->view->setTemplateVar('textPage', $page['text_page']);
            $this->view->setTemplateVar('titlePage', $page['short_title']);
        }
    }

}
