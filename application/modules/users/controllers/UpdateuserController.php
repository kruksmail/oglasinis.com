<?php
class Users_UpdateuserController extends Users_Library_Controller_Action_Abstract
{
	
	public function indexAction() 
	{	
		
	}
	
	public function updatepersonalinfoAction() 
	{	
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Promena ličnih podataka');
		$userForm = new Users_Form_UserPersonalData();	
		$mdlUser = new Users_Model_User();
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/updatepersonalinfo');
		
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$bdate = $userForm->getValue('birthdate');
        	
        	if($bdate == "" || empty($bdate) || $bdate == " ")
        	{
        		$bdate = NULL;
        	}
        	else
        	{
        		$bdate = new Zend_Date($bdate);
        	}
        	$result = $mdlUser->updatePersonalInfo(
        		$id,
        		$userForm->getValue('first_name'),
        		$userForm->getValue('last_name'),
        		$userForm->getValue('sex'),
        		$bdate->toString('dd-MM-yyyy'),
        		$userForm->getValue('employee')
        		);
        	if($result == NULL)
        	{
        		$this->view->message = "Operacija nije uspela!";
        	}
        	else
        	{
        		return $this->_redirect('/users/useraccount');
        	}
        }
        else if(!$this->_request->isPost())
        {
        	$currentUser = $mdlUser->find($id)->current();
			$userForm->populate($currentUser->toArray());
        }
	
		$this->view->form = $userForm;
	}
	
	public function updatecontactinfoAction() 
	{	
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Promena kontakt informacija');
		$userForm = new Users_Form_UserContactInfo();	
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/updatecontactinfo');
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$mdlUser = new Users_Model_User();
		
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$address = $userForm->getValue('address');
        	if($address == "" || $address == " " || empty($address))
        	{
        		$address = NULL;
        	}
       		$phone_mobile = $userForm->getValue('phone_mobile');
        	if($phone_mobile == "" || $phone_mobile == " " || empty($phone_mobile))
        	{
        		$phone_mobile = NULL;
        	}
        	$phone_home = $userForm->getValue('phone_home');
        	if($phone_home == "" || $phone_home == " " || empty($phone_home))
        	{
        		$phone_home = NULL;
        	}
        	$fax = $userForm->getValue('fax');
        	if($fax == "" || $fax == " " || empty($fax))
        	{
        		$fax = NULL;
        	}
        	$city = $userForm->getValue('city');
        	if($city == "" || $city == " " || empty($city))
        	{
        		$city = NULL;
        	}
        	$site = $userForm->getValue('site');
        	if($site == "" || $site == " " || empty($site))
        	{
        		$site = NULL;
        	}
        	$result = $mdlUser->updateContactInfo(
        		$id,
        		$address,
        		$phone_mobile,
        		$phone_home,
        		$fax,
        		$city,
        		$site
        		);
        	if($result == NULL)
        	{
        		$this->view->message = "Operacija nije uspela!";
        	}
        	else
        	{
        		return $this->_redirect('/users/useraccount');
        	}
        }
        else if(!$this->_request->isPost())
        {
        	$currentUser = $mdlUser->find($id)->current();
			$userForm->populate($currentUser->toArray());
        }
		$this->view->form = $userForm;
	}
	
	public function updateadditionalinfoAction() 
	{	
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Promena dodatnih podataka');
		$userForm = new Users_Form_UserAdditionalInfo();	
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/updateadditionalinfo');
		$mdlUser = new Users_Model_User();
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$description = $userForm->getValue('description');
        	if($userForm->getValue('description') == "" || $userForm->getValue('description') == " ")
        	{
        		$description = NULL;
        	}
        	$result = $mdlUser->updateAdditionalInfo(
        		$id,
        		$description
        		);
        	if($result == NULL)
        	{
        		$this->view->message = "Operacija nije uspela!";
        	}
        	else
        	{
        		return $this->_redirect('/users/useraccount');
        	}
        }
        else if(!$this->_request->isPost())
        {
        	$currentUser = $mdlUser->find($id)->current();
			$userForm->populate($currentUser->toArray());
        }
		
		$this->view->form = $userForm;
	}
	
	public function updatepersonalimageAction() 
	{	
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Promena slike');
		$userForm = new Users_Form_UserImage();
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/updatepersonalimage');
		$mdlUser = new Users_Model_User();
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$currentUser = $mdlUser->getUser($id);
       	
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	if($userForm->getValue('submit') == 'Prosledi')
        	{
	        	$image_url = $userForm->getValue('image');
	        	if($image_url != "" && $image_url != " " && !empty($image_url))
	        	{
		        	$result = $mdlUser->updatePersonalImage(
		        		$id,
		        		$image_url
		        		);
		        	if($result === NULL)
		        	{
		        		$this->view->message = "Operacija nije uspela!";
		        	}
	        	}
        	}
        	else if($userForm->getValue('submit1') == 'Obriši sliku')
        	{
        		$url = $currentUser->image_url;
        		$result = $mdlUser->updatePersonalImage(
		        		$id,
		        		NULL
		        		);
		        if($result === NULL)
		        {
		        	$this->view->message = "Operacija nije uspela!";
		        }
		        else if($url !== NULL)
		        {
		        	unlink(APP_PUBLIC .'/images/userupload/'.$url);
		        }
        	}
        	else
        	{
        		return $this->_redirect('/users/useraccount');
        	}
        }
        $currentUser = $mdlUser->getUser($id);
		if($currentUser != NULL)
        {
        	$this->view->user = $currentUser;
       	}
       	else
     	{
        	$this->view->user = "null";
      	}
		
		$this->view->form = $userForm;
	}
	
	public function updatepasswordAction() 
	{	
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Promena lozinke');
		$userForm = new Users_Form_UserPass();	
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/updatepassword');
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$mdlUser = new Users_Model_User();
		$this->view->message = "1";
		
		$mdlRecovery = new Users_Model_UserRecovery();
		$this->view->recovery = $mdlRecovery->getUser($id);
		if($this->view->recovery)
		{
			$userForm->removeElement('password');
		}
		
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$result = $mdlUser->updatePassword(
        		$id,
        		$userForm->getValue('newpassword')
        		);
        	if($result == NULL)
        	{
        		$this->view->message = "Operacija nije uspela!";
        	}
        	else
        	{
        		$this->view->message = NULL;
        		$mdlTmp = new Users_Model_UserRecovery();
	     		$mdlTmp->deleteUser($id);
	     			
        		//return $this->_redirect('/users/useraccount');
        	}
        }
		$this->view->form = $userForm;
	}
	
	public function updateusernameAction() 
	{	
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Promena korisničkog imena');
		$mdlUser = new Users_Model_User();
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$userForm = new Users_Form_UserUsername();	
		
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$result = $mdlUser->updateUsername(
        		$id,
        		$userForm->getValue('username')
        		);
        	if($result == NULL)
        	{
        		$this->view->message = "Operacija nije uspela!";
        	}
        	else
        	{
        		return $this->_redirect('/users/useraccount');
        	}
        }
        else if(!$this->_request->isPost())
        {
        	$currentUser = $mdlUser->find($id)->current();
			$userForm->populate($currentUser->toArray());
        }
		
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/updateusername');
		
		$this->view->form = $userForm;
	}
	
	public function updateemailAction()
	{
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Promena email adrese');
		
		$mdlUser = new Users_Model_User();
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$userForm = new Users_Form_UserEmail();	
		
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$result = $mdlUser->updateEmail(
        		$id,
        		$userForm->getValue('email')
        		);
        	if($result == NULL)
        	{
        		$this->view->message = "Operacija nije uspela!";
        	}
        	else
        	{
        		///updateUser($user_id, $code);
        		$mdlConfirmation = new Users_Model_EmailConfirmation();
				$user_id = Zend_Auth::getInstance()->getIdentity()->id;
				$code = md5($user_id .'_'. $userForm->getValue('email'));
				$mdlConfirmation->updateUser($user_id, $code);
				
				$link = $code;
				$htmlMessage = $this->view->partial('templates/email_confirmation.phtml', 
	     		array('baseUrl'=>$this->view->baseUrl(),'link'=>$link, 'username'=> Zend_Auth::getInstance()->getIdentity()->username));
				
	     		$mail = new Zend_Mail();
				$mail->setSubject('Dobrodošli na Vlasotince Online');
				$mail->setFrom('webmaster@vlasotinceonline.com','Vlasotince Online');
				$mail->addTo($userForm->getValue('email'), Zend_Auth::getInstance()->getIdentity()->first_name .' '. Zend_Auth::getInstance()->getIdentity()->last_name);
			    $mail->setBodyHtml($htmlMessage);
				//$mail->setBodyText($message);
				$mail->send();
						
        		return $this->_redirect('/users/useraccount');
        	}
        }
        else if(!$this->_request->isPost())
        {
        	$currentUser = $mdlUser->find($id)->current();
			$userForm->populate($currentUser->toArray());
        }
		
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/updateemail');
		
		$this->view->form = $userForm;
	}
	
	public function deleteaccountAction()
	{
		$this->view->headTitle('Moj nalog');
		$this->view->headTitle('Brisanje naloga?');
		
		$mdlUser = new Users_Model_User();
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$userForm = new Users_Form_UserDelete();	
		$this->view->message = "1";
		if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	if($userForm->getValue('submit1') == "Da")
        	{
	        	$result = $mdlUser->deleteUser(
	        		$id
	        		);
	        	if($result == NULL)
	        	{
	        		$this->view->message = "Operacija nije uspela!";
	        	}
	        	else
	        	{
	        		$this->view->message = NULL;
	        	}
        	}
        	else
        	{
        		return $this->_redirect('/users/useraccount');
        	}
        }
        else
        {
        	if($userForm->getValue('submit2') == "Ne")
        	{
        		return $this->_redirect('/users/useraccount');
        	}
        }
		
		$userForm->setAction($this->view->baseUrl() . '/users/updateuser/deleteaccount');
		
		$this->view->form = $userForm;
	}
}