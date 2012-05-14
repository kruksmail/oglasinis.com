<?php
require_once 'Zend/Db/Table/Abstract.php';
class Oglas_Model_Trigger extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'emailtrigger';
	public function createTrigger($id_emaila, $trigger) {
		// create a new row
		$rowTrigger = $this->createRow ();
		
		if ($rowTrigger) {
			
			$rowTrigger->id_emaila = $id_emaila;
			$rowTrigger->naziv = $trigger;
			$rowTrigger->save ();
			return $rowTrigger;
		}
	}
	
	public function getTriggers($email) {
		$triggerModel = new self ();
		$select = $triggerModel->select ();
		$select->where ( "id_emaila= ?", $email );
		$all = $triggerModel->fetchAll ( $select );
		return $all;
	
	}
	
	public function deleteTrigger($id_triggera) {
		// fetch the user's row
		$rowTrigger = $this->find ( $id_triggera )->current ();
		if ($rowTrigger) {
			$rowTrigger->delete ();
		} else {
			throw new Zend_Exception ( "Could not delete user. User not found!" );
		}
	}

}