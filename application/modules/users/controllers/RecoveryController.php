<?php
class Users_RecoveryController extends Users_Library_Controller_Action_Abstract
{
	public function init()
	{
		$this->_helper->layout->setLayout('login');
		//$this->view->headTitle('Vlasotince Online');
		//	setting a separator string for segments:
		//$this->view->headTitle()->setSeparator(' - ');
		$this->view->setEncoding('UTF-8');

		$this->view->doctype('XHTML1_STRICT');
		
		// set the content type and language
		$this->view->headMeta()
			       ->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
		
		$this->view->headMeta()
				   ->appendHttpEquiv('Content-Language', 'en-US');

		$this->view->skin = 'mySkin';
		// setting the site in the title
		$this->view->headTitle('Vlasotince Online - Oporavak naloga');
		//	setting a separator string for segments:
		$this->view->headTitle()->setSeparator(' - ');
	}
	
	public function indexAction()
	{
		$recoveryForm = new Users_Form_UserRecovery();
		if($this->_request->isPost() && $recoveryForm->isValid($_POST))
		{
			$mdlUser = new Users_Model_User();
			$user = $mdlUser->getUserByEmail($recoveryForm->getValue('email'));
			if($user != NULL)
			{
				$mdlRecovery = new Users_Model_UserRecovery();
				$password = mt_rand();
				$tmpPass = md5($password);
				$mdlRecovery->updateUser($user->id, $user->username, $tmpPass, $user->first_name, $user->last_name, $user->email, $user->sex, $user->role);
				/*
				$htmlMessage = $this->view->partial('templates/recovery.phtml', 
	     		array('baseUrl'=>$this->view->baseUrl(),'username'=> $mdlUser->username, 'password' => $password));
	     		$mail = new Zend_Mail();
				$mail->setSubject('Dobrodošli na Vlasotince Online');
				$mail->setFrom('webmaster@vlasotinceonline.com','Vlasotince Online');
				$mail->addTo($recoveryForm->getValue('email'), $mdlUser-first_name .' '. $mdlUser->last_name);
			    $mail->setBodyHtml($htmlMessage);
				//$mail->setBodyText($message);
				$mail->send();		
				*/
				//write mail to file
				
				$log = new Zend_Log(
                    new Zend_Log_Writer_Stream(
                       APP_PUBLIC .'/temp/mail.log'
                  )
                );
                $log->debug("Dobrodošli na Vlasotince Online \nFrom:webmaster@vlasotinceonline.com Vlasotince Online \n"
				." To: ". $recoveryForm->getValue('email')." ". $user->first_name ." ". $user->last_name 
				."\n Korisnicko ime: ".$user->username ."\n Lozinka: ".$password);

				$this->view->email = $recoveryForm->getValue('email');
				$this->view->sent = TRUE;
			}
			else
			{
				$this->view->error = "Došlo je do greške!";
			}
		}
		$recoveryForm->setAction($this->view->baseUrl() . '/users/recovery');
		$this->view->form = $recoveryForm;
	}
}