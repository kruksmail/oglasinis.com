<?php
require_once 'Zend/Db/Table/Abstract.php';
class Oglas_Model_Emailnotification extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'emailnotification';
	public function createEmail($email, $namespace) {
		// create a new row
		$rowEmail = $this->createRow ();
		
		if ($rowEmail) {
			
			$rowEmail->email = $email;
			$rowEmail->from_table = $namespace;
			$rowEmail->status_slanja = "sve";
			
			$rowEmail->save ();
			return $rowEmail;
		}
	}
	public function createUnsecureStamp($id_email, $email) {
		$rowEmail = $this->find ( $id_email )->current ();
		
		if ($rowEmail) {
			$rowEmail->unsecure_stamp = md5 ( $id_email . $email );
			$rowEmail->save ();
			return $rowEmail;
		} else {
			return NULL;
		}
	}
	public function createSecureStamp($id_email, $unsecure_stamp) {
		$rowEmail = $this->find ( $id_email )->current ();
		
		if ($rowEmail) {
			$rowEmail->secure_stamp = md5 ( $id_email . $unsecure_stamp );
			$rowEmail->save ();
			return $rowEmail;
		} else {
			return NULL;
		}
	}
	public function createFullEmail($email, $namespace) {
		$emailModel = $this->createEmail ( $email, $namespace );
		$id_emaila = $emailModel->id_emaila;
		$email = $emailModel->email;
		$emailModel1 = $this->createUnsecureStamp ( $id_emaila, $email );
		$id_emaila = $emailModel1->id_emaila;
		$unsecure_stamp = $emailModel1->unsecure_stamp;
		$this->createSecureStamp ( $id_emaila, $unsecure_stamp );
	
	}
	
	public function checkEmail($email) {
		$emailModel = new self ();
		$select = $emailModel->select ();
		$select->where ( "email= ?", $email );
		$all = $emailModel->fetchAll ( $select );
		return $all->count ();
	
	}
	public function countAllEmails() {
		$emailModel = new self ();
		$select = $emailModel->select ();
		$all = $emailModel->fetchAll ( $select );
		return $all->count ();
	
	}
	public function countSvimaNotification() {
		$emailModel = new self ();
		$select = $emailModel->select ();
		$select->where ( "status_slanja= ?", "sve" );
		$all = $emailModel->fetchAll ( $select );
		return $all->count ();
	
	}
	public function countNistaNotification() {
		$emailModel = new self ();
		$select = $emailModel->select ();
		$select->where ( "status_slanja= ?", "nista" );
		$all = $emailModel->fetchAll ( $select );
		return $all->count ();
	
	}
	public function countCustomNotification() {
		$emailModel = new self ();
		$select = $emailModel->select ();
		$select->where ( "status_slanja= ?", "custom" );
		$all = $emailModel->fetchAll ( $select );
		return $all->count ();
	
	}
	public function checkMailIdentiti($unsecure_stamp) {
		$emailModel = new self ();
		$select = $emailModel->select ();
		$select->where ( "unsecure_stamp= ?", $unsecure_stamp );
		$all = $emailModel->fetchAll ( $select );
		
		if (count ( $all )) {
			if ($all [0]->secure_stamp == md5 ( $all [0]->id_emaila . $unsecure_stamp )) {
				return $all [0]->id_emaila;
			
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	
	}
	public function updateStatus($id_emaila, $status) {
		$rowEmail = $this->find ( $id_emaila )->current ();
		if ($rowEmail) {
			// update the row values
			$rowEmail->status_slanja = $status;
			
			$rowEmail->save ();
			//return the updated user
			return $rowEmail;
		} else {
			throw new Zend_Exception ( "Nije moguce izvrsiti unos!!!!" );
		}
	
	}

}