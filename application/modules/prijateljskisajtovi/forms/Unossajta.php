<?php

class Prijateljskisajtovi_Form_Unossajta extends Zend_Form {
	public function init() {
		$this->setMethod ( 'post' );
		$this->setAction ( '' );
		$dateTemp = new DateTime ( "", new DateTimeZone ( 'Europe/Belgrade' ) );
		$datum = date ( $dateTemp->format ( 'Y-m-d H-i-s' ) );
		$validatorRequiered = new Zend_Validate_NotEmpty ();
		$validatorRequiered->setMessages ( array (Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!" ) );
		$validatorlength = new Zend_Validate_StringLength ( array ('min' => 3, 'max' => 25 ) );
		$validatorlength->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugacko! Maksimum je 25 karaktera!", Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 3 karaktera!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		
		// create new element
		$id_sajta = $this->createElement ( 'hidden', 'id_sajta' );
		// element options
		$id_sajta->setDecorators ( array ('ViewHelper' ) );
		//$this->setElementDecorators ( array (array ('ViewHelper' ), array ('Errors' ) ) );
		// add the element to the form
		$this->addElement ( $id_sajta );
		
		// create new element
		$auth = Zend_Auth::getInstance ();
		$gradValdidator1 = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\.,_\\\\\ \\/\(\)]+)$/' );
		$gradValdidator1->setMessages ( array (

		Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		
		$validatorlength1 = new Zend_Validate_StringLength ( array ('min' => 15, 'max' => 50 ) );
		
		$validatorlength1->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!", Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 15 karaktera!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		$naslov = $this->createElement ( 'text', 'naslov' );
		$naslov->setLabel ( 'Naslov(od 15 do 50 karaktera):' );
		$naslov->setRequired ( TRUE );
		$naslov->addValidator ( $validatorRequiered );
		$naslov->addValidator ( $gradValdidator1 );
		$naslov->addValidator ( $validatorlength1 );
		
		$naslov->setAttrib ( 'size', 50 );
		$naslov->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$this->addElement ( $naslov );
		
		// add element: EMAIL textbox
		$email = $this->createElement ( 'text', 'email' );
		$email->setLabel ( 'E-mail:' );
		//$email->setRequired ( TRUE );
		$email->addErrorMessage ( 'Pogresan format e-mail adrese!' );
		$email->addValidator ( new Zend_Validate_EmailAddress () );
		
		$email->addFilters ( array (new Zend_Filter_StringTrim (), new Zend_Filter_StringToLower () ) );
		$email->setAttrib ( 'size', 50 );
		$email->setRequired ( TRUE );
		$this->addElement ( $email );
		
		$sajtValdidator1 = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\\-.:\\/\(\)]+)$/' );
		$sajtValdidator1->setMessages ( array (Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		// add element: SAJT textbox
		$sajt = $this->createElement ( 'text', 'sajt' );
		$sajt->setLabel ( 'Sajt:' );
		//$sajt->setRequired ( TRUE );
		$sajt->setAttrib ( 'size', 50 );
		$sajt->setRequired ( TRUE );
		$sajt->addValidator ( $validatorRequiered );
		$sajt->addValidator ( $sajtValdidator1 );
		
		$sajt->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$this->addElement ( $sajt );
		
		// add element: DETALJI textbox
		$detalji = $this->createElement ( 'textarea', 'detalji' );
		// element options
		$detalji->setLabel ( 'Opis:' );
		$detalji->setRequired ( TRUE );
		//$text->setRequired ( TRUE );
		$detalji->setAttrib ( 'cols', 50 );
		$detalji->setAttrib ( 'rows', 8 );
		$detalji->addValidator ( $validatorRequiered );
		$detalji->addValidator ( $gradValdidator1 );
		// add the element to the form
		$this->addElement ( $detalji );
		
		// create new element
		$glavnaslika = $this->createElement ( 'file', 'glavnaslika' );
		// element options
		$glavnaslika->setLabel ( 'Logo(pozeljan format 200x100): ' );
		$glavnaslika->setRequired ( FALSE );
		$glavnaslika->setDestination ( APP_PUBLIC . '/images/prijateljskisajtovi/upload' );
		// ensure only 1 file
		$glavnaslika->addValidator ( 'Count', false, 1 );
		// limit to 100K
		$glavnaslika->addValidator ( 'Size', false, 1024000000 );
		// only JPEG, PNG, and GIFs
		$glavnaslika->addValidator ( 'Extension', false, 'jpg,png,gif,bmp' );
		$glavnaslika->addFilter ( 'Rename', array ('target' => APP_PUBLIC . '/images/prijateljskisajtovi/upload/' . "Nis -PrijateljskiSajtovi-Slika-" . $datum . '.jpg', 'overwrite' => true ) );
		// add the element to the form
		$this->addElement ( $glavnaslika );
		
		$captchaImage = new Zend_Captcha_Image ();
		$captchaImage->setFont ( APP_PUBLIC . '/font/ariali.ttf' )->setMessages ( array (Zend_Captcha_Image::BAD_CAPTCHA => 'Pogrešna vrednost za captcha kod!', Zend_Captcha_Image::MISSING_VALUE => 'Morate uneti kod sa slike!', Zend_Captcha_Image::MISSING_ID => 'Morate uneti kod sa slike!' ) )->setDotNoiseLevel ( 0 )->setLineNoiseLevel ( 3 )->setFontSize ( 18 )->setWidth ( 100 )->setWordLen ( 6 )->setHeight ( 50 )->setTimeout ( 180 )->setExpiration ( 600 )->setImgDir ( APP_PUBLIC . '/images/captcha' );
		$captchaImage->setImgUrl ( Zend_Controller_Front::getInstance ()->getBaseUrl () . '/images/captcha/' );
		
		$captcha = new Zend_Form_Element_Captcha ( 'humanCheck', array ('captcha' => $captchaImage ) );
		$captcha->setLabel ( 'Captcha code (unesite kod sa slike):' );
		$captcha->setRequired ( true );
		//$this->addElement ( $captcha, 'captcha' );
		
		$submit = $this->addElement ( 'submit', 'submit', array ('label' => 'Unesi' ) );
	}
	
	function setPotkategorije(array $potkategorije) {
		$this->getElement ( 'podkategorija' )->setMultiOptions ( $potkategorije );
	}
}
?>
