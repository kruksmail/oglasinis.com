<?php

/**
 * SearchController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Search_SearchController extends Search_Library_Controller_Action_Abstract {
	
	public function init() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$this->view->identity = $auth->getIdentity ();
		}
		$this->view->skin = 'MySkin';
	}
	public function indexAction() {
		if ($this->_request->isPost ()) {
			$keywords = $this->_request->getParam ( 'query' );
			$query = Zend_Search_Lucene_Search_QueryParser::parse ( $keywords );
			$index = Zend_Search_Lucene::open ( APPLICATION_PATH . '/indexes' );
			$hits = $index->find ( $query );
			$this->view->results = $hits;
			$this->view->keywords = $keywords;
		} else {
			$this->view->results = null;
		}
	}


}

