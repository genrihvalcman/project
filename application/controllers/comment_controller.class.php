<?php

class Comment_Controller extends ControllerAbstract {

    function action_index() {

        $this->view->setMainTemplate('_inner');
        $this->view->setInnerTemplate('/blocks/comment');
        $page = $this->model->getCurrentPages($this->prefixLang(TBLE_SITE_PAGES), array($this->router->getSelfAlias()));
		$this->view->setTitle($page['html_title']);
		$this->view->setKeywords($page['html_keywords']);
		$this->view->setDescription($page['html_description']);
		
		
		$commentQuery = $this->model->allSelect('site_comment ORDER BY id DESC');
		$this->view->setTemplateVar('commentQuery', $commentQuery);
		
		if ($this->request->send_com) {
			$com_name = $this->request->name_com;
			$com_email = $this->request->email_com;
			$com_text = $this->request->text_com;
			$recaptcha = $this->request->g-recaptcha-response;

			if ($com_name == "" || $com_text == "") {
				sleep(1);
				$this->redirect('/comments/?err=1#comment');
				//$this->view->setTemplateVar('error', 'Не заполнены обязательные поля!<br/>');
			}
			else {
				$curdate = date("Y-m-d");
				$this->model->insert("site_comment", array(
					"com_name" => $com_name,
					"com_email" => $com_email,
					"com_text" => $com_text,
					"com_date"=> $curdate
				));
				sleep(1);
				$this->redirect('/comments/#new_comment');
			}
		}
		

    }
	
}
