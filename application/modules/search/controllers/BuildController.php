<?php

/**
 * SearchController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class Search_BuildController extends Search_Library_Controller_Action_Abstract {
	
	public function init() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$this->view->identity = $auth->getIdentity ();
		}
		$this->view->skin = 'MySkin';
	}

	public function buildAction() {
		// TODO Auto-generated SearchController::indexAction() default action
		// create the index
		$index = Zend_Search_Lucene::create ( APPLICATION_PATH . '/indexes' );
		// fetch all of the current pages
		$mdlOglas = new Oglas_Model_Oglas ();
		$currentOglas = $mdlOglas->getAllForSearch ();
		if (! $currentOglas == null) {
			
			// create a new search document for each page
			foreach ( $currentOglas as $key => $value ) {
				//foreach ( $value as $ke => $val ) {
				$oglas = $value;
				
				$doc = new Zend_Search_Lucene_Document ();
				// you use an unindexed field for the id because you want the id
				// to be included in the search results but not searchable
				$doc->addField ( Zend_Search_Lucene_Field::unIndexed ( 'id_oglasa', $oglas ["id_oglasa"] ) );
				// you use text fields here because you want the content to be searchable
				// and to be returned in search results
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_naslov', $oglas ["naslov"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_detalji', $oglas ["detalji"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_telefoni', $oglas ["telefoni"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_id_kategorije', $oglas ["id_kategorije"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_id_podkategorije', $oglas ["id_podkategorije"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_datum_kreiranja', substr ( $oglas ["datum_kreiranja"], 8, 2 ) . '-' . substr ( $oglas ["datum_kreiranja"], 5, 2 ) . "-" . substr ( $oglas ["datum_kreiranja"], 0, 4 ) ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_grad', $oglas ["grad"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_adresa', $oglas ["adresa"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_email', $oglas ["email"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_sajt', $oglas ["sajt"] ) );
				$doc->addField ( Zend_Search_Lucene_Field::text ( 'oglas_cena', $oglas ["cena"] ) );
				
				// add the document to the index
				$index->addDocument ( $doc );
			}
			//}
		

		}
		
		$index->optimize ();
		// pass the view data for reporting
		$this->view->indexSize = $index->numDocs ();
	}

}

