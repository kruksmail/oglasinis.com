<?php

class Users_Form_User extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		$username = $this->createElement('text', 'username');
		$username->setLabel('Korisničko ime: ');
		$username->setRequired(TRUE);
		//$username->setAttrib('size','40');
		$username->addErrorMessage('The username is required!');
		$username->addFilter('StripTags');
		$this->addElement($username);
		
		$password = $this->createElement('password', 'password');
		$password->setLabel('Lozinka: ');
		$password->setRequired(TRUE);
		$this->addElement($password);
		
		$firstName = $this->createElement('text', 'first_name');
		$firstName->setLabel('First Name: ');
		$firstName->setRequired(TRUE);
		$firstName->addFilter('StripTags');
		$this->addElement($firstName);
		
		$lastName = $this->createElement('text', 'last_name');
		$lastName->setLabel('Last Name: ');
		$lastName->setRequired(TRUE);
		$lastName->addFilter('StripTags');
		$this->addElement($lastName);
		
		$role = $this->createElement('select', 'role');
		$role->setLabel('Select a role: ');
		$role->setRequired(TRUE);
		$role->addMultiOption('User','user');
		$role->addMultiOption('Administrator','administrator');
		$this->addElement($role);
		
		$this->addElement('submit','submit', array('label' => 'Prosledi'));	
	}
}