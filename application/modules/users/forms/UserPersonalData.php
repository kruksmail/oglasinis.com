<?php

class Users_Form_UserPersonalData extends Zend_Form
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
		
		$validatorlength = new Zend_Validate_StringLength(array('min' => 0, 'max' => 50));
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!"));
		
		$firstName = $this->createElement('text', 'first_name');
		$firstName->setLabel('Ime: ');
		$firstName->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength);
		$firstName->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($firstName);
		
		$lastName = $this->createElement('text', 'last_name');
		$lastName->setLabel('Prezime: ');
		$lastName->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength);
		$lastName->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($lastName);
		
		$sex = $this->createElement('select', 'sex');
		$sex->setLabel('Pol:');
		$sex->setRequired(TRUE);
		$sex->addMultiOptions(array(
			'Muški' => 'Muški',
			'Ženski' => 'Ženski'
		));
		$this->addElement($sex);
		
		$birthdate = $this->createElement('text', 'birthdate');
		$birthdate->setLabel('Datum rođenja (u formatu: dd-mm-gggg): ');
		$birthdate->addValidator(new Zend_Validate_Date('DD-MM-YYYY'))
		->addErrorMessage("Neispravan format datuma!")
		->addFilter('StringTrim')
		->addFilter('StripTags');
		$birthdate->setAttrib('size','20');
		$this->addElement($birthdate);
		
		$validatorlength->setMax(95);
		$validatorlength->setMin(0);
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 100 karaktera!"));
		
		$employee = $this->createElement('text', 'employee');
		$employee->setLabel('Zaposlen u: ')
		->addValidator($validatorlength);
		$employee->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($employee);
		
		$this->addElement('submit','submit', array('label' => 'Sačuvaj promene'));
	
	}
}