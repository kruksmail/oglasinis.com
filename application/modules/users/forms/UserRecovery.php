<?php

class Users_Form_UserRecovery extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		
		$validatorRequiered = new Zend_Validate_NotEmpty();
		$validatorRequiered->setMessages(
		array(
		Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!"
		)
		);
		
		$validator = new Zend_Validate_Db_RecordExists(array(
		        'table' => 'users',
		        'field' => 'email'
		    )
		);
		
		$validator->setMessage("Email adresa '%value%' nije registrovana!",Zend_Validate_Db_RecordExists::ERROR_NO_RECORD_FOUND);
		
		$validatorEmail = new Zend_Validate_EmailAddress();
		$validatorEmail->setMessages(array(
		Zend_Validate_EmailAddress::INVALID_FORMAT => "Neispravan format email adrese!",
		Zend_Validate_EmailAddress::INVALID => "Neispravan format email adrese1!",
		Zend_Validate_EmailAddress::DOT_ATOM => "Neispravan format email adrese2!",
		Zend_Validate_EmailAddress::QUOTED_STRING => "Neispravan format email adrese3!",
		Zend_Validate_EmailAddress::INVALID_HOSTNAME => "Neispravan format email adrese4!",
		Zend_Validate_EmailAddress::INVALID_LOCAL_PART => "Neispravan format email adrese5!",
		Zend_Validate_EmailAddress::INVALID_MX_RECORD => "Neispravan format email adrese6!",
		Zend_Validate_EmailAddress::INVALID_SEGMENT => "Neispravan format email adrese7!",
		Zend_Validate_EmailAddress::LENGTH_EXCEEDED => "Neispravan format email adrese8!"
		));
		
		$validatorlength = new Zend_Validate_StringLength(array('min' => 0, 'max' => 250));
		
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 250 karaktera!",
		Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!"
		));
		
		$email = $this->createElement('text', 'email');
		$email->setLabel('Email:');
		$email->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorEmail)
		->addValidator($validatorlength)
		->addValidator($validator);
		$email->addFilters(array(new Zend_Filter_StringTrim(), new Zend_Filter_StringToLower()))
		->addFilter('StripTags');
		$email->setAttrib('size','30');
		$this->addElement($email);
		
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
		$this->addElement($captcha, 'captcha');	
		
		$this->addElement('submit','submit', array('label' => 'Pošalji'));
	}
}