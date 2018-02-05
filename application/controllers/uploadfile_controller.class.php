<?php

class UploadFile_Controller extends ControllerAbstract {

    function action_index() {
       $this->view->setMainTemplate('_ajax');
       $res = $this->upload->uploadFile('form', DIR_USER_FILE_R.'form/', array('doc', 'docx'), date("d_m_Y_H_i_s").'_');
       $this->view->setTemplateVar('json',  $res);
        if($this->request->or_name != '' && $this->request->or_tel != '' &&  $this->request->or_emal != ''){
         $success = array();
            $mass = " 
                <b>Имя:</b> ".$this->request->or_name." <br>
                <b>Тел:</b> ".$this->request->or_tel." <br>
                <b>Email:</b> ".$this->request->or_emal." <br>
                <b>Skype:</b> ".$this->request->or_skype." <br>
                <b>Анкета:</b> ".$this->request->ro_fileName." <br>
                <b>Сообщение:</b><br> ".$this->request->or_mass." <br>
            ";
            
            $mailRes = $this->sendmail->mail('arkasha-94@mail.ru', 'Анкета', $mass, 'Onero Technology');  
            if($mailRes){
                $success['success'] = 'success';
            }
            $this->view->setTemplateVar('json',  $success); 
        }   
    }
    
    function action_sendMail() {
        $this->view->setMainTemplate('_ajax');
        if($this->request->rf_email != '' && $this->request->rf_name){
         $success = array();
            $mass = " 
                <b>Имя:</b> ".$this->request->rf_name." <br>
                <b>Email:</b> ".$this->request->rf_email." <br>
                <b>Тема:</b> ".$this->request->rf_select." <br>
                <b>Сообщение:</b><br> ".$this->request->rf_text." <br>
            ";
            
            $mailRes = $this->sendmail->mail('petsik@list.ru', 'Обратная связь - '.$this->request->rf_select, $mass, 'адвокат');  
            if($mailRes){
                $success['success'] = 'success';
            }
            $this->view->setTemplateVar('json',  $success); 
        }    
    }    
}
