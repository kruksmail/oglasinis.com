<?php
class Users_Form_UserAdditionalInfo extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$validatorlength = new Zend_Validate_StringLength(array('min' => 0, 'max' => 500));
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 500 karaktera!",
		Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 0 karaktera!",
		Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!"
		));
		
		
		$description = $this->createElement('textarea', 'description');
		$description->setLabel('Dodatne informacije o sebi:');
		$description->setAttrib('cols','50');
		$description->setAttrib('rows','4')
		->addValidator($validatorlength)
		->addFilter('StringTrim')
		->addFilter('StripTags');
		$this->addElement($description);
		
		$this->addElement('submit','submit', array('label' => 'Sačuvaj promene'));
	}
}