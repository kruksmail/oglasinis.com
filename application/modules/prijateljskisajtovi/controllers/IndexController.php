<?php
class Prijateljskisajtovi_IndexController extends Prijateljskisajtovi_Library_Controller_Action_Abstract {
	
	public function init() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$this->view->identity = $auth->getIdentity ();
		}
		$this->view->skin='MySkin';
	}
	
	public function indexAction() {
	
	}
	
	public function proveraAction() {
		
	
	}

}
