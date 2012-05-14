<?php

class Vlasotince_Form_Contact extends Zend_Form
{
	public function init()
	{
		$this->setAttrib('class', 'html_form comment_form');
		
		$naslovValdidator = new Zend_Validate_Regex ( '/^([0-9a-zA-Z\s\-\.,_\\\\\ \\/\(\)]+)$/' );
		$naslovValdidator->setMessages ( array (

		Zend_Validate_Regex::NOT_MATCH => "Nije validan format unosa!", Zend_Validate_Regex::INVALID => "Nije validan format unosa!" ) );
		$name = $this->createElement ( 'text', 'name' );
		$name->setLabel ( 'Vaše ime: ' );
		$name->setRequired ( TRUE );
		$name->addValidator ( $naslovValdidator );
		$name->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$name->setAttrib ( 'size', '40' );
		$name->addErrorMessage ( 'Nevalidan unos!' );
		$this->addElement ( $name );
		
		$email = $this->createElement ( 'text', 'email' );
		$email->setLabel ( 'Vaš email:' );
		$email->setRequired ( TRUE );
		$email->setAttrib ( 'size', '40' );
		$email->addValidator ( 'EmailAddress' );
		$email->addErrorMessage ( 'Nevalidan unos!' );
		$this->addElement ( $email );
		
		$subject = $this->createElement ( 'text', 'subject' );
		$subject->setLabel ( 'Tema: ' );
		$subject->setRequired ( TRUE );
		$subject->setAttrib ( 'size', '60' );
		$subject->addValidator ( $naslovValdidator );
		$subject->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$subject->addErrorMessage ( 'Nevalidan unos!' );
		$this->addElement ( $subject );
		
		$message = $this->createElement ( 'textarea', 'message' );
		$message->setLabel ( 'Poruka:' );
		$message->setRequired ( TRUE );
		$message->setAttrib ( 'cols', 50 );
		$message->setAttrib ( 'rows', 12 );
		$message->addValidator ( $naslovValdidator );
		$message->addFilter ( 'StripTags' )->addFilter ( 'StringTrim' );
		$message->addErrorMessage ( 'Nevalidan unos!' );
		$this->addElement ( $message );
		
		
		
		$this->addElement ( 'submit', 'submit', array ('label' => 'Pošalji poruku' ) );
	
	}
}
?>