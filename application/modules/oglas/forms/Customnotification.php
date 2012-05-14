<?php

class Oglas_Form_Customnotification extends Zend_Form {
	public function init() {
		$this->setMethod ( 'post' );
		$this->setAction ( '' );
		//ODABIR KATEGORIJA ZA SLANJE OBAVESTENJA
		$mdlKategorije = new Kategorija_Model_Glavnekategorije ();
		$kat = $mdlKategorije->getKategorije ();
		$kategorije = array ();
		foreach ( $kat as $kategorija ) {
			$kategorije ["Kategorija".$kategorija->id] = $kategorija->name;

		}
		$trigeri = $this->createElement ( 'multicheckbox', 'trigeri' );
		$trigeri->addMultiOptions ( $kategorije );
		$trigeri->setLabel ( "Odaberite kategorije oglasa za koje zelite primati obaveštenja:" );
		$this->addElement ( $trigeri );
		
		$submit = $this->addElement ( 'submit', 'submit', array ('label' => 'Snimi' ) );
	}
}