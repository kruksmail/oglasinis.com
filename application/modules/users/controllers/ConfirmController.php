<?php

class Users_ConfirmController extends Users_Library_Controller_Action_Abstract
{
	public function emailconfirmationAction()
	{
		$code = $this->_request->getParam('code');
		$mdlConfirmation = new Users_Model_EmailConfirmation();
		$user_id = Zend_Auth::getInstance()->getIdentity()->id;
		$confirmRow = $mdlConfirmation->getUser($user_id);
		if($confirmRow != NULL)
		{
			if(($code == $confirmRow->code) && ($confirmRow->confirmed == NULL))
			{
				$result = $mdlConfirmation->confirmUser($user_id);
				if($result)
				{
					$this->view->error = "Uspešno ste potvrdili email adresu! <br />";
					// <a href='". $this->view->baseUrl(). "/users/useraccount'>Moj nalog</a>";
				}
				else
				{
					$this->view->error = "Strana nije pronađena2";
				}
			}
			else
			{
				$this->view->error = "Strana nije pronađena1";
			}
		}
		else
		{
			$this->view->error = "Strana nije pronađena3";
		}
	}
}