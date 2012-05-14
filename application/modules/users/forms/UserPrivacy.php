<?php
class Users_Form_UserPrivacy extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		
		$mdlConfirmation = new Users_Model_EmailConfirmation();
		$user_id = Zend_Auth::getInstance()->getIdentity()->id;
	    $confirmed = $mdlConfirmation->getUser($user_id)->confirmed;
	   
		$element = $this->createElement('MultiCheckbox','privacy');
		$element->setLabel('Izaberite polja koja će biti vidljiva za ostale korisnike: ');
		if($confirmed != NULL)
		{
		
			$element->addMultiOptions(array(
			'birthdate' => 'Datum rođenja',
			'fax' => 'Fax',
			'email' => 'Email adresa',
			'phone_mobile' => 'Mobilni telefon',
			'phone_home' => 'Fiksni telefon',
			'address' => 'Adresa',
			'city' => 'Grad',
			'site' => 'Sajt',
			'employee' => 'Zaposlen u',
			'description' => 'Dodatne informacije'
		));
		
		}
		else
		{
			$element->addMultiOptions(array(
				'birthdate' => 'Datum rođenja',
				'fax' => 'Fax',
				'phone_mobile' => 'Mobilni telefon',
				'phone_home' => 'Fiksni telefon',
				'address' => 'Adresa',
				'city' => 'Grad',
				'site' => 'Sajt',
				'employee' => 'Zaposlen u',
				'description' => 'Dodatne informacije'
		));
		
		}
		
		$id = Zend_Auth::getInstance()->getIdentity()->id;
		$mdlPrivacy = new Users_Model_UserPrivacy();
	    $default = $custom = NULL;
		if($mdlPrivacy->getUser($id) != NULL)
	    {
			$custom = $mdlPrivacy->getUser($id)->custom;
	    
			$customAsArray = explode(',',$custom);
		    $default = array();
			foreach($customAsArray as $field)
		    {
		    	$temp = explode('/',$field);
		    	$key = $temp[0];
		    	array_push($default,$key);
		    }
	    }
		$element->setValue($default,1);
		$this->addElement($element);
		
		$this->addElement('submit','submit', array('label' => 'Zapamti'));	
	}
}