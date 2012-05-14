<?php

/**
 * izmenaOglasaController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Oglas_UserController extends Oglas_Library_Controller_Action_Abstract {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
	
	}
	public function userizmenaAction() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$userID = $auth->getIdentity ()->id;
			$userRole = $auth->getIdentity ()->role;
			//echo $userRole;
		} else {
			$userRole = null;
			$userID = 0;
		}
		$oglasModelTemp = new Oglas_Model_Oglas ();
		$idOglasa = $this->_request->getParam ( 'oglas' );
		if ($oglasModelTemp->getPrivileges ( $idOglasa, $userID )) {
			$this->view->titl = "Promena oglasa";
			
			$oglas = $this->_request->getParam ( 'oglas' );
			$formaUnosOglasa = new Oglas_Form_Oglas ();
			$novotrajanje = $formaUnosOglasa->createElement ( 'text', 'novotrajanje' );
			$novotrajanje->setLabel ( "Novo trajanje u danima od danasnjeg datuma(nrp. za mesec dana je 30):" );
			$novotrajanje->setOrder ( 3 );
			$formaUnosOglasa->addElement ( $novotrajanje );
			
			//			$formaUnosOglasa->removeElement ( 'glavnaslika' );
			//			$formaUnosOglasa->removeElement ( 'slika2' );
			//			$formaUnosOglasa->removeElement ( 'slika3' );
			$formaUnosOglasa->removeElement ( 'proveren' );
			$formaUnosOglasa->removeElement ( 'trajanje_oglasa' );
			$formaUnosOglasa->removeElement ( 'oglasivac' );
			
			$itemOglasModel = new Oglas_Model_Oglas ();
			$itemOglas = $itemOglasModel->getOglas ( $oglas );
			
			if ($this->getRequest ()->isPost ()) {
				if ($formaUnosOglasa->isValid ( $_POST )) {
					
					$id_kategorije = $formaUnosOglasa->getValue ( 'id_kategorije' );
					
					$id_podkategorije = $formaUnosOglasa->getValue ( 'id_podkategorije' );
					
					$ponuda_traznja = $formaUnosOglasa->getValue ( 'ponudatraznja' );
					
					$naslov = $formaUnosOglasa->getValue ( 'naslov' );
					
					$proveren = $itemOglas [0]->proveren;
					
					$grad = $formaUnosOglasa->getValue ( 'grad' );
					
					$adresa = $formaUnosOglasa->getValue ( 'adresa' );
					
					$telefoni = $formaUnosOglasa->getValue ( 'telefoni' );
					
					$josDana = $formaUnosOglasa->getValue ( 'novotrajanje' );
					
					if (! $josDana == null) {
						$dateTemp = new DateTime ( "", new DateTimeZone ( 'Europe/Belgrade' ) );
						$date = strtotime ( "+$josDana day", strtotime ( date ( $dateTemp->format ( 'd-m-Y' ) ) ) );
						$datum = date ( "Y-m-d", $date );
						
						$trajanje_oglasa = $datum;
					} else {
						$trajanje_oglasa = $itemOglas [0]->trajanje_oglasa;
					}
					
					$email = $formaUnosOglasa->getValue ( 'email' );
					
					$sajt = $formaUnosOglasa->getValue ( 'sajt' );
					
					$cena = $formaUnosOglasa->getValue ( 'cena' );
					
					$valuta = $formaUnosOglasa->getValue ( 'valuta' );
					
					$detalji = $formaUnosOglasa->getValue ( 'detalji' );
					
					//upload the image
					$i = 0;
					for($m = 0; $m < 4; $m ++) {
						$slika [$m] == null;
					}
					
					if ($formaUnosOglasa->glavnaslika->isUploaded ()) {
						$formaUnosOglasa->glavnaslika->receive ();
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->glavnaslika->getFileName () );
						$i ++;
					} else {
						$slika [$i] = $itemOglas [0]->glavna_slika;
						$i ++;
					}
					if ($formaUnosOglasa->slika2->isUploaded ()) {
						$formaUnosOglasa->slika2->receive ();
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika2->getFileName () );
						$i ++;
					} else {
						$slika [$i] = $itemOglas [0]->slika_dva;
						$i ++;
					}
					if ($formaUnosOglasa->slika3->isUploaded ()) {
						$formaUnosOglasa->slika3->receive ();
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika3->getFileName () );
						$i ++;
					} else {
						$slika [$i] = $itemOglas [0]->slika_tri;
						$i ++;
					}
					if ($formaUnosOglasa->slika4->isUploaded ()) {
						$formaUnosOglasa->slika4->receive ();
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika4->getFileName () );
						$i ++;
					} else {
						$slika [$i] = $itemOglas [0]->slika_cetri;
						$i ++;
					}
					//$_SESSION ["slika"] = $slika;
					

					if (! isset ( $slika [0] )) {
						$glavna_slika = '/images/upload/slikeoglasa/VlasotinceOglasi.jpg';
					} else {
						$glavna_slika = $slika [0];
					}
					if (! isset ( $slika [1] )) {
						$slika_dva = '/images/upload/slikeoglasa/VlasotinceOglasi.jpg';
					} else {
						$slika_dva = $slika [1];
					}
					if (! isset ( $slika [2] )) {
						$slika_tri = '/images/upload/slikeoglasa/VlasotinceOglasi.jpg';
					} else {
						$slika_tri = $slika [2];
					}
					if (! isset ( $slika [3] )) {
						$slika_cetri = '/images/upload/slikeoglasa/VlasotinceOglasi.jpg';
					} else {
						$slika_cetri = $slika [3];
					}
					
					// save the content item
					$itemOglasModel->updateOglas ( $oglas, $id_kategorije, $id_podkategorije, $naslov, $grad, $ponuda_traznja, $adresa, $telefoni, $trajanje_oglasa, $email, $sajt, $cena, $valuta, $detalji, $glavna_slika, $slika_dva, $slika_tri, $slika_cetri, $proveren );
					return $this->_redirect ( 'oglas/user/listauser/' );
				}
			}
			$this->view->ip = $itemOglas [0]->ip_oglasivaca;
			$this->view->oglasivac = $itemOglas [0]->oglasivac;
			$this->view->trajanjeoglasa = $itemOglas [0]->trajanje_oglasa;
			$this->view->glavna_slika = $itemOglas [0]->glavna_slika;
			$this->view->slika_dva = $itemOglas [0]->slika_dva;
			$this->view->slika_tri = $itemOglas [0]->slika_tri;
			$this->view->slika_cetri = $itemOglas [0]->slika_cetri;
			
			$formaUnosOglasa->populate ( $itemOglas [0]->toArray () );
			
			$katTemp = new Kategorija_Model_Glavnekategorije ();
			$kat = $katTemp->getKategorijeById ( $formaUnosOglasa->getValue ( 'id_kategorije' ) );
			$formaUnosOglasa->getElement ( 'id_kategorije' )->setLabel ( 'Kategorija--' . $kat->name );
			
			$formaUnosOglasa->getElement ( 'glavnaslika' )->setLabel ( 'Ukoliko odaberete nove slike oglasa stare ce biti u tom slucaju izbrisane' );
			
			$podkatTemp = new Kategorija_Model_Podkategorije ();
			$podkat = $podkatTemp->getPodkategorijeByID ( $formaUnosOglasa->getValue ( 'id_podkategorije' ) );
			$formaUnosOglasa->getElement ( 'id_podkategorije' )->setLabel ( 'Podkategorija--' . $podkat->label );
			
			$this->view->form = $formaUnosOglasa;
		} else {
			$this->_redirect ( 'oglas/error/errornoauth ' );
		
		}
	
	}
	
	public function listauserAction() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$userID = $auth->getIdentity ()->id;
			$userRole = $auth->getIdentity ()->role;
			//echo $userRole;
		} else {
			$userRole = null;
			$userID = 0;
		}
		$this->view->adminExpand = TRUE;
		$req = $this->_request->getParam ( 'sort' );
		
		if (isset ( $req )) {
			if ($_SESSION ["sortDESC"] == " DESC") {
				$_SESSION ["sortDESC"] = " ASC";
			} else {
				$_SESSION ["sortDESC"] = " DESC";
			
			}
			$kriterijum = $req . $_SESSION ["sortDESC"];
		} else {
			$kriterijum = "datum_kreiranja DESC";
		}
		$oglasModel = new Oglas_Model_Oglas ();
		$adapter = $oglasModel->getAllForUser ( $kriterijum, $userID );
		$paginator = new Zend_Paginator ( $adapter );
		$paginator->setItemCountPerPage ( 10 );
		$page = $this->_request->getParam ( 'page' );
		$paginator->setCurrentPageNumber ( $page );
		$this->view->paginator = $paginator;
	
	}
	
	public function userbrisanjeAction() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$userID = $auth->getIdentity ()->id;
			$userRole = $auth->getIdentity ()->role;
			//echo $userRole;
		} else {
			$userRole = null;
			$userID = 0;
		}
		
		$oglasModelTemp = new Oglas_Model_Oglas ();
		$idOglasa = $this->_request->getParam ( 'oglas' );
		if ($oglasModelTemp->getPrivileges ( $idOglasa, $userID )) {
			$itemOglas = new Oglas_Model_Oglas ();
			$itemOglas->deleteOglas ( $idOglasa );
			return $this->_redirect ( 'oglas/user/listauser' );
		} else {
			$this->_redirect ( 'oglas/error/errornoauth ' );
		
		}
	
	}

}

