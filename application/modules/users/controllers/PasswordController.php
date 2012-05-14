<?php
class Users_PasswordController extends Users_Library_Controller_Action_Abstract
{
	public function indexAction() 
	{
		$this->view->adminExpand = TRUE;
		$userForm = new Users_Form_User();
        $userForm->setAction($this->view->baseUrl() . '/users/password');
        $userForm->removeElement('first_name');
        $userForm->removeElement('last_name');
        $userForm->removeElement('username');
        $userForm->removeElement('role');
        $userModel = new Users_Model_User();
        if($this->_request->isPost())
        {
        	if($userForm->isValid($_POST))
        	{
        		$userModel->updatePassword(
        		$userForm->getValue('id'),
        		$userForm->getValue('password')
        		);
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