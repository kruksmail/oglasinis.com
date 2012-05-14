<?php
class Users_RegistrationController extends Users_Library_Controller_Action_Abstract
{
	public function indexAction()
	{
		$this->view->headTitle('Registracija korisnika');
		if(Zend_Auth::getInstance()->hasIdentity())
		{
			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL  && (stripos($_SERVER['HTTP_REFERER'],'/users/login') === false))
		    {
		        return $this->_redirect($_SERVER['HTTP_REFERER']);
		    }
		    else
		    {
		    	return $this->_redirect('/');
		    }
		}
		$regForm = new Users_Form_UserRegistration();
		if($this->_request->isPost() )
        {
        	if($regForm->isValid($_POST))
        	{
		    	$mdlUser = new Users_Model_User();
		       	$retVal = $mdlUser->registerUser($regForm->getValue('username'),$regForm->getValue('password'),
		        $regForm->getValue('first_name'),$regForm->getValue('last_name'),
		        $regForm->getValue('email'),$regForm->getValue('sex'));
		        if($retVal != NULL)
		        {
		        	$data = $regForm->getValues();
			       	$db = Zend_Db_Table::getDefaultAdapter();
			       	$authAdapter = new Zend_Auth_Adapter_DbTable($db,'users','username','password');
			       	$authAdapter->setIdentity($data['username']);
			       	$authAdapter->setCredential(md5($data['password']));
			       	$result = $authAdapter->authenticate();
			       	if($result->isValid())
			       	{
			       		$auth = Zend_Auth::getInstance();
			       		$storage = $auth->getStorage();
			       		$storage->write($authAdapter->getResultRowObject(array('id','username',
			       		'first_name','last_name','role','sex')));
			       		//$mdlUser = new Users_Model_User();
	     				$mdlUser->saveSid($auth->getIdentity()->id,Zend_Session::getId());
	     				$user = $mdlUser->getUserByEmail($regForm->getValue('email'));
	     				
	     				$mdlConfirmation = new Users_Model_EmailConfirmation();
						$user_id = Zend_Auth::getInstance()->getIdentity()->id;
						$code = md5($user_id .'_'. $regForm->getValue('email'));
						$mdlConfirmation->updateUser($user_id, $code);
	     				$link = $this->view->baseUrl() .'/users/confirm/emailconfirmation/code/'. $code;
						/*
						$link = $code;
	     				$htmlMessage = $this->view->partial('templates/email_confirmation.phtml', 
	     				array('baseUrl'=>$this->view->baseUrl(),'link'=>$link, 'username'=> $regForm->getValue('username')));
	     				$mail = new Zend_Mail();
						$mail->setSubject('Dobrodošli na Vlasotince Online');
						$mail->setFrom('webmaster@vlasotinceonline.com','Vlasotince Online');
						$mail->addTo($regForm->getValue('email'), $regForm->getValue('first_name') .' '. $regForm->getValue('last_name'));
			        	$mail->setBodyHtml($htmlMessage);
						//$mail->setBodyText($message);
						$mail->send();
	     				*/
						$log = new Zend_Log(
                    	new Zend_Log_Writer_Stream(
                      	 APP_PUBLIC .'/temp/mail1.log'
                  			)
                		);
               		 	$log->debug("Dobrodošli na Vlasotince Online \nFrom:webmaster@vlasotinceonline.com Vlasotince Online \n"
						." To: ". $regForm->getValue('email')." ". $user->first_name ." ". $user->last_name 
						."\n Korisnicko ime: ".$regForm->getValue('username') ."\n Kliknite na sledeci link da biste aktivirali nalog\n".$link);
						
			       		return $this->_redirect('/users/useraccount');
			       	}
			       	else
			       	{
			       		$this->view->loginMessage = "Sorry, your username or password was incorrect";
			       	}
		        	
		        }
		        	
	        	if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL)
	        	{
	        		$this->_redirect($_SERVER['HTTP_REFERER']);
	        	}
	        	else
	        	{
	        		$this->_redirect('/');
	        	}
        	}
        }
       
        $regForm->setAction($this->view->baseUrl() . '/users/registration/');
		$this->view->form = $regForm;
	}
}