<?php
class Users_LoginController extends Users_Library_Controller_Action_Abstract
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
		$this->view->headTitle('Vlasotince Online - Login');
		//	setting a separator string for segments:
		$this->view->headTitle()->setSeparator(' - ');
	}
	
	public function indexAction() 
	{	
		if(Zend_Auth::getInstance()->hasIdentity())
    	{
    		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL && (stripos($_SERVER['HTTP_REFERER'],'/users/login') === false) && (stripos($_SERVER['HTTP_REFERER'],'/users/registration') === false))
	        {
	        	return $this->_redirect($_SERVER['HTTP_REFERER']);
	        }
	       	return $this->_redirect('/');
	    }
        $userForm = new Users_Form_UserLogin();
        $userForm->setAction($this->view->baseUrl() . '/users/login/notmatch');
        $userForm->removeElement('captcha');
        $this->view->loginMessage = NULL;

        if($this->_request->isPost())
        {
        	if($userForm->isValid($_POST))
        	{
	        	$data = $userForm->getValues();
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
	        		//save sid
	     			$mdlUser = new Users_Model_User();
	     			$mdlUser->saveSid($auth->getIdentity()->id,Zend_Session::getId());
	        		
	     			$mdlTmp = new Users_Model_UserRecovery();
	     			$mdlTmp->deleteUser($auth->getIdentity()->id);
	     			
	     			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL && (stripos($_SERVER['HTTP_REFERER'],'/users/login') === false) && (stripos($_SERVER['HTTP_REFERER'],'/users/registration') === false))
			        {
			        	return $this->_redirect($_SERVER['HTTP_REFERER']);
			        }
			       	return $this->_redirect('/users/useraccount');
	        	}
	        	else
	        	{
	        		$authAdapter = new Zend_Auth_Adapter_DbTable($db,'temporarypassword','username','password');
	        		$authAdapter->setIdentity($data['username']);
	        		$authAdapter->setCredential(md5($data['password']));
	        		$result = $authAdapter->authenticate();
	        		if($result->isValid())
	        		{
	        			$auth = Zend_Auth::getInstance();
	        			$storage = $auth->getStorage();
	        			$storage->write($authAdapter->getResultRowObject(array('id','username',
	        			'first_name','last_name','role','sex')));
	        			//save sid
	     				$mdlUser = new Users_Model_User();
	     				$mdlUser->saveSid($auth->getIdentity()->id,Zend_Session::getId());
			       		return $this->_redirect('/users/updateuser/updatepassword');
	        		}
	        		else
	        		{
	        			$this->view->loginMessage = "INVALID PASSWORD";
	        		}
	        	}
        	}
        	else
        	{
        		$this->view->loginMessage = "INVALID POST";
        	}
        }
        
        $userForm3 = new Users_Form_UserLogin();
        $userForm3->setAction($this->view->baseUrl() . '/users/login');
        $userForm3->removeElement('captcha');
        
        $userForm2 = new Users_Form_UserLogin();
        
	        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL  && (stripos($_SERVER['HTTP_REFERER'],'/users/login') === false) && (stripos($_SERVER['HTTP_REFERER'],'/users/registration') === false))
		    {
	        	$userForm->getElement('return')->setValue($_SERVER['HTTP_REFERER']);
	        	$userForm3->getElement('return')->setValue($_SERVER['HTTP_REFERER']);
	        	$userForm2->getElement('return')->setValue($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$userForm->getElement('return')->setValue('/users/useraccount');
				$userForm3->getElement('return')->setValue('/users/useraccount');
	        	$userForm2->getElement('return')->setValue('/users/useraccount');
			}
        
		$this->view->third_form = $userForm3;
		$userForm2->setAction($this->view->baseUrl() . '/users/login/notmatch');
        $this->view->form_second = $userForm2;
        
		$captchaImage = new Zend_Captcha_Image();
		$captchaImage->setFont(APP_PUBLIC . '/font/ariali.ttf')
		->setMessages(array(
			Zend_Captcha_Image::BAD_CAPTCHA => 'Pogrešna vrednost za captcha kod!',
			Zend_Captcha_Image::MISSING_VALUE => 'Morate uneti kod sa slike!',
			Zend_Captcha_Image::MISSING_ID => 'Morate uneti kod sa slike!'
		)) 
		->setDotNoiseLevel(0)
		->setLineNoiseLevel(3)
		->setFontSize(18)
		->setWidth(100)
		->setWordLen(6)
		->setHeight(50)
		->setTimeout(180)
		->setExpiration(600)
		->setImgDir(APP_PUBLIC . '/images/captcha');
		$captchaImage->setImgUrl(Zend_Controller_Front::getInstance()->getBaseUrl().'/images/captcha/');
		
		$captcha = new Zend_Form_Element_Captcha('humanCheck', array('captcha' => $captchaImage));
		$captcha->setLabel('Unesite kod sa slike:');
		$captcha->setRequired(true);
		//$captcha->addErrorMessage('Pogrešna vrednost za captcha kod!');
		$userForm->removeElement('submit');
		$userForm->addElement($captcha, 'captcha')
		->addElement('submit','submit', array('label' => 'Prijavi se'));
		
		$this->view->form_first = $userForm;
	}
	
	
	public function notmatchAction() 
	{	
		if(Zend_Auth::getInstance()->hasIdentity())
    	{
    		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL)
	        {
	        	return $this->_redirect($_SERVER['HTTP_REFERER']);
	        }
	       	return $this->_redirect('/');
	    }
        $userForm = new Users_Form_UserLogin();
        $userForm->setAction($this->view->baseUrl() . '/users/login/notmatch');
        
		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL  && (stripos($_SERVER['HTTP_REFERER'],'/users/login') === false) && (stripos($_SERVER['HTTP_REFERER'],'/users/registration') === false))
		{
	       	$userForm->getElement('return')->setValue($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$userForm->getElement('return')->setValue('/users/useraccount');
		}
        
        if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$data = $userForm->getValues();
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
        		//save sid
     			$mdlUser = new Users_Model_User();
	     		$mdlUser->saveSid($auth->getIdentity()->id,Zend_Session::getId());
        		
	     		$mdlTmp = new Users_Model_UserRecovery();
	     		$mdlTmp->deleteUser($auth->getIdentity()->id);
	     			
	     		if(isset($_POST['return']) && $_POST['return'] != NULL)
			    {
			       	return $this->_redirect($_POST['return']);
			    }
		       	return $this->_redirect('/users/useraccount');
        	}
        	else
        	{
        		$authAdapter = new Zend_Auth_Adapter_DbTable($db,'temporarypassword','username','password');
	        	$authAdapter->setIdentity($data['username']);
	        	$authAdapter->setCredential(md5($data['password']));
	        	$result = $authAdapter->authenticate();
	        	if($result->isValid())
	        	{
	        		$auth = Zend_Auth::getInstance();
	        		$storage = $auth->getStorage();
	        		$storage->write($authAdapter->getResultRowObject(array('id','username',
	        		'first_name','last_name','role','sex')));
	        		//save sid
	     			$mdlUser = new Users_Model_User();
	     			$mdlUser->saveSid($auth->getIdentity()->id,Zend_Session::getId());
			    	return $this->_redirect('/users/updateuser/updatepassword');
	        	}
	        	else
	        	{
        			$this->view->loginMessage = "Sorry, your username or password was incorrect";
	        	}
        	}
        }	
		//$userForm->getElement('submit')->setLabel('Prijava');
        $this->view->form = $userForm;
	}
}