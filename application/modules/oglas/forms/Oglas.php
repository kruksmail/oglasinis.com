<?php

class Oglas_Form_Oglas extends Zend_Form {
	public function init() {
		$this->setMethod ( 'post' );
		$this->setAction ( '' );
		
		$gradoviNiz = array ('NIŠ' => 'NIŠ' );

		
		$dateTemp = new DateTime ( "", new DateTimeZone ( 'Europe/Belgrade' ) );
		$datum = date ( $dateTemp->format ( 'Y-m-d H-i-s' ) );
		
		$validatorRequiered = new Zend_Validate_NotEmpty ();
		$validatorRequiered->setMessages ( array (Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!" ) );
		$validatorlength = new Zend_Validate_StringLength ( array ('min' => 3, 'max' => 25 ) );
		$validatorlength->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugacko! Maksimum je 25 karaktera!", Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 3 karaktera!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		
		// create new element
		$id = $this->createElement ( 'hidden', 'id' );
		// element options
		$id->setDecorators ( array ('ViewHelper' ) );
		//$this->setElementDecorators ( array (array ('ViewHelper' ), array ('Errors' ) ) );
		// add the element to the form
		$this->addElement ( $id );
		
		$sveKategorije = array ();
		$prvi = array ();
		$svePodKategorije = array ();
		$kategorijeModel = new Kategorija_Model_Glavnekategorije ();
		$sveKategorije [0] = "Odaberite kategoriju";
		foreach ( $kategorijeModel->getKategorijeNames () as $key => $value ) {
			$sveKategorije [$value->id] = $value->name;
		
		}
		
		// add element: KATEGORIJA select box
		$id_kategorije= $this->createElement ( 'select', 'id_kategorije' );
		$id_kategorije->setLabel ( 'Kategorija:' );
		$id_kategorije->setRequired ( TRUE );
		$id_kategorije->setAttrib ( 'onClick', "getPodKategorije()" );
		$id_kategorije->addValidator ( new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\._\\\\\/\(\)]+)$/' ) );
		$id_kategorije->addMultiOptions ( $sveKategorije );
		$id_kategorije->setValue ( $sveKategorije [0] );
		
		$this->addElement ( $id_kategorije );
		
		$svePodKategorijeModel = new Kategorija_Model_Podkategorije ();
		foreach ( $svePodKategorijeModel->getPodkategorije () as $key => $value ) {
			$svePodKategorije [$value->id] = $value->label;
		
		}
		
		// add element: PODKATEGORIJA select box
		$svePodKategorije [0] = "Nema podkategorije";
		$id_podkategorije = $this->createElement ( 'select', 'id_podkategorije' );
		$id_podkategorije->setLabel ( 'Pod kategorija:' );
		$id_podkategorije->setRequired ( TRUE );
		$id_podkategorije->addValidator ( new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\._\\\\\/\(\)]+)$/' ) );
		$id_podkategorije->addMultiOptions ( $svePodKategorije );
		$id_podkategorije->setValue ( $svePodKategorije [0] );
		$this->addElement ( $id_podkategorije );
		
		// add element: PONUDA ili POTRAZNJA select box
		$ponudatraznja = $this->createElement ( 'select', 'ponudatraznja' );
		$ponudatraznja->setLabel ( 'Ponuda ili potražnja:' );
		$ponudatraznja->setRequired ( TRUE );
		$ponudatraznja->addValidator ( new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\._\\\\\/\(\)]+)$/' ) );
		$ponudatraznja->addMultiOptions ( array ('ponuda' => 'Ponuda', 'potraznja' => 'Potražnja' ) );
		$this->addElement ( $ponudatraznja );
		
		// create new element
		$auth = Zend_Auth::getInstance ();
		$gradValdidator1 = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\.,_:\\\\\ \\/\(\)]+)$/' );
		$gradValdidator1->setMessages ( array (

		Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		if ($auth->hasIdentity ()) {
			$oglasivac = $this->createElement ( 'hidden', 'oglasivac' );
			// element options
			

			$oglasivac->setRequired ( TRUE );
			$oglasivac->setValue ( $auth->getIdentity ()->id );
			// add the element to the form
			$this->addElement ( $oglasivac );
		} else {
			$oglasivac = $this->createElement ( 'text', 'oglasivac' );
			// element options
			$oglasivac->setLabel ( 'Vase ime: ' );
			$oglasivac->setRequired ( TRUE );
			//$oglasivac->addErrorMessage ( 'Obavezan unos!' );
			$oglasivac->addValidator ( $validatorRequiered );
			$oglasivac->addValidator ( $validatorlength );
			$oglasivac->setAttrib ( 'size', 50 );
			$oglasivac->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
			// add the element to the form
			$this->addElement ( $oglasivac );
		}
		
		// add element: KO POSTAVLJA OGLAS textbox
		$validatorlength1 = new Zend_Validate_StringLength ( array ('min' => 5, 'max' => 50 ) );
		
		$validatorlength1->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!", Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 5 karaktera!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		$naslov = $this->createElement ( 'text', 'naslov' );
		$naslov->setLabel ( 'Naslov oglasa:' );
		$naslov->setRequired ( TRUE );
		$naslov->addValidator ( $validatorRequiered );
		$naslov->addFilter ( 'StripTags' );
		$naslov->addValidator ( $validatorlength1 );
		
		$naslov->setAttrib ( 'size', 50 );
		$naslov->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$this->addElement ( $naslov );
		
		$grad = $this->createElement ( 'select', 'grad' );
		// element options
		$grad->setLabel ( 'Grad: ' );
		$grad->setRequired ( TRUE );
		$grad->addValidator ( $validatorRequiered );
		$grad->addMultiOptions ( $gradoviNiz );
		$this->addElement ( $grad );
		
		$adresa = $this->createElement ( 'text', 'adresa' );
		// element options
		$adresa->setLabel ( 'Ulica i broj: ' );
		//$adresa->setRequired ( TRUE );
		$adresa->setAttrib ( 'size', 50 );
		$adresa->addValidator ( $validatorlength1 );
		$adresa->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		// add the element to the form
		$this->addElement ( $adresa );
		
		$telefonilength1 = new Zend_Validate_StringLength ( array ('max' => 55 ) );
		$telefonilength1->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugačko!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		$telefoniValdidator1 = new Zend_Validate_Regex ( '/^([0-9\\- \\/\(\)]+)$/' );
		$telefoniValdidator1->setMessages ( array (Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		// add element: BROJEVI TELEFONA textbox
		$telefoni = $this->createElement ( 'text', 'telefoni' );
		$telefoni->setLabel ( 'Brojevi telefona(max 3 u formatu 011/123-456 011/123-789):' );
		$telefoni->setRequired ( TRUE );
		$telefoni->addValidator ( $validatorRequiered );
		$telefoni->addValidator ( $telefoniValdidator1 );
		$telefoni->addValidator ( $telefonilength1 );
		$telefoni->setAttrib ( 'size', 50 );
		
		$this->addElement ( $telefoni );
		
		// add element: EMAIL textbox
		$email = $this->createElement ( 'text', 'email' );
		$email->setLabel ( 'E-mail:' );
		//$email->setRequired ( TRUE );
		$email->addErrorMessage ( 'Pogresan format e-mail adrese!' );
		$email->addValidator ( new Zend_Validate_EmailAddress () );
		$email->addFilters ( array (new Zend_Filter_StringTrim (), new Zend_Filter_StringToLower () ) );
		$email->setAttrib ( 'size', 50 );
		
		$this->addElement ( $email );
		
		$sajtValdidator1 = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\\-.:\\/\(\)]+)$/' );
		$sajtValdidator1->setMessages ( array (Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		// add element: SAJT textbox
		$sajt = $this->createElement ( 'text', 'sajt' );
		$sajt->setLabel ( 'Sajt:' );
		//$sajt->setRequired ( TRUE );
		$sajt->setAttrib ( 'size', 50 );
		$sajt->addValidator ( $sajtValdidator1 );
		$sajt->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$this->addElement ( $sajt );
		
		$cenaValdidator1 = new Zend_Validate_Regex ( '/^([0-9]+)$/' );
		$cenaValdidator1->setMessages ( array (Zend_Validate_Regex::NOT_MATCH => "Cena mora biti u brojevima!", Zend_Validate_Regex::INVALID => "Cena mora biti u brojevima!" ) );
		// add element: CENA textbox
		$cena = $this->createElement ( 'text', 'cena' );
		//$cena->addValidator ( new Zend_Validate_Regex ( '/^([0-9]+)$/' ) );
		

		$cena->setLabel ( 'Cena(za cenu po dogovoru NE popunjavate polje):' );
		//$cena->setRequired ( TRUE );
		$cena->addValidator ( $validatorRequiered );
		$cena->addValidator ( $cenaValdidator1 );
		$cena->setAttrib ( 'size', 50 );
		$this->addElement ( $cena );
		
		// add element: VALUTA CENE select box
		$valuta = $this->createElement ( 'select', 'valuta' );
		$valuta->setLabel ( 'Valuta:' );
		//$valuta->setRequired ( TRUE );
		$valuta->addMultiOptions ( array ('EUR' => 'EUR', 'DIN' => 'DIN' ) );
		$valuta->addValidator ( $gradValdidator1 );
		$this->addElement ( $valuta );
		
		// add element: DETALJI textbox
		$detalji = $this->createElement ( 'textarea', 'detalji' );
		// element options
		$detalji->setLabel ( 'Text oglasa:' );
		$detalji->setRequired ( TRUE );
		//$text->setRequired ( TRUE );
		$detalji->setAttrib ( 'cols', 50 );
		$detalji->setAttrib ( 'rows', 8 );
		$detalji->addValidator ( $validatorRequiered );
		$detalji->addFilter ( 'StripTags' );
		// add the element to the form
		$this->addElement ( $detalji );
		
		// create new element
		$glavnaslika = $this->createElement ( 'file', 'glavnaslika' );
		// element options
		$glavnaslika->setLabel ( 'Glavna slika: ' );
		$glavnaslika->setRequired ( FALSE );
		$glavnaslika->setDestination ( APP_PUBLIC . '/images/upload/slikeoglasa' );
		// ensure only 1 file
		$glavnaslika->addValidator ( 'Count', false, 1 );
		// limit to 100K
		$glavnaslika->addValidator ( 'Size', false, 102400000 );
		// only JPEG, PNG, and GIFs
		$glavnaslika->addValidator ( 'Extension', false, 'jpg,png,gif,bmp' );
		$glavnaslika->addFilter ( 'Rename', array ('target' => APP_PUBLIC . '/images/upload/slikeoglasa/' . "Nis-Oglasi-Glavna-Slika" . $datum . '.jpg', 'overwrite' => true ) );
		// add the element to the form
		$this->addElement ( $glavnaslika );
		
		// create new element
		$slika2 = $this->createElement ( 'file', 'slika2' );
		// element options
		$slika2->setLabel ( 'Slika 1: ' );
		$slika2->setRequired ( FALSE );
		$slika2->setDestination ( APP_PUBLIC . '/images/upload/slikeoglasa' );
		// ensure only 1 file
		$slika2->addValidator ( 'Count', false, 1 );
		// limit to 100K
		$slika2->addValidator ( 'Size', false, 102400000 );
		// only JPEG, PNG, and GIFs
		$slika2->addValidator ( 'Extension', false, 'jpg,png,gif,bmp' );
		$slika2->addFilter ( 'Rename', array ('target' => APP_PUBLIC . '/images/upload/slikeoglasa/' . "Nis-Oglasi-Slika2-" . $datum . '.jpg', 'overwrite' => true ) );
		
		// add the element to the form
		$this->addElement ( $slika2 );
		
		// create new element
		$slika3 = $this->createElement ( 'file', 'slika3' );
		// element options
		$slika3->setLabel ( 'Slika 2: ' );
		$slika3->setRequired ( FALSE );
		$slika3->setDestination ( APP_PUBLIC . '/images/upload/slikeoglasa' );
		// ensure only 1 file
		$slika3->addValidator ( 'Count', false, 1 );
		// limit to 100K
		$slika3->addValidator ( 'Size', false, 102400000 );
		// only JPEG, PNG, and GIFs
		$slika3->addValidator ( 'Extension', false, 'jpg,png,gif,bmp' );
		$slika3->addFilter ( 'Rename', array ('target' => APP_PUBLIC . '/images/upload/slikeoglasa/' . "Nis-Oglasi-Slika3-" . $datum . '.jpg', 'overwrite' => true ) );
		
		// add the element to the form
		$this->addElement ( $slika3 );
		
		// create new element
		$slika4 = $this->createElement ( 'file', 'slika4' );
		// element options
		$slika4->setLabel ( 'Slika 3: ' );
		$slika4->setRequired ( FALSE );
		$slika4->setDestination ( APP_PUBLIC . '/images/upload/slikeoglasa' );
		// ensure only 1 file
		$slika4->addValidator ( 'Count', false, 1 );
		// limit to 100K
		$slika4->addValidator ( 'Size', false, 102400000 );
		// only JPEG, PNG, and GIFs
		$slika4->addValidator ( 'Extension', false, 'jpg,png,gif,bmp' );
		$slika4->addFilter ( 'Rename', array ('target' => APP_PUBLIC . '/images/upload/slikeoglasa/' . "Nis-Oglasi-Slika4-" . $datum . '.jpg', 'overwrite' => true ) );
		// add the element to the form
		$this->addElement ( $slika4 );
		
		$captchaImage = new Zend_Captcha_Image ();
		$captchaImage->setFont ( APP_PUBLIC . '/font/ariali.ttf' )->setMessages ( array (Zend_Captcha_Image::BAD_CAPTCHA => 'Pogrešna vrednost za captcha kod!', Zend_Captcha_Image::MISSING_VALUE => 'Morate uneti kod sa slike!', Zend_Captcha_Image::MISSING_ID => 'Morate uneti kod sa slike!' ) )->setDotNoiseLevel ( 0 )->setLineNoiseLevel ( 3 )->setFontSize ( 18 )->setWidth ( 100 )->setWordLen ( 6 )->setHeight ( 50 )->setTimeout ( 180 )->setExpiration ( 600 )->setImgDir ( APP_PUBLIC . '/images/captcha' );
		$captchaImage->setImgUrl ( Zend_Controller_Front::getInstance ()->getBaseUrl () . '/images/captcha/' );
		
		$captcha = new Zend_Form_Element_Captcha ( 'humanCheck', array ('captcha' => $captchaImage ) );
		$captcha->setLabel ( 'Captcha code (unesite kod sa slike):' );
		$captcha->setRequired ( true );
		//$this->addElement ( $captcha, 'captcha' );
		

		// add element: VALUTA CENE select box
		$proveren = $this->createElement ( 'select', 'proveren' );
		$proveren->setLabel ( 'Proveren:' );
		//$valuta->setRequired ( TRUE );
		$proveren->addMultiOptions ( array ('DA' => 'DA', 'NE' => 'NE' ) );
		$proveren->addValidator ( $gradValdidator1 );
		$this->addElement ( $proveren );
		
		$submit = $this->addElement ( 'submit', 'submit', array ('label' => 'Unesi oglas' ) );
	}
	
	function setPotkategorije(array $potkategorije) {
		$this->getElement ( 'podkategorija' )->setMultiOptions ( $potkategorije );
	}
}
?>
