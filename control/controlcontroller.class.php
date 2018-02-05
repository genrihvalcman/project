<?php

class ControlController extends ControllerAbstract {

   protected $lang;
   protected $userAccess = '';


    public function __construct() {    
        parent::__construct();
        $this->model = new ControlModel();
        $this->view = new ControlViews();
        $this->menuControl();
        $this->checkAccessUser();
    }
    

    
function authUser(){
       if(isset($_SESSION['userControlHash']) !== ''){
        $checkUser = $this->model->selectCheckUser(array($_SESSION['userControlHash']));
        if(empty($checkUser)){
        $this->redirect('/control/auth/');
        } else {
            $this->view->setTemplateVar('userData', $checkUser);
            return $checkUser[user_access] ;
        }
    }
}
 

function menuControl (){  
     
    $userAccess = $this->model->rowSelectFieldWhere('user_access', 'fmw_control_user', ' user_hash = ? LIMIT 1', array($_SESSION['userControlHash']));
    $this->userAccess = $userAccess[user_access];
    
    if($this->userAccess === 'all' || empty($this->userAccess) ){
        $whereSelect = 't_active = ? AND t_show = ?';   
    }else{ 
       $whereSelect = 't_active = ? AND t_show = ? AND id IN ('.$this->userAccess.')';
    }
    if($this->userAccess !==''){
        $menuControl = $this->model->allSelectWhere('fmw_control_table', $whereSelect , array('1', '1'));

        foreach ($menuControl as $valueMenu) { 
            if($valueMenu[t_table_link] !== ''){
                $linkTableArr = explode(',', $valueMenu[t_table_link]);
                foreach ($linkTableArr as $valueLinkTable) {
                    $linkLangTableSql = $this->model->rowSelectWhere('fmw_control_table', 't_name = ?', array($valueLinkTable));
                    $linkTableArrVar[] = $linkLangTableSql;
                }
            }
        }   
    }   
        
                            
    $this->view->setTemplateVar('linkTableArr', $linkTableArrVar);
    $this->view->setTemplateVar('menuControl', $menuControl);
    
}

function checkAccessUser(){
    if($this->userAccess !== 'all'){
        $access = true;
        $uri = $_SERVER["REQUEST_URI"];
        $controller = explode("/", $uri);
        $accessController =  $controller[2]; 
        $idUserAccsess = explode(',', $this->userAccess);

        if($this->request->tbl){
            $checTableId = $this->model->rowSelectFieldWhere('id', 'fmw_control_table', 't_name = ?', array($this->request->tbl));
            if(!in_array($checTableId[id], $idUserAccsess)){
             $access = false;
            }
        }
        
        if($this->request->linktbl){
            $checTableId = $this->model->rowSelectFieldWhere('id', 'fmw_control_table', 't_name = ?', array($this->request->linktbl));
            if(!in_array($checTableId[id], $idUserAccsess)){
             $access = false;
            }
        }

        if($accessController !== 'main' && $accessController !== 'auth' && $accessController !== 'datatable' ){
         $checTableControllerId = $this->model->rowSelectFieldWhere('id', 'fmw_control_table', 't_controller = ?', array($accessController));
         if(!in_array($checTableControllerId[id], $idUserAccsess)){
             $access = false; 
          }
        }

        if($access == false){
            $this->authUser();
            $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
            $this->view->setInnerTemplate('_403', CNTRL_DIR_TPL);
            $this->getView()->display(); 
            exit();   
        }   
    }   
     
}
    


}
