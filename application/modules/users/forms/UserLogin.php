<?php

class Users_Form_UserLogin extends Zend_Form
{
	public function init()
	{
		$validatorUsername = new Zend_Validate_Db_RecordExists(array(
		        'table' => 'users',
		        'field' => 'username'
		    )
		);
		
		if(isset($_POST['username']))
		{
			$validatorPassword = new Users_Form_PasswordValidator($_POST['username']);
		}
		else
		{
			$validatorPassword = new Users_Form_PasswordValidator('');
		}
		
		$this->setMethod('post');
		
		$username = $this->createElement('text', 'username');
		$username->setLabel('Korisničko ime: ');
		$username->setRequired(TRUE)
		->setAttrib('title','Korisničko ime')
		->setAttrib('placeholder','Korisničko ime')
		->addErrorMessage('Pogrešno korisničko ime!')
		->addValidator($validatorUsername);
		$username->addFilter('StripTags');
		$this->addElement($username);
		
		$password = $this->createElement('password', 'password');
		$password->setLabel('Lozinka: ')
		->setAttrib('title','Vaša lozinka')
		->setAttrib('placeholder','Vaša lozinka');
		$password->setRequired(TRUE)
		->addErrorMessage('Pogrešna lozinka!')
		->addValidator($validatorPassword);
		$this->addElement($password);
				
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
		$this->addElement($captcha, 'captcha');	
		
		$this->addElement('submit','submit', array('label' => 'Prijavi se'));	
		
		$id = $this->createElement('hidden', 'return');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
	}
}