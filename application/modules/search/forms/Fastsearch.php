<?php
class Search_Form_Fastsearch extends Zend_Form {
	public function init() {
		//validatori
		$validatorRequiered = new Zend_Validate_NotEmpty ();
		$validatorRequiered->setMessages ( array (Zend_Validate_NotEmpty::IS_EMPTY => "Niste izabrali rec koju trazite" ) );
		$validatorlength = new Zend_Validate_StringLength ( array ('min' => 1, 'max' => 50 ) );
		$validatorlength->setMessages ( array (Zend_Validate_StringLength::TOO_LONG => "Predugacko! Maksimum je 50 karaktera!", Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 1 karaktera!", Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!" ) );
		$gradValdidator1 = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\.,_\\\\\ \\/\(\)]+)$/' );
		$gradValdidator1->setMessages ( array (

		Zend_Validate_Regex::NOT_MATCH => "Nevalidan format unosa!", Zend_Validate_Regex::INVALID => "Nevalidan format unosa!" ) );
		// create new element
		$query = $this->createElement ( 'text', 'query' );
		// element options
		$query->setLabel ( 'Brza pretraga:' );
		$query->addValidator ( $validatorRequiered );
		$query->addValidator ( $gradValdidator1 );
		$query->addValidator ( $validatorlength );
		$query->setAttrib ( 'class', 'input' );
		$query->setAttrib ( 'size', 15 );
		// add the element to the form
		$this->addElement ( $query );
		$submit = $this->createElement ( 'submit', 'submit' );
		$submit->setLabel ( 'Traži' );
		$submit->setDecorators ( array ('ViewHelper' ) );
		$submit->setAttrib ( 'class', 'submit' );
		$this->addElement ( $submit );
		
		/////////////////////////////////////////////////////////////////najbitnije//////////////////////////////////////
		//dekoratori za elemente u formi
		$this->setElementDecorators ( array (array ('ViewHelper' ), array ('Errors' ) ) );
		$elements = $this->getElements ();
		foreach ( $elements as $elem ) {
			$elem->removeDecorator ( 'HtmlTag' );
		}
		
		$this->setDecorators ( array (array ('ViewScript', array ('viewScript' => 'forms/fastsearch.phtml' ) ) ) ); //dekorator za samu formu
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
}