<?php
class Users_CreateController extends Users_Library_Controller_Action_Abstract
{
	public function indexAction()
    {
    	$regForm = new Users_Form_UserRegistrationAdmins();
    	$this->view->adminExpand = TRUE;
		if($this->_request->isPost() )
        {
        	if($regForm->isValid($_POST))
        	{
		    	$mdlUser = new Users_Model_User();
		       	$retVal = $mdlUser->registerUser($regForm->getValue('username'),$regForm->getValue('password'),
		        $regForm->getValue('first_name'),$regForm->getValue('last_name'),
		        $regForm->getValue('email'),$regForm->getValue('sex'));
		        if($retVal !== NULL)
		        {	
		        	$mdlConfirmation = new Users_Model_EmailConfirmation();
					$user_id = $retVal->id;
					$code = md5($user_id .'_'. $regForm->getValue('email'));
					$mdlConfirmation->updateUser($user_id, $code);
					
					if($regForm->getValue('confirm') == 'no')
					{
						$link = $code;
						$htmlMessage = $this->view->partial('templates/email_confirmation.phtml', 
			     		array('baseUrl'=>$this->view->baseUrl(),'link'=>$link, 'username'=> Zend_Auth::getInstance()->getIdentity()->username));
						
			     		$mail = new Zend_Mail();
						$mail->setSubject('Dobrodošli na Vlasotince Online');
						$mail->setFrom('webmaster@vlasotinceonline.com','Vlasotince Online');
						$mail->addTo($regForm->getValue('email'), Zend_Auth::getInstance()->getIdentity()->first_name .' '. Zend_Auth::getInstance()->getIdentity()->last_name);
					    $mail->setBodyHtml($htmlMessage);
						//$mail->setBodyText($message);
						$mail->send();
					}
					else
					{
						$mdlConfirmation->confirmUser($user_id);
					}
					
		        	if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL && (stripos($_SERVER['HTTP_REFERER'],'/users/create') === false))
		        	{
		        		$this->_redirect($_SERVER['HTTP_REFERER']);
		        	}
		        	else
		        	{
		        		$this->_redirect('/users/list');
		        	}
		        }
		        else
		        {
		        	$this->view->error = "Operacija nije uspela";
		        }
        	}
        }
        $regForm->setAction($this->view->baseUrl() . '/users/create/');
		$this->view->form = $regForm;
    }
}