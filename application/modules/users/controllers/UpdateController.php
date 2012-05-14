<?php

class Users_UpdateController extends Users_Library_Controller_Action_Abstract
{
	public function indexAction() 
	{	
		$this->view->adminExpand = TRUE;
		$userForm = new Users_Form_User();
        $userForm->setAction($this->view->baseUrl() . '/users/update');
        $userForm->removeElement('password');
        $userModel = new Users_Model_User();
        if($this->_request->isPost())
        {
        	if($userForm->isValid($_POST))
        	{
        		$userModel->updateUser(
        		$userForm->getValue('id'),
        		$userForm->getValue('username'),
        		$userForm->getValue('first_name'),
        		$userForm->getValue('last_name'),
        		$userForm->getValue('role')
        		);
        	
        		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL)
        		{
        			return $this->_redirect($_SERVER['HTTP_REFERER']);
        		}
        		
        		return $this->_redirect('/users/list');
        	}
        }
        else
        {
        	$id = $this->_request->getParam('id');
        	$currentUser = $userModel->find($id)->current();
        	$userForm->populate($currentUser->toArray());
        }
        $this->view->form = $userForm;
	}
		
	
}


