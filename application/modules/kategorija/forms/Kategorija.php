<?php
class Kategorija_Form_Kategorija extends Zend_Form {
	public function init()
	{
		$this->setMethod('post');
		
		$validator = new Zend_Validate_Db_NoRecordExists(array(
		        'table' => 'kategorije',
		        'field' => 'name'
		    )
		);
		
		$validator->setMessage("Kategorija '%value%' postoji! Morate uneti drugu ime za kategoriju!",Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND);
		
		$validatorRequiered = new Zend_Validate_NotEmpty();
		$validatorRequiered->setMessages(
		array(
		Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!"
		)
		);
		
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		$name = $this->createElement('text', 'name');
		$name->setLabel('Naziv kategorije: ');
		$name->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validator);
		$name->setAttrib('size','30');
		$name->addFilter('StripTags');
		$this->addElement($name);

		$this->addElement('submit','submit', array('label' => 'Prosledi'));
	}
}
