<?php
class Kategorija_Form_Podkategorija extends Zend_Form {
	public function init()
	{
		$this->setMethod('post');
	
		$validatorRequiered = new Zend_Validate_NotEmpty();
		$validatorRequiered->setMessages(
		array(
		Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!"
		)
		);
		
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		$name = $this->createElement('text', 'label');
		$name->setLabel('Label: ');
		$name->setRequired(TRUE)
		->addValidator($validatorRequiered);
		$name->setAttrib('size','30');
		$name->addFilter('StripTags');
		$this->addElement($name);
		
		$link = $this->createElement('text', 'link');
		$link->setLabel('Link: ');
		$link->setRequired(TRUE)
		->addValidator($validatorRequiered);
		$link->setAttrib('size','30');
		$link->addFilter('StripTags');
		$this->addElement($link);
		
		$select = $this->createElement('select', 'kategorija');
		$select->setLabel('Kategorija: ');
		$select->setRegisterInArrayValidator(false);
		$select->addFilter('StripTags');
		$this->addElement($select);

		$this->addElement('submit','submit', array('label' => 'Prosledi'));
	}
}