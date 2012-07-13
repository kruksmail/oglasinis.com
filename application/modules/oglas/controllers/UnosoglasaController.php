<?php

require_once APPLICATION_PATH . '/modules/oglas/library/Content/Item/OglasTemplate.php';

class Oglas_UnosoglasaController extends Oglas_Library_Controller_Action_Abstract {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		
		$this->view->headTitle ()->prepend ( 'Unos novog oglasa' );
		$kategorijaID = $this->_request->getParam ( "kategorija" );
		$imekatModel = new Kategorija_Model_Glavnekategorije ();
		$imekat = $imekatModel->getKategorijeById ( $kategorijaID )->name;
		$this->view->kategorija = $imekat;
		$this->view->kategorijaID = $kategorijaID;
		
		$podkategorijaID = $this->_request->getParam ( 'podkategorija' );
		$imepodkatModel = new Kategorija_Model_Podkategorije ();
		$imepodkat = $imepodkatModel->getPodkategorijeByID ( $podkategorijaID )->label;
		$this->view->podkategorija = $imepodkat;
		$this->view->podkategorijaID = $podkategorijaID;
		
		$sljakaKat = 0;
		
		if (isset ( $_SESSION ["kategorija"] [$imekat] ) && isset ( $_SESSION ["podkategorija"] [$imepodkat] ) && $_SESSION ["kategorija"] [$imekat] == $imekat && $_SESSION ["podkategorija"] [$imepodkat] == $imepodkat) {
			$sljakaKat = 1;
		} else {
			$this->_redirect ( 'oglas/unosoglasa/odabirkategorije' );
		}
		if ($sljakaKat == 1) {
			
			$formaUnosOglasa = new Oglas_Form_Oglas ();
			$formaUnosOglasa->removeElement ( 'id_kategorije' );
			$formaUnosOglasa->removeElement ( 'id_podkategorije' );
			$formaUnosOglasa->removeElement ( 'proveren' );
			$this->view->form = $formaUnosOglasa;
			if ($this->getRequest ()->isPost ()) {
				if ($formaUnosOglasa->isValid ( $_POST )) {
					$itemOglas = new Oglas_Model_Oglas ();
					
					$id_kategorija = $kategorijaID;
					
					$id_podkategorija = $podkategorijaID;
					
					$ponuda_traznja = $formaUnosOglasa->getValue ( 'ponudatraznja' );
					
					$naslov = $formaUnosOglasa->getValue ( 'naslov' );
					
					$dateTemp = new DateTime ( "", new DateTimeZone ( 'Europe/Belgrade' ) );
					$datum = date ( $dateTemp->format ( 'Y-m-d H:i:s' ) );
					$datum_kreiranja = $datum;
					
					$proveren = "NE";
					
					if (isset ( $_SERVER ["REMOTE_ADDR"] )) {
						$ip .= $_SERVER ["REMOTE_ADDR"] . ' ';
					} else if (isset ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
						$ip .= $_SERVER ["HTTP_X_FORWARDED_FOR"] . ' ';
					} else if (isset ( $_SERVER ["HTTP_CLIENT_IP"] )) {
						$ip .= $_SERVER ["HTTP_CLIENT_IP"] . ' ';
					}
					
					$ip_oglasivaca = $ip;
					
					$grad = $formaUnosOglasa->getValue ( 'grad' );
					
					$adresa = $formaUnosOglasa->getValue ( 'adresa' );
					
					$telefoni = $formaUnosOglasa->getValue ( 'telefoni' );
					
					$dateTemp = new DateTime ( "", new DateTimeZone ( 'Europe/Belgrade' ) );
					$date = strtotime ( "+60 day", strtotime ( date ( $dateTemp->format ( 'd-m-Y' ) ) ) );
					$datum = date ( "Y-m-d", $date );
					$trajanje_oglasa = $datum;
					
					$email = $formaUnosOglasa->getValue ( 'email' );
					
					$sajt = $formaUnosOglasa->getValue ( 'sajt' );
					
					$cena = $formaUnosOglasa->getValue ( 'cena' );
					
					$valuta = $formaUnosOglasa->getValue ( 'valuta' );
					
					$detalji = $formaUnosOglasa->getValue ( 'detalji' );
					$auth = Zend_Auth::getInstance ();
					if ($auth->hasIdentity ()) {
						$oglasivac = $auth->getIdentity ()->id;
					
					} else {
						$oglasivac = "Oglasivac- " . $formaUnosOglasa->getValue ( 'oglasivac' );
					}
					
					//upload the image
					$i = 0;
					for($m = 0; $m < 4; $m ++) {
						$slika [$m] == null;
					}
					
					if ($formaUnosOglasa->glavnaslika->isUploaded ()) {
						$formaUnosOglasa->glavnaslika->receive ();
						
						$img_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->glavnaslika->getFileName () );
						$new_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->glavnaslika->getFileName () );
						
						$new_filename = $new_filename . ".thumb.jpg";
						
						$this->convertImage($img_filename, $new_filename);
						
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->glavnaslika->getFileName () );
						$i++;
					}
					if ($formaUnosOglasa->slika2->isUploaded ()) {
						$formaUnosOglasa->slika2->receive ();
						
						$img_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika2->getFileName () );
                  $new_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika2->getFileName () );
						
                  $new_filename = $new_filename . ".thumb.jpg";
						
					   $this->convertImage($img_filename, $new_filename);
						
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika2->getFileName () );
						$i++;
					}
					if ($formaUnosOglasa->slika3->isUploaded ()) {
						$formaUnosOglasa->slika3->receive ();
					
						$img_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika3->getFileName () );
                  $new_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika3->getFileName () );
						
                  $new_filename = $new_filename . ".thumb.jpg";
                  
					   $this->convertImage($img_filename, $new_filename);
						
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika3->getFileName () );
						$i++;
					}
					if ($formaUnosOglasa->slika4->isUploaded ()) {
						$formaUnosOglasa->slika4->receive ();
						
						$img_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika4->getFileName () );
                  $new_filename = APP_PUBLIC . '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika4->getFileName () );
						
                  $new_filename = $new_filename . ".thumb.jpg";
                  
						$this->convertImage($img_filename, $new_filename);
						
						$slika [$i] = '/images/upload/slikeoglasa/' . basename ( $formaUnosOglasa->slika4->getFileName () );
						$i++;
					}
					//$_SESSION ["slika"] = $slika;
					
					if (! isset ( $slika [0] )) {
						$glavna_slika = '/images/upload/slikeoglasa/NisOglasi.jpg';
					} else {
						$glavna_slika = $slika [0];
					}
					if (! isset ( $slika [1] )) {
						$slika_dva = '/images/upload/slikeoglasa/NisOglasi.jpg';
					} else {
						$slika_dva = $slika [1];
					}
					if (!isset($slika [2])) {
						$slika_tri = '/images/upload/slikeoglasa/NisOglasi.jpg';
					} else {
						$slika_tri = $slika [2];
					}
					if (!isset($slika [3] )) {
						$slika_cetri = '/images/upload/slikeoglasa/NisOglasi.jpg';
					} else {
						$slika_cetri = $slika [3];
					}
					
					unset ( $_SESSION ["kategorija"] [$imekat] );
					unset ( $_SESSION ["podkategorija"] [$imepodkat] );
					// save the content item
					$itemOglas->createOglas ( $id_kategorija, $id_podkategorija, $naslov, $datum_kreiranja, $grad, $ponuda_traznja, $adresa, $telefoni, $trajanje_oglasa, $email, $sajt, $cena, $valuta, $detalji, $ip_oglasivaca, $oglasivac, $glavna_slika, $slika_dva, $slika_tri, $slika_cetri, $proveren );
					return $this->_redirect ( 'oglasi' );
				
				}
			}
		}
	
	}
	public function renderkategorijeAction() {
		$katID = $this->_request->getParam ( "kat" );
		$mdlTempKategorije = new Kategorija_Model_Glavnekategorije ();
		$kat = $mdlTempKategorije->getKategorijeById ( $katID )->name;
		$this->view->kat = $kat;
		
		$mdlKategorije = new Kategorija_Model_Glavnekategorije ();
		$this->view->kategorije = $mdlKategorije->getKategorije ();
		$mdlPodkategorije = new Kategorija_Model_Podkategorije ();
		$this->view->podkategorije = null;
		foreach ( $this->view->kategorije as $kategorija ) {
			if ($kat == $kategorija->name) {
				$podkategorije = $mdlPodkategorije->getPodkategorijeByKategorija ( $katID );
				if (NULL != $podkategorije) {
					$this->view->podkategorije [$kategorija->name] = $podkategorije;
				} else {
					echo "<option value='0' label='Nema podkategorije'>Nema podkategorije</option>";
				}
			}
		
		}
	
	}
	public function odabirkategorijeAction() {
		$this->view->headTitle ()->prepend ( 'Unos novog oglasa' );
		unset ( $_SESSION ["kategorija"] );
		$mdlKategorije = new Kategorija_Model_Glavnekategorije ();
		$this->view->kategorije = $mdlKategorije->getKategorije ();
		$mdlPodkategorije = new Kategorija_Model_Podkategorije ();
		
		$this->view->podkategorije = null;
		
		foreach ( $this->view->kategorije as $kategorija ) {
			$_SESSION ["kategorija"] [$kategorija->name] = $kategorija->name;
			$podkategorije = $mdlPodkategorije->getPodkategorijeByKategorija ( $kategorija->id );
			if (NULL != $podkategorije) {
				$this->view->podkategorije [$kategorija->name] = $podkategorije;
			}
		}
	}
	
	private function convertImage($img_filename, $new_filename)
	{
	   if(!is_file($img_filename))
	   {
	      print "Error: $img_filename is not file!<br>";
	      return false;
	   }
	      
      list($width, $height) = getimagesize($img_filename);
      $newwidth = 80;
      $newheight = 80;
      // Load
      $thumb = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefromjpeg($img_filename);
      
      // Resize
      $ret = imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
      if(!$ret)
         return false;
         
      return imagejpeg($thumb, $new_filename);
      
	}

}

