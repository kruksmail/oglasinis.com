<?php
class Users_Form_UserDelete extends Zend_Form {
	public function init() {
		$validatorPassword = new Users_Form_PasswordValidatorId ( Zend_Auth::getInstance ()->getIdentity ()->id );
		
		$password = $this->createElement ( 'password', 'password' );
		$password->setLabel ( 'Lozinka: ' );
		$password->setRequired ( TRUE )->addErrorMessage ( 'Pogrešna lozinka!' )->addValidator ( $validatorPassword );
		$this->addElement ( $password );
		
		$this->addElement ( 'submit', 'submit1', array ('label' => 'Da' ) );
		$this->addElement ( 'submit', 'submit2', array ('label' => 'Ne' ) );
	}
}