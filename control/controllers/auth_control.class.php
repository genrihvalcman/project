<?php

class Auth_Control extends ControlController {

    function action_index() {
        
        $this->view->setMainTemplate('_inner', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_auth', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_AUTH).' | Advokat');

       if (isset($_SESSION['userControlHash']) !== '') {
            $checkUser = $this->model->selectCheckUser(array($_SESSION['userControlHash']));
           if (!empty($checkUser)) {
               $this->redirect('/control/');
            }
        }

        try {
            if ($this->request->user_auth) {
                $login = md5(md5($this->request->login));
                $pass = md5(md5($this->request->password));
                $userQuery = $this->model->selectUser(array($login));

                if ($userQuery['user_pass'] === $pass) {
                    $userHash = $this->request->generateHash(25);
                    $heshQuery = $this->model->updateHashUser(array($userHash, $login));
                    if ($heshQuery > 0) {
                        $_SESSION['userControlHash'] = $userHash;
                        $this->redirect('/control/');
                    } else {
                        throw new Exception($this->view->getLang(ERROR_UNKNOWN));
                    }
                } else {
                    throw new Exception($this->view->getLang(ERROR_AUTH_USER));
                }
            }
        } catch (Exception $e) {
            $this->view->setTemplateVar('error', $e->getMessage());
        }
    }
    
    function action_logout() {
     unset($_SESSION['userControlHash']);
     $this->redirect('/control/');
    }

}
