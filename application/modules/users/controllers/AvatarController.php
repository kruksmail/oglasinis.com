<?php
class Users_AvatarController extends Users_Library_Controller_Action_Abstract
{
	public function init()
	{
		$this->view->skin = "mySkin";
		$this->view->headTitle()->setSeparator(' - ');
	}
	public function indexAction()
    {
    	if(Zend_Auth::getInstance()->hasIdentity())
		{
			$id = Zend_Auth::getInstance()->getIdentity()->id;
	    	$mdlUser = new Users_Model_User();
	    	
	    	$mdlPrivacy = new Users_Model_UserPrivacy();
	    	$custom = NULL;
	    	
	    	$mdlConfirmation = new Users_Model_EmailConfirmation();
			$user_id = Zend_Auth::getInstance()->getIdentity()->id;
	    	$confirmed = $mdlConfirmation->getUser($user_id)->confirmed;
	    	
	    	if($mdlPrivacy->getUser($id) != NULL)
	    	{
	    		$custom = $mdlPrivacy->getUser($id)->custom;
	    	}
	    	$customAsArray = explode(',',$custom);
			
			$customArray = NULL;
	    	if($custom != NULL)
	    	{
		    	$customArray = array();
		    	foreach($customAsArray as $field)
		    	{
		    		$temp = explode('/',$field);
		    		$key = $temp[0];
		    		$label = $temp[1];
		    		if(($key == 'email') && ($confirmed == NULL))
		    		{
		    			continue;
		    		}
		    		$customArray += array($key => $label);
		    	}
	    	}
	    	
	    	$this->view->customFields = $customArray;
	    	$this->view->user = $mdlUser->getUser($id);
		}
    }
    
    public function privacyAction()
    {
    	$this->view->headTitle('Vlasotince Online - Privatnost korisnika');
    	$privacyForm = new Users_Form_UserPrivacy();
    	$mdlPrivacy = new Users_Model_UserPrivacy();
    	$id = Zend_Auth::getInstance()->getIdentity()->id;
    	if($this->_request->isPost() && $privacyForm->isValid($_POST))
    	{
    		$customField = NULL;
    		$labels = NULL;
    		$multiArray = $privacyForm->getElement('privacy')->getMultiOptions();
    		$privacy = $privacyForm->getValue('privacy');
    		
    		$mdlConfirmation = new Users_Model_EmailConfirmation();
			$user_id = Zend_Auth::getInstance()->getIdentity()->id;
	    	$confirmed = $mdlConfirmation->getUser($user_id)->confirmed;
	    	
    		if(empty($privacy) || $privacy === NULL)
    		{
    			$customField = NULL;
    		}
    		else
    		{
	    		foreach($privacy as $value)
	    		{
	    			if($confirmed == NULL && $value == 'email')
	    			{
	    				continue;
	    			}
	    			$customField .= $value .'/'. $multiArray[$value] .",";
	    		}
	    		$customField = substr($customField,0,strlen($customField)-1);
    		}
    		$user = $mdlPrivacy->getUser($id);
    		
    		if($user != false)
    		{
	    		$result = $mdlPrivacy->updateUser($id,$customField);
    		}
    		else
    		{
    			$result = $mdlPrivacy->createUser($id,$customField);
    		}
    		
    		if($result === false)
    		{
    			$this->view->error = "Operacija nije uspela!";
    		}
    		else
    		{
    			//$this->view->error =  $privacyForm->getValue('privacy') + $privacyForm->getElement('privacy')->getMultiOptions();
    			return $this->_redirect('/users/useraccount');
    		}
    	}
    	$this->view->form = $privacyForm;
    }
}