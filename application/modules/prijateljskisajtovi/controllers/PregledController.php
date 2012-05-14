<?php

/**
 * PregledController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Prijateljskisajtovi_PregledController extends Prijateljskisajtovi_Library_Controller_Action_Abstract {
	/**
	 * The default action - show the home page
	 */
public function indexAction() {
		// TODO Auto-generated PregledController::indexAction() default action
		$this->view->headTitle ()->append ( 'Prijateljski sajtovi' );
	
		$this->view->adminExpand = TRUE;
		$formaUnosSajta = new Prijateljskisajtovi_Form_Unossajta ();
		$this->view->forma = $formaUnosSajta;
		if ($this->getRequest ()->isPost ()) {
			if ($formaUnosSajta->isValid ( $_POST )) {
				$sajtModel = new Prijateljskisajtovi_Model_Prijateljskisajtovi ();
				
				$name = $formaUnosSajta->getValue ( 'naslov' );
				
				$dateTemp = new DateTime ( "", new DateTimeZone ( 'Europe/Belgrade' ) );
				$datum = date ( $dateTemp->format ( 'Y-m-d H:i:s' ) );
				
				
				
				$itemOglas->telefoni = $formaUnosSajta->getValue ( 'telefoni' );
				
				$email = $formaUnosSajta->getValue ( 'email' );
				
				$sajt = $formaUnosSajta->getValue ( 'sajt' );
				
				$detalji = $formaUnosSajta->getValue ( 'detalji' );
				
				//upload the image
				if ($formaUnosSajta->glavnaslika->isUploaded ()) {
					$formaUnosSajta->glavnaslika->receive ();
					$slika = '/images/prijateljskisajtovi/upload/' . basename ( $formaUnosSajta->glavnaslika->getFileName () );
				} else {
					$slika = '/images/prijateljskisajtovi/mainimages/VlasotinceOglasi.jpg';
				}
				
				// save the content item
				$sajtModel->createSajt ( $name, $email, $sajt, $detalji, $slika );
				return $this->_redirect ( 'prijateljskisajtovi/pregled/listasajtova' );
			
			}
		}
	
	}
	public function listasajtovaAction() {
		$listaSajtovaModel = new Prijateljskisajtovi_Model_Prijateljskisajtovi ();
		$listaSajtova = $listaSajtovaModel->getAll ();
		$this->view->sajtovi = $listaSajtova;
		$this->view->adminExpand = TRUE;
	
	}
	public function editsajtAction() {
		$this->view->adminExpand = TRUE;
		$sajtId = $this->_request->getParam ( 'sajt' );
		$this->view->headTitle ()->prepend ( 'Promena podataka o linku' );
		$formaUnosSajta = new Prijateljskisajtovi_Form_Unossajta ();
		$sajtModel = new Prijateljskisajtovi_Model_Prijateljskisajtovi ();
		$sajtPodaci = $sajtModel->find ( $sajtId )->current ();
		$podaci = $sajtPodaci->toArray ();
		$this->view->slika = $podaci ["slika"];
		if ($this->getRequest ()->isPost ()) {
			if ($formaUnosSajta->isValid ( $_POST )) {
				$id_sajta = $formaUnosSajta->getValue ( 'id_sajta' );
				
				$name = $formaUnosSajta->getValue ( 'naslov' );
				
				$email = $formaUnosSajta->getValue ( 'email' );
				
				$sajt = $formaUnosSajta->getValue ( 'sajt' );
				
				$detalji = $formaUnosSajta->getValue ( 'detalji' );
				
				//upload the image
				if ($formaUnosSajta->glavnaslika->isUploaded ()) {
					$formaUnosSajta->glavnaslika->receive ();
					$slika = '/images/prijateljskisajtovi/upload/' . basename ( $formaUnosSajta->glavnaslika->getFileName () );
				} else {
					$slika = $podaci ["slika"];
				}
				
				// save the content item
				$sajtModel->updateSajt ( $id_sajta, $name, $email, $sajt, $detalji, $slika );
				return $this->_redirect ( 'prijateljskisajtovi/pregled/listasajtova' );
			
			}
		}
		
		$formaUnosSajta->populate ( $podaci );
		
		$this->view->forma = $formaUnosSajta;
	
	}
	public function deletesajtAction() {
		$id = $this->_request->getParam ( 'sajt' );
		$userModel = new Prijateljskisajtovi_Model_Prijateljskisajtovi ();
		$userModel->deleteSajt ( $id );
		return $this->_redirect ( '/prijateljskisajtovi/pregled/listasajtova' );
	}

}

