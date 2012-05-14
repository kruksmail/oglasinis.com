<?php

/**
 * izmenaOglasaController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Oglas_GuestController extends Oglas_Library_Controller_Action_Abstract {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
	
	}
	public function deactivateallnotificationAction() {
		$unsecure_stamp = $this->_request->getParam ( 'id' );
		
		$email = new Oglas_Model_Emailnotification ();
		$id_emaila = $email->checkMailIdentiti ( $unsecure_stamp );
		if ($id_emaila > 0) {
			$email->updateStatus ( $id_emaila, "nista" );
			$triggerModel = new Oglas_Model_Trigger ();
			$triggers = $triggerModel->getTriggers ( $id_emaila );
			foreach ( $triggers as $key => $value1 ) {
				$triggerModel->deleteTrigger ( $value1 ['id_emailtriggera'] );
			
			}
			$this->view->obavestenje = "Uspešno ste deaktivirali slanje svih obaveštenja";
		} else {
			return $this->_redirect ( 'oglas/error/errornoauth' );
		}
	
	}
	public function customnotificationAction() {
		$unsecure_stamp = $this->_request->getParam ( 'id' );
		//echo $unsecure_stamp;
		$email = new Oglas_Model_Emailnotification ();
		$id_emaila = $email->checkMailIdentiti ( $unsecure_stamp );
		if ($id_emaila > 0) {
			$forma = new Oglas_Form_Customnotification ();
			$this->view->forma = $forma;
			
			if ($this->getRequest ()->isPost ()) {
				if ($forma->isValid ( $_POST )) {
					$email->updateStatus ( $id_emaila, "custom" );
					$mulitiCheckBox = $forma->getValue ( 'trigeri' );
					//if (! $mulitiCheckBox == null) {
					$triggerModel = new Oglas_Model_Trigger ();
					$triggers = $triggerModel->getTriggers ( $id_emaila );
					foreach ( $triggers as $key => $value1 ) {
						$triggerModel->deleteTrigger ( $value1 ['id_emailtriggera'] );
					
					}
					foreach ( $mulitiCheckBox as $key => $value ) {
						
						$triggerModel->createTrigger ( $id_emaila, $value );
					
					}
					//}
					return $this->_redirect ( 'oglas/guest/confirm' );
				}
			}
		
		} else {
			return $this->_redirect ( 'oglas/error/errornoauth' );
		}
	
	}
	public function confirmAction() {
	
	}

}

