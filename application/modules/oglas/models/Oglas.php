<?php
require_once 'Zend/Db/Table/Abstract.php';
class Oglas_Model_Oglas extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'oglas';
	public function createOglas($id_kategorije, $id_podkategorije, $naslov, $datum_kreiranja, $grad, $ponuda_traznja, $adresa, $telefoni, $trajanje_oglasa, $email, $sajt, $cena, $valuta, $detalji, $ip_oglasivaca, $oglasivac, $glavna_slika, $slika_dva, $slika_tri, $slika_cetri, $proveren) {
		// create a new row
		$rowOglas = $this->createRow ();
		
		if ($rowOglas) {
			
			$rowOglas->id_kategorije = $id_kategorije;
			$rowOglas->id_podkategorije = $id_podkategorije;
			$rowOglas->naslov = $naslov;
			$rowOglas->datum_kreiranja = $datum_kreiranja;
			$rowOglas->grad = $grad;
			$rowOglas->ponuda_traznja = $ponuda_traznja;
			$rowOglas->adresa = $adresa;
			$rowOglas->telefoni = $telefoni;
			$rowOglas->trajanje_oglasa = $trajanje_oglasa;
			$rowOglas->email = $email;
			$rowOglas->sajt = $sajt;
			$rowOglas->cena = $cena;
			$rowOglas->valuta = $valuta;
			$rowOglas->detalji = $detalji;
			$rowOglas->ip_oglasivaca = $ip_oglasivaca;
			$rowOglas->oglasivac = $oglasivac;
			$rowOglas->glavna_slika = $glavna_slika;
			$rowOglas->slika_dva = $slika_dva;
			$rowOglas->slika_tri = $slika_tri;
			$rowOglas->slika_cetri = $slika_cetri;
			$rowOglas->proveren = $proveren;
			
			$rowOglas->save ();
			return $rowOglas;
		}
	}
	public function getOglas($id_oglasa) {
		$oglasModel = new self ();
		$select = $oglasModel->select ();
		$select->where ( 'id_oglasa = ?', $id_oglasa );
		return $oglasModel->fetchAll ( $select );
	}
	public function getAll($whereKriterijumi, $sortKriterijum) 
	{
	   $mdlKurs = new Oglas_Model_Kurs();
	   $dinar = $mdlKurs->getByValutaName("DIN");

	   if($dinar < 60 || $dinar > 200)
	      $dinar = 100;
		$select = $this->select ();
		foreach ( $whereKriterijumi as $key => $value ) 
		{
		   if($key == "cena")
		   {
		      switch ($value)
		      {
		         case '1':
		            $select->where ("( (cena <= '100' AND valuta = 'EUR') OR (cena <= '". (100 * $dinar) ."' AND valuta = 'DIN') )" );
		            break;
	            case '2':
	               $select->where ("( (cena >= '100' AND cena <= '200' AND valuta = 'EUR') OR (valuta = 'DIN' AND cena >= '". (100 * $dinar) ."' AND cena <= '". (200 * $dinar) ."') )");
		            break;
	            case '3':
	               $select->where ("( (cena >= '200' AND cena <= '500' AND valuta = 'EUR') OR (valuta = 'DIN' AND cena >= '". (200 * $dinar) ."' AND cena <= '". (500 * $dinar) ."') )");
		            break;
	            case '4':
	               $select->where ("( (cena >= '500' AND cena <= '1000' AND valuta = 'EUR') OR (valuta = 'DIN' AND cena >= '". (500 * $dinar) ."' AND cena <= '". (1000 * $dinar) ."'))");
		            break;
	            case '5':
	               $select->where ("( (cena >= '1000' AND valuta = 'EUR') OR (cena >= '". (1000 * $dinar) ."' AND valuta = 'DIN'))" );
		            break;
		      }
		      continue;
		   }
		   switch ($key)
		   {
		      case 'oblast':
		         $select->where ( "id_podkategorije = ?", $value );
		         break;
	         case 'email':
	            $select->where ( "email != ?", "$value" );
	            break;
	         case 'sajt':
	            $select->where ( "sajt != ?", "$value" );
	            break;
	         case 'slika':
	            $select->where ( "glavna_slika != ?", "/images/upload/slikeoglasa/NisOglasi.jpg" );
	            break;
	         default:
	            $select->where ( "$key = ?", $value );
		   }
		}

		$oglasModel = new self ();
		
		$datum = date ( "Y-m-d" , strtotime("-2 month")) ." 00:00:00";
      $select->where ( "datum_kreiranja >= ?", $datum );

      if( in_array( $sortKriterijum, array( "cena ASC", "cena DESC", "naslov" ) ) )
		   $select->order ( "$sortKriterijum" );
		else 
		   $select->order ( "datum_kreiranja DESC" );
		$adapter = new Zend_Paginator_Adapter_DbTableSelect ( $select );
		return $adapter;
	}
	public function getAllForAdmin($sortKriterijum) {
		
		$select = $this->select ();
		
		$oglasModel = new self ();
		
		$select->order ( "$sortKriterijum" );
		
		$adapter = new Zend_Paginator_Adapter_DbTableSelect ( $select );
		return $adapter;
	}
	public function getAllForUser($sortKriterijum, $id_usera) {
		
		$select = $this->select ();
		
		$oglasModel = new self ();
		$select->where ( "oglasivac = ?", $id_usera );
		
		$select->order ( "$sortKriterijum" );
		
		$adapter = new Zend_Paginator_Adapter_DbTableSelect ( $select );
		return $adapter;
	}
	public function getAllForSearch() {
		$oglasModel=new self ();
		
		$select = $this->select ();
		
		$select = $oglasModel->fetchAll ( $select );

		return $select;
	}
	public function updateOglas($id_oglasa, $id_kategorije, $id_podkategorije, $naslov, $grad, $ponuda_traznja, $adresa, $telefoni, $trajanje_oglasa, $email, $sajt, $cena, $valuta, $detalji, $glavna_slika, $slika_dva, $slika_tri, $slika_cetri, $proveren) {
		
		$rowOglas = $this->find ( $id_oglasa )->current ();
		
		if ($rowOglas) {
			// clear any cache records which are tagged to this oglas
			$cache = Zend_Registry::get ( 'cache' );
			$tag = 'oglas_' . $id_oglasa;
			$cache->clean ( Zend_Cache::CLEANING_MODE_MATCHING_TAG, array ($tag ) );
		}
		
		if ($rowOglas) {
			// update the row values
			$rowOglas->id_kategorije = $id_kategorije;
			$rowOglas->id_podkategorije = $id_podkategorije;
			$rowOglas->naslov = $naslov;
			$rowOglas->grad = $grad;
			$rowOglas->ponuda_traznja = $ponuda_traznja;
			$rowOglas->adresa = $adresa;
			$rowOglas->telefoni = $telefoni;
			$rowOglas->trajanje_oglasa = $trajanje_oglasa;
			$rowOglas->email = $email;
			$rowOglas->sajt = $sajt;
			$rowOglas->cena = $cena;
			$rowOglas->valuta = $valuta;
			$rowOglas->detalji = $detalji;
			$rowOglas->glavna_slika = $glavna_slika;
			$rowOglas->slika_dva = $slika_dva;
			$rowOglas->slika_tri = $slika_tri;
			$rowOglas->slika_cetri = $slika_cetri;
			$rowOglas->proveren = $proveren;
			
			$rowOglas->save ();
			
			return $rowOglas;
		}
	}
	
	public function deleteOglas($id_oglasa) {
		$rowUser = $this->find ( $id_oglasa )->current ();
		if ($rowUser) {
			$rowUser->delete ();
		}
	}
	public function kategorijeCount($id_kategorije) {
		$oglasModel = new self ();
		$select = $oglasModel->select ();
		$select->where ( "id_kategorije = ?", $id_kategorije );
		
	   $datum = date ( "Y-m-d" , strtotime("-2 month")) ." 00:00:00";
      $select->where ( "datum_kreiranja >= ?", $datum );
		
		$select->group ( "id_oglasa" );
		$select = $oglasModel->fetchAll ( $select );
		if ($select) {
			return count ( $select );
		}
	}
	public function countOglase() {
		$oglasModel = new self ();
		$select = $oglasModel->select ();
		
		$datum = date ( "Y-m-d" , strtotime("-2 month")) ." 00:00:00";
      $select->where ( "datum_kreiranja >= ?", $datum );
		
		$select->group ( "id_oglasa" );
		$select = $oglasModel->fetchAll ( $select );
		
		$count = array ();
		foreach ( $select as $key => $value ) {
			$count [$value->id_kategorije] ["kategorija"] = 0;
			$count [$value->id_podkategorije] ["kategorija"] = 0;
		}
		foreach ( $select as $key => $value ) {
			$count [$value->id_kategorije] ["kategorija"] ++;
			$count [$value->id_podkategorije] ["kategorija"] ++;
		}
		return $count;
	
	}
	
	public function getPrivileges($id_oglasa, $id_usera) {
		$oglasModel = new self ();
		$select = $oglasModel->select ();
		$select->where ( "id_oglasa = ?", $id_oglasa );
		$select->where ( "oglasivac = ?", $id_usera );
		$select = $oglasModel->fetchAll ( $select );
		if ($select->count () > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function podkategorijeCount($id_podkategorije) {
		$oglasModel = new self ();
		$select = $oglasModel->select ();
		$select->where ( "id_podkategorije = ?", $id_podkategorije );
		
		$datum = date ( "Y-m-d" , strtotime("-2 month")) ." 00:00:00";
      $select->where ( "datum_kreiranja >= ?", $datum );
		
		$select->group ( "id_oglasa" );
		$select = $oglasModel->fetchAll ( $select );

		if ($select) {
			return count ( $select );
		}
	}
	public function getAllEmails() {
		$oglasTempModel = new self ();
		$select = $oglasTempModel->select ();
		return $oglasTempModel->fetchAll ( $select );
	}

}