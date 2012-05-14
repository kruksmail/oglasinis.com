<?php
class Users_UseraccountController extends Users_Library_Controller_Action_Abstract
{
	
	public function indexAction() 
	{	
		$this->view->headTitle('Moj nalog');
		$auth = Zend_Auth::getInstance()->getIdentity();
		$mdlUser = new Users_Model_User();
		$currentUser = $mdlUser->getUser($auth->id);
		
		$mdlConfirmation = new Users_Model_EmailConfirmation();
		$user_id = Zend_Auth::getInstance()->getIdentity()->id;
	    $confirmed = $mdlConfirmation->getUser($user_id)->confirmed;
		
	    
	    $mdlRecovery = new Users_Model_UserRecovery();
		$this->view->recovery = $mdlRecovery->getUser($user_id);
		
       	if($currentUser != NULL)
        {
        	$this->view->user = $currentUser;
       	}
       	else
     	{
        	$this->view->user = "null";
      	}
      	$this->view->emailConfirmed = $confirmed;
	}
}