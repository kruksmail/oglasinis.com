<?php

/**
 * SearchController
 *
 * @author
 * @version
 */

require_once 'Zend/Controller/Action.php';

class Search_IndexController extends Search_Library_Controller_Action_Abstract {

	public function init() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$this->view->identity = $auth->getIdentity ();
		}
		$this->view->skin = 'MySkin';
	}
	public function indexAction() {
		$searchForm= new Search_Form_Fastsearch();
		$searchForm->setAction ('search/search/index');
		$this->view->searchform=$searchForm;

	}


}

