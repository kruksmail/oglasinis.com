<?php
class Users_IndexController extends Users_Library_Controller_Action_Abstract
{
    public function indexAction()
    {
    	$this->view->adminExpand = $this->_request->getParam('expand');
    	$auth = Zend_Auth::getInstance();      
        if($auth->hasIdentity())
        {
        	$this->view->identity = $auth->getIdentity();
        }
        else
        {
        	$userForm = new Users_Form_UserLogin();
	        $userForm->setAction($this->view->baseUrl() . '/users/login');
	        $userForm->removeElement('captcha');
	        $this->view->form = $userForm;	 
        }
    }

}
