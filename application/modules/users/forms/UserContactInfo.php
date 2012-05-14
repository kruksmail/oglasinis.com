<?php
class Users_Form_UserContactInfo extends Zend_Form
{
	public function init()
	{		
		$element = $this->createElement('text', 'phone_mobile');
		$element->setLabel('Mobilni Telefon: ');
		$element->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($element);
		
		$element = $this->createElement('text', 'phone_home');
		$element->setLabel('Fiksni telefon: ')
		->addFilter('StringTrim');
		$element->addFilter('StripTags');
		$this->addElement($element);
		
		$element = $this->createElement('text', 'fax');
		$element->setLabel('Fax: ')
		->addFilter('StringTrim');
		$element->addFilter('StripTags');
		$this->addElement($element);
		
		$element = $this->createElement('text', 'address');
		$element->setLabel('Adresa: ');
		$element->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($element);
		
		$element = $this->createElement('text', 'city');
		$element->setLabel('Grad: ');
		$element->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($element);
		
		$element = $this->createElement('text', 'site');
		$element->setLabel('Web sajt: ');
		$element->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($element);
		
		$this->addElement('submit','submit', array('label' => 'Sačuvaj promene'));
	}
}