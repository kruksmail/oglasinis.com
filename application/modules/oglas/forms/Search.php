<?php

class Oglas_Form_Search extends Zend_Form {
   protected  $_kategorija_id;
 
   public function __construct($kat_id = null)
   {
      $this->_kategorija_id = $kat_id;
      parent::__construct();
   }
   
	public function init() {
		$this->setMethod ( 'post' );
		$this->setAction ( '' );
		
		$gradoviNiz = array (0 => 'Svi', 'NIŠ' => 'NIŠ' );
		$sortNiz = array ( '0' => 'Datumu',
								'cena ASC' => 'Cena +', 
   							'cena DESC' => 'Cena -', 
   							'naslov' => 'Naslovu oglasa' );
		
		$dateTemp = new DateTime ( "", new DateTimeZone ( 'Europe/Belgrade' ) );
		$datum = date ( $dateTemp->format ( 'Y-m-d H-i-s' ) );
		
		$validatorRequiered = new Zend_Validate_NotEmpty ();
		$validatorRequiered->setMessages ( array (Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!" ) );
		$validatorlength = new Zend_Validate_StringLength ( array ('min' => 3, 'max' => 25 ) );
		$validatorlength->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugacko! Maksimum je 25 karaktera!", Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 3 karaktera!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		
		unset($podkategorijeNiz);
	   if($this->_kategorija_id)
	   {
	      $podkategorijeNiz[0] = "Sve";
	      $podkategorijaModel = new Kategorija_Model_Podkategorije();
	      $mdlOglas = new Oglas_Model_Oglas();
         foreach ($podkategorijaModel->getPodkategorije() as $podkatRow)
         {
            if($this->_kategorija_id == $podkatRow->kategorija)
            {
              $podkategorijeNiz[$podkatRow["id"]] = $podkatRow["label"] . " (" . number_format($mdlOglas->podkategorijeCount($podkatRow->id)) . ")";
            }
         }
	   }
	   if(count($podkategorijeNiz) > 1)
	   {
         $podkategorijeSel = $this->createElement ( 'select', 'oblast' );
   		// element options
   		$podkategorijeSel->setLabel ( 'Oblast: ' );
   		$podkategorijeSel->addMultiOptions ( $podkategorijeNiz );
   		$this->addElement ( $podkategorijeSel );
	   }
	   
		// add element: PONUDA ili POTRAZNJA select box
		$ponudatraznja = $this->createElement ( 'select', 'ponudatraznja' );
		$ponudatraznja->setLabel ( 'Ponuda/potražnja:' );
		$ponudatraznja->addValidator ( new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\._\\\\\/\(\)]+)$/' ) );
		$ponudatraznja->addMultiOptions ( array (0 => 'Sve', 'ponuda' => 'Ponuda', 'potraznja' => 'Potražnja' ) );
		$this->addElement ( $ponudatraznja );
		
		// create new element
		$auth = Zend_Auth::getInstance ();
		$gradValdidator1 = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\.,_\\\\\ \\/\(\)]+)$/' );
		$gradValdidator1->setMessages ( array (

		Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		
		$valdidator_cena = new Zend_Validate_InArray(
			                         array (0,1,2,3,4,5));

		// add element: KO POSTAVLJA OGLAS textbox
		$validatorlength1 = new Zend_Validate_StringLength ( array ('min' => 15, 'max' => 50 ) );
		
		$validatorlength1->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!", Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 15 karaktera!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		
		$grad = $this->createElement ( 'select', 'grad' );
		// element options
		$grad->setLabel ( 'Grad: ' );
		$grad->addMultiOptions ( $gradoviNiz );
		$this->addElement ( $grad );
		
		$telefonilength1 = new Zend_Validate_StringLength ( array ('max' => 55 ) );
		$telefonilength1->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugačko!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		$telefoniValdidator1 = new Zend_Validate_Regex ( '/^([0-9\\- \\/\(\)]+)$/' );
		$telefoniValdidator1->setMessages ( array (Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		
		$sajtValdidator1 = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\\-.:\\/\(\)]+)$/' );
		$sajtValdidator1->setMessages ( array (Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		
		$cenaValdidator1 = new Zend_Validate_Regex ( '/^([0-9]+)$/' );
		$cenaValdidator1->setMessages ( array (Zend_Validate_Regex::NOT_MATCH => "Cena mora biti u brojevima!", Zend_Validate_Regex::INVALID => "Cena mora biti u brojevima!" ) );
		
		// add element: CENAOD textbox
		$cenaod = $this->createElement ( 'text', 'cenaod' );
		$cenaod->setLabel ( 'Cena od:' );
		
		$cenaod->addValidator ( $cenaValdidator1 );
		$cenaod->setAttrib ( 'size', 5 );
		//$this->addElement ( $cenaod );
		
		// add element: CENADO textbox
		$cenado = $this->createElement ( 'text', 'cenado' );
		$cenado->setLabel ( 'do:' );
		//$cena->setRequired ( TRUE );
		

		$cenado->addValidator ( $cenaValdidator1 );
		$cenado->setAttrib ( 'size', 5 );
		//$this->addElement ( $cenado );
		
		// add element: VALUTA CENE select box
		$cena = $this->createElement ( 'select', 'cena' );
		$cena->setLabel ( 'Cena (EUR):' );
		$cena->setRequired ( TRUE );
		$cena->addMultiOptions ( array (0 => 'Sve', 
													 1 => '0 - 100',
													 2 => '100 - 200',
													 3 => '200 - 500',
													 4 => '500 - 1000',
													 5 => 'preko 1000', ) );
		$cena->addValidator ( $gradValdidator1 );
		$cena->addValidator ( $valdidator_cena );
		$this->addElement ( $cena );
		
		// add element: VALUTA CENE select box
		$valuta = $this->createElement ( 'select', 'valuta' );
		$valuta->setLabel ( 'Valuta:' );
		$valuta->setRequired ( TRUE );
		$valuta->addMultiOptions ( array ('EUR' => 'EUR', 'DIN' => 'DIN' ) );
		$valuta->addValidator ( $gradValdidator1 );
		//$this->addElement ( $valuta );
		
		$sort = $this->createElement ( 'select', 'sort' );
		// element options
		$sort->setLabel ( 'Sortiraj: ' );
		$sort->addValidator ( $gradValdidator1 );
		$sort->addMultiOptions ( $sortNiz );
		$this->addElement ( $sort );
		
		$submit = $this->createElement ( 'submit', 'submit' );
		$submit->setLabel ( 'Prikaži' );
		$submit->setDecorators ( array ('ViewHelper' ) );
		$submit->setAttrib ( 'class', 'submit' );
		$this->addElement ( $submit );
		
		$elements = $this->getElements ();
		foreach ( $elements as $elem ) {
			$elem->removeDecorator ( 'HtmlTag' );
			$elem->removeDecorator('Errors');
			$elem->removeDecorator('DtDdWrapper');
			$elem->removeDecorator('Label');
		}
		$this->setDecorators ( array (array ('ViewScript', array ('viewScript' => 'forms/search.phtml' ) ) ) ); //dekorator za samu formu
		
	}
	
	function setPotkategorije(array $potkategorije) {
		$this->getElement ( 'podkategorija' )->setMultiOptions ( $potkategorije );
	}
}
?>
