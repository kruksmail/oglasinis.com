<?php
require_once 'Zend/Db/Table/Abstract.php';
class Prijateljskisajtovi_Model_Prijateljskisajtovi extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'prijateljskisajtovi';
	public function createSajt($naslov, $email, $sajt, $opis, $slika) {
		// create a new row
		$rowSajt = $this->createRow ();
		
		if ($rowSajt) {
			// update the row values
			//$rowSajt->id_sajta = $id_sajta;
			$rowSajt->naslov = $naslov;
			$rowSajt->email = $email;
			$rowSajt->sajt = $sajt;
			$rowSajt->detalji = $opis;
			$rowSajt->slika = $slika;
			
			$rowSajt->save ();
			//return the new user
			return $rowSajt;
		} 
	}
	public function getSajt($id_sajta) {
		$sajtModel = new self ();
		$select = $sajtModel->select ();
		$select->where ( 'id_sajta = ?', $id_sajta );
		$select->order ( array ('naslov' ) );
		return $sajtModel->fetchAll ( $select );
	}
	public function getAll() {
		$sajtModel = new self ();
		$select = $sajtModel->select ();
		$select->order ( array ('sajt' ) );
		return $sajtModel->fetchAll ( $select );
	}
	public function updateSajt($id, $naslov, $email, $sajt, $detalji, $slika) {
		// fetch the user's row
		$rowSajt = $this->find ( $id )->current ();
		if ($rowSajt) {
			// update the row values
			$rowSajt->naslov = $naslov;
			$rowSajt->email = $email;
			$rowSajt->sajt = $sajt;
			$rowSajt->detalji = $detalji;
			$rowSajt->slika = $slika;
			
			$rowSajt->save ();
			
			return $rowSajt;
		}
	}
	
	public function deleteSajt($id_sajta) {
		$rowUser = $this->find ( $id_sajta )->current ();
		if ($rowUser) {
			$rowUser->delete ();
		}
	}

}