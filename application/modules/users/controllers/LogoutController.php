<?php
class Users_LogoutController extends Users_Library_Controller_Action_Abstract
{
	public function indexAction() 
	{
		$auth = Zend_Auth::getInstance();  
        $auth->clearIdentity();
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL)
        {
        	return $this->_redirect($_SERVER['HTTP_REFERER']);
        }
       	return $this->_redirect('/');
	}
}