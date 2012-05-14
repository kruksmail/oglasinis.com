<?php
class Users_Form_UserRegistration extends Zend_Form
{
	/*
	public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array('Label', array('tag' => 'td')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );
*/
	public function init()
	{
		$this->setMethod('post');
		$validatorlength = new Zend_Validate_StringLength(array('min' => 3, 'max' => 50));
	
		$validator = new Zend_Validate_Db_NoRecordExists(array(
		        'table' => 'users',
		        'field' => 'username'
		    )
		);
		
		$validator->setMessage("Korisničko ime '%value%' već postoji!",Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND);
			
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!",
		Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 6 karaktera!",
		Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!"
		));
		
		$validatorRequiered = new Zend_Validate_NotEmpty();
		$validatorRequiered->setMessages(
		array(
		Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!"
		)
		);
		
		$username = $this->createElement('text', 'username');
		$username->setLabel('Korisničko ime: ');
		$username->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength)
		->addValidator($validator);
		$username->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($username);
		
		$validatorlength->setMax(250);
		
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 250 karaktera!",
		Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 6 karaktera!",
		Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!"
		));
		
		$validatorIdentical = new Zend_Validate_Identical('password2');
		$validatorIdentical->setMessages(array(
			Zend_Validate_Identical::MISSING_TOKEN => 'Morate uneti lozinku!',
			Zend_Validate_Identical::NOT_SAME => 'Lozinke se ne poklapaju!'
		));
		
		$password = $this->createElement('password', 'password');
		$password->setLabel('Lozinka: ');
		$password->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength)
		->addValidator($validatorIdentical);
		$this->addElement($password);
		
		$validatorIdentical = new Zend_Validate_Identical('password');
		$validatorIdentical->setMessages(array(
			Zend_Validate_Identical::MISSING_TOKEN => 'Morate uneti lozinku!',
			Zend_Validate_Identical::NOT_SAME => 'Lozinke se ne poklapaju!'
		));
		
		$password2 = $this->createElement('password', 'password2');
		$password2->setLabel('Ponovite Lozinku: ');
		$password2->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength)
		->addValidator($validatorIdentical);
		$this->addElement($password2);
		
		$validatorlength = new Zend_Validate_StringLength(array('min' => 0, 'max' => 50));
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!"));
		
		$firstName = $this->createElement('text', 'first_name');
		$firstName->setLabel('Ime: ');
		$firstName->setRequired(TRUE)
		->addValidator($validatorlength)
		->addValidator($validatorRequiered);
		$firstName->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($firstName);
		
		$lastName = $this->createElement('text', 'last_name');
		$lastName->setLabel('Prezime: ');
		$lastName->setRequired(TRUE)
		->addValidator($validatorlength)
		->addValidator($validatorRequiered);
		$lastName->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($lastName);
		
		$validator = new Zend_Validate_Db_NoRecordExists(array(
		        'table' => 'users',
		        'field' => 'email'
		    )
		);

		
		$validator->setMessage("Email adresa '%value%' je registrovana! Morate uneti drugu email adresu!",Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND);
		
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
		
		$validatorlength->setMax(250);
		
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
			
		
		
		$sex = $this->createElement('select', 'sex');
		$sex->setLabel('Pol:');
		$sex->setRequired(TRUE);
		$sex->addMultiOptions(array(
			'Muški' => 'Muški',
			'Ženski' => 'Ženski'
		));
		$this->addElement($sex);
		
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
		
		$this->addElement('submit','submit', array('label' => 'Registruj se'));
	}
}