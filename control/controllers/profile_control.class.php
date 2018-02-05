<?php

class Profile_Control extends ControlController {

    function __construct() {
        parent::__construct();
        $this->authUser();
    }

    function action_index() {
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_profile', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_PROFILE).' | Onero Technology');
    }

    function action_edit() {
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_profile_edit', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_EDIT_PROFILE).' | Onero Technology');

        if ($userAvt = opendir(CNTRL_IMG_AVATAR_ALL_PATH)) {
            $userAvtarVar = array();
            while (false !== ($userAvtar = readdir($userAvt))) {
                if ($userAvtar != "." && $userAvtar != "..") {
                    $userAvtarVar[] = $userAvtar;
                }
            }
            $this->view->setTemplateVar('userAvtarVar', $userAvtarVar);
            closedir($userAvt);
        }

        if ($this->request->saveeditprofile) {
            $loginMd5 = md5(md5($this->request->user_login_no_hash));
            $passMd5 = md5(md5($this->request->user_pass_no_hash));

            $editProfileData = array(
                'user_avatar' => $this->request->user_avatar,
                'user_name' => $this->request->user_name,
                'user_surname' => $this->request->user_surname,
                'user_email' => $this->request->user_email,
                'user_tel' => $this->request->user_tel,
                'user_birth' => date('Y-m-d', strtotime($this->request->user_birth)),
                'user_country' => $this->request->user_country,
                'user_city' => $this->request->user_city,
                'user_login_no_hash' => $this->request->user_login_no_hash,
                'user_pass_no_hash' => $this->request->user_pass_no_hash,
                'user_about' => $this->request->user_about,
                'user_login' => $loginMd5,
                'user_pass' => $passMd5
            );

            $this->model->updateArr('fmw_control_user', $editProfileData, 'user_hash = :user_hash', array('user_hash' => $_SESSION['userControlHash']));
            $this->redirect('/control/profile/');
        }
    }

    function action_user() {
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_profile_user', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_USRE_PANEL).' | Onero Technology');

        if ($this->request->deleteid) {
            $this->model->deleltWhere('fmw_control_user', 'id = ?', array($this->request->deleteid));
        }

        $userProfile = $this->model->allSelect('fmw_control_user');
        $this->view->setTemplateVar('userProfile', $userProfile);
    }

    function action_useredit() {
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_profile_action', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_EDIT_USER_PANEL).' | Onero Technology');
        $this->view->setTemplateVar('titleBlock', $this->view->getLang(CTRL_EDIT_USER_PANEL));
        $this->view->setTemplateVar('actionButton', 'saveeditprofileuser');
        
        if($this->request->saveeditprofileuser){
            
            if($this->request->user_access == ''){
              $userAccess = 'null';  
            }else{
              $userAccess =  implode(',', $this->request->user_access);  
            }
            
            $loginMd5 = md5(md5($this->request->user_login_no_hash));
            $passMd5 = md5(md5($this->request->user_pass_no_hash));

            $newProfileData = array(
                'user_avatar' => $this->request->user_avatar,
                'type_user' => $this->request->type_user,
                'user_name' => $this->request->user_name,
                'user_surname' => $this->request->user_surname,
                'user_email' => $this->request->user_email,
                'user_tel' => $this->request->user_tel,
                'user_birth' => date('Y-m-d', strtotime($this->request->user_birth)),
                'user_country' => $this->request->user_country,
                'user_city' => $this->request->user_city,
                'user_login_no_hash' => $this->request->user_login_no_hash,
                'user_pass_no_hash' => $this->request->user_pass_no_hash,
                'user_about' => $this->request->user_about,
                'user_login' => $loginMd5,
                'user_pass' => $passMd5,
                'user_access' => $userAccess
            );

            $res = $this->model->updateArr('fmw_control_user', $newProfileData, 'id = :id', array('id'=> $this->request->id));
            $this->menuControl();
            
        }
        
        $userRole = $this->model->allSelect('fmw_user_role');
        $this->view->setTemplateVar('userRole', $userRole);

        if ($userAvt = opendir(CNTRL_IMG_AVATAR_ALL_PATH)) {
            $userAvtarVar = array();
            while (false !== ($userAvtar = readdir($userAvt))) {
                if ($userAvtar != "." && $userAvtar != "..") {
                    $userAvtarVar[] = $userAvtar;
                }
            }
            $this->view->setTemplateVar('userAvtarVar', $userAvtarVar);
            closedir($userAvt);
        }
        
        $accessTableSql = $this->model->allSelectFieldWhere('id, t_title', 'fmw_control_table', 't_active = ? ', array('1'));
        $this->view->setTemplateVar('accessTableSql', $accessTableSql);

        $userProfile = $this->model->rowSelectWhere('fmw_control_user', 'id = ?', array($this->request->id));
        $this->view->setTemplateVar('userProfile', $userProfile);
    }

    function action_add() {
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_profile_action', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_ADD_USER).' | Onero Technology');
        $this->view->setTemplateVar('titleBlock', $this->view->getLang(CTRL_ADD_USER));
        $this->view->setTemplateVar('actionButton', 'addprofileuser');

        if ($userAvt = opendir(CNTRL_IMG_AVATAR_ALL_PATH)) {
            $userAvtarVar = array();
            while (false !== ($userAvtar = readdir($userAvt))) {
                if ($userAvtar != "." && $userAvtar != "..") {
                    $userAvtarVar[] = $userAvtar;
                }
            }
            $this->view->setTemplateVar('userAvtarVar', $userAvtarVar);
            closedir($userAvt);
        }

        if ($this->request->addprofileuser) {
            
            if($this->request->user_access == ''){
              $userAccess = 'null';  
            }else{
              $userAccess =  implode(',', $this->request->user_access);  
            }
            
            $loginMd5 = md5(md5($this->request->user_login_no_hash));
            $passMd5 = md5(md5($this->request->user_pass_no_hash));

            $newProfileData = array(
                'user_avatar' => $this->request->user_avatar,
                'type_user' => $this->request->type_user,
                'user_name' => $this->request->user_name,
                'user_surname' => $this->request->user_surname,
                'user_email' => $this->request->user_email,
                'user_tel' => $this->request->user_tel,
                'user_birth' => date('Y-m-d', strtotime($this->request->user_birth)),
                'user_country' => $this->request->user_country,
                'user_city' => $this->request->user_city,
                'user_login_no_hash' => $this->request->user_login_no_hash,
                'user_pass_no_hash' => $this->request->user_pass_no_hash,
                'user_about' => $this->request->user_about,
                'user_login' => $loginMd5,
                'user_pass' => $passMd5,
                'user_access' => $userAccess
            );

            $res = $this->model->insert('fmw_control_user', $newProfileData);
            if ($res > 0) {
                $this->redirect('/control/profile/user/');
            }
        }
    }

}
