<?php
class Oglas_IndexController extends Oglas_Library_Controller_Action_Abstract 
{
	public function init() 
	{
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) 
		{
			$this->view->identity = $auth->getIdentity ();
		}
	}

	public function indexAction() 
	{
		$this->view->kategorija = $this->_request->getParam ( "kategorija" );
		$this->view->podkategorija = $this->_request->getParam ( 'podkategorija' );
		$oglasID = $this->_request->getParam ( "oglas" );
		$this->view->oglas = $oglasID;
		$page = $this->_request->getParam ( "page" );
		$this->view->page = $page;
	}

	public function proveraAction() 
	{
	}
	
	public function mainprikazAction() 
	{
		$this->view->headMeta ()->prependName ( "Description", "Besplatni mali oglasi Niš. Svi niški oglasi na jednom mestu. Pronadjite, kupite, prodajte" );
		$searchForm = new Oglas_Form_Search ();
		$this->view->headTitle ()->append ( 'Besplatni mali oglasi Niš. Svi niški oglasi na jednom mestu' );
		$oglasModel = new Oglas_Model_Oglas ();
		$countModel = new Oglas_Model_Oglas ();
		$count = $countModel->countOglase ();
		$sortKriterijum = null;
		$page = $this->_request->getParam ( 'page' );
		
		$kategorijeModel = new Kategorija_Model_Glavnekategorije();
      foreach ($kategorijeModel->getKategorije() as $katRow)
      {
        $kategorije[$katRow["id"]] = $katRow["name"];
      }
      $podkategorijaModel = new Kategorija_Model_Podkategorije();
      foreach ($podkategorijaModel->getPodkategorije() as $podkatRow)
      {
        $podkategorije[$podkatRow["id"]] = $podkatRow["label"];
      }

      unset($params);
      unset($whereKriterijumi1);
      if ($this->getRequest ()->isPost ()) 
      {
         if ($searchForm->isValid ( $_POST )) 
         {
         	$whereKriterijumi1 ['ponuda_traznja'] = $searchForm->getValue ( 'ponudatraznja' );
         	$whereKriterijumi1 ['grad'] = $searchForm->getValue ( 'grad' );
            $whereKriterijumi1 ['cena'] = $searchForm->getValue ( 'cena' ); 
            
            $params['ponuda_traznja'] = $searchForm->getValue ( 'ponudatraznja' );
            $params['grad'] = $searchForm->getValue ( 'grad' );
            $params['cena'] = $searchForm->getValue ( 'cena' );
            $params['sort'] = $searchForm->getValue ( 'sort' );
            
            $sortKriterijum = $searchForm->getValue ( 'sort' );           	
            $page = 1;
         }
		}
		else 
		{
		   $params = Zend_Controller_Front::getInstance ()->getRequest ()->getParams ();
		   if($params['cena'])
		   {
		      $searchForm->getElement ( 'cena' )->setValue ( $params['cena'] );
		      $whereKriterijumi1 ['cena'] = $params['cena'];
		   }
			if($params['ponuda_traznja'])
			{
			   $searchForm->getElement ( 'ponudatraznja' )->setValue ( $params['ponudatraznja'] );
			   $whereKriterijumi1 ['ponuda_traznja'] = $params['ponuda_traznja'];
			}
			if($params['grad'])
			{
			   $searchForm->getElement ( 'grad' )->setValue ( $params['grad'] );
			   $whereKriterijumi1 ['grad'] = $params['grad'];
			}
			if($params['sort'])
			{
			   $sortKriterijum = $params['sort'];
			   $searchForm->getElement ( 'sort' )->setValue ( $params['sort'] );
			}
		}
		unset($whereKriterijumi);
		if (isset ( $whereKriterijumi1 )) {
			foreach ( $whereKriterijumi1 as $key => $value ) {
				if ( $value ) {
					$whereKriterijumi [$key] = $value;
				}
			}
		}
		
		$this->view->params = $params;
		
		$adapter = $oglasModel->getAll ( $whereKriterijumi, $sortKriterijum );

		$paginator = new Zend_Paginator ( $adapter );
		$paginator->setItemCountPerPage ( 10 );

		$paginator->setCurrentPageNumber ( $page );
		$this->view->paginator = $paginator;

		$this->view->searchForm = $searchForm;
		
		$this->view->kategorije = $kategorije;
		$this->view->podkategorije = $podkategorije;
	}
	public function kategorijaprikazAction() 
	{
		$kategorija = $this->_request->getParam ( "kategorija" );
		$imekatModel = new Kategorija_Model_Glavnekategorije ();
		$imekat = $imekatModel->getKategorijeById ( $kategorija )->name;
		$this->view->kategorija = $imekat;
		$this->view->kategorijaID = $kategorija;
		$oglasID = $this->_request->getParam ( "oglas" );
		$this->view->oglas = $oglasID;
		$sortKriterijum = null;
		$this->view->headMeta ()->prependName ( "Description", $imekat . " - Besplatni mali oglasi Niš. Svi niški oglasi na jednom mestu. Dodjite, pronadjite, kupite, prodajte" );

		$kategorijeModel = new Kategorija_Model_Glavnekategorije();
      foreach ($kategorijeModel->getKategorije() as $katRow)
      {
        $kategorije[$katRow["id"]] = $katRow["name"];
      }
      $podkategorijaModel = new Kategorija_Model_Podkategorije();
      foreach ($podkategorijaModel->getPodkategorije() as $podkatRow)
      {
        $podkategorije[$podkatRow["id"]] = $podkatRow["label"];
      }
		$this->view->kategorije = $kategorije;
		$this->view->podkategorije = $podkategorije;
		
		$page = $this->_request->getParam ( 'page' );
		$searchForm = new Oglas_Form_Search ($kategorija);
		$oglasModel = new Oglas_Model_Oglas ();
		$oglasModelCount = new Oglas_Model_Oglas ();
		$whereKriterijumi = array ();
		$whereKriterijumi ["id_kategorije"] = $kategorija;
		
		unset($params);
		if ($this->getRequest ()->isPost ()) 
		{
			if ($searchForm->isValid ( $_POST )) 
			{
				$whereKriterijumi1 ['ponuda_traznja'] = $searchForm->getValue ( 'ponudatraznja' );
				$whereKriterijumi1 ['grad'] = $searchForm->getValue ( 'grad' );
				$whereKriterijumi1 ['cena'] = $searchForm->getValue ( 'cena' );
				$whereKriterijumi1 ['oblast'] = $searchForm->getValue ( 'oblast' );
				$sortKriterijum = $searchForm->getValue ( 'sort' );
				
				$params['ponuda_traznja'] = $searchForm->getValue ( 'ponudatraznja' );
				$params['grad'] = $searchForm->getValue ( 'grad' );
            $params['cena'] = $searchForm->getValue ( 'cena' );
            $params['sort'] = $searchForm->getValue ( 'sort' );
            $params['oblast'] = $searchForm->getValue ( 'oblast' );
				$page = 1;			
			}
		} 
		else 
		{
		   $params = Zend_Controller_Front::getInstance ()->getRequest ()->getParams ();
		   if($params['cena'])
		   {
		      $searchForm->getElement ( 'cena' )->setValue ( $params['cena'] );
		      $whereKriterijumi1 ['cena'] = $params['cena'];
		   }
		   if($params['oblast'])
		   {
		      $searchForm->getElement ( 'oblast' )->setValue ( $params['oblast'] );
			   $whereKriterijumi1 ['oblast'] = $params['oblast'];
		   }
			if($params['ponuda_traznja'])
			{
			   $searchForm->getElement ( 'ponudatraznja' )->setValue ( $params['ponuda_traznja'] );
			   $whereKriterijumi1 ['ponuda_traznja'] = $params['ponuda_traznja'];
			}
			if($params['grad'])
			{
			   $searchForm->getElement ( 'grad' )->setValue ( $params['grad'] );
			   $whereKriterijumi1 ['grad'] = $params['grad'];
			}
			if($params['sort'])
			{
			   $sortKriterijum = $params['sort'];
			   $searchForm->getElement ( 'sort' )->setValue ( $params['sort'] );
			}
		}
		if (isset ( $whereKriterijumi1 )) {
			foreach ( $whereKriterijumi1 as $key => $value ) {
				if ($value) {
					$whereKriterijumi [$key] = $value;
				}
			}
		}

		$this->view->params = $params;
		
		$adapter = $oglasModel->getAll ( $whereKriterijumi, $sortKriterijum );

		$paginator = new Zend_Paginator ( $adapter );
		$paginator->setItemCountPerPage ( 10 );
		
		$paginator->setCurrentPageNumber ( $page );
		$this->view->paginator = $paginator;
		$this->view->searchForm = $searchForm;

		$this->view->headTitle ()->append ( $imekat . '- Besplatni mali oglasi Niš. Svi niški oglasi na jednom mestu' );
	}
	/*
	public function kategorijapodkategorijaprikazAction() {
		$kategorijaID = $this->_request->getParam ( "kategorija" );
		$imekatModel = new Kategorija_Model_Glavnekategorije ();
		$imekat = $imekatModel->getKategorijeById ( $kategorijaID )->name;
		$this->view->kategorija = $imekat;
		$this->view->kategorijaID = $kategorijaID;
		$oglasID = $this->_request->getParam ( "oglas" );
		$this->view->oglas = $oglasID;
      $page = $this->_request->getParam ( 'page' );
				
		$kategorijeModel = new Kategorija_Model_Glavnekategorije();
        foreach ($kategorijeModel->getKategorije() as $katRow)
        {
           $kategorije[$katRow["id"]] = $katRow["name"];
        }
        $podkategorijaModel = new Kategorija_Model_Podkategorije();
        foreach ($podkategorijaModel->getPodkategorije() as $podkatRow)
        {
           $podkategorije[$podkatRow["id"]] = $podkatRow["label"];
        }
		$this->view->kategorije = $kategorije;
		$this->view->podkategorije = $podkategorije;
		
		$podkategorijaID = $this->_request->getParam ( 'podkategorija' );
		$imepodkatModel = new Kategorija_Model_Podkategorije ();
		$imepodkat = $imepodkatModel->getPodkategorijeByID ( $podkategorijaID )->label;
		$this->view->podkategorija = $imepodkat;
		$this->view->podkategorijaID = $podkategorijaID;
		$this->view->headMeta ()->prependName ( "Description", $imepodkat . " - " . $imekat. " - Besplatni mali oglasi Niš. Svi niški oglasi na jednom mestu. Dodjite, pronadjite, kupite, prodajte" );

		$this->view->headTitle ()->append ( $imepodkat . '-' . $imekat . '- Besplatni mali oglasi Niš. Svi niški oglasi na jednom mestu' );
		$sortKriterijum = null;
		$searchForm = new Oglas_Form_Search ();
		$oglasModel = new Oglas_Model_Oglas ();
		$whereKriterijumi = array ();
		$whereKriterijumi ["id_kategorije"] = $kategorijaID;
		$whereKriterijumi ["id_podkategorije"] = $podkategorijaID;
		if ($this->getRequest ()->isPost ()) 
		{
			if ($searchForm->isValid ( $_POST )) 
			{
				$whereKriterijumi1 ['ponuda_traznja'] = $searchForm->getValue ( 'ponudatraznja' );
				$whereKriterijumi1 ['grad'] = $searchForm->getValue ( 'grad' );			
				$whereKriterijumi1 ['cena'] = $searchForm->getValue ( 'cena' );
				$page = 1;	
			}
		} else {

		}
		if (isset ( $whereKriterijumi1 )) {
			foreach ( $whereKriterijumi1 as $key => $value ) {
				if ($value) {
					$whereKriterijumi [$key] = $value;
				}
			}
		}

		$sortKriterijum = $searchForm->getValue ( 'sort' );
		$adapter = $oglasModel->getAll ( $whereKriterijumi, $sortKriterijum );

		$paginator = new Zend_Paginator ( $adapter );
		$paginator->setItemCountPerPage ( 10 );
		
		$paginator->setCurrentPageNumber ( $page );
		$this->view->paginator = $paginator;
		$this->view->searchForm = $searchForm;

	}
	*/
	public function openAction() 
	{
		$kategorijaID = $this->_request->getParam ( "kategorija" );
		$imekatModel = new Kategorija_Model_Glavnekategorije ();
		$imekat = $imekatModel->getKategorijeById ( $kategorijaID )->name;
		$this->view->kategorija = $imekat;

		$oglasID = $this->_request->getParam ( "oglas" );
		$this->view->oglas = $oglasID;

		$podkategorijaID = $this->_request->getParam ( 'podkategorija' );
		$imepodkatModel = new Kategorija_Model_Podkategorije ();
		if (isset ( $podkategorijaID )) {
			$imepodkat = $imepodkatModel->getPodkategorijeByID ( $podkategorijaID )->label;
			$this->view->podkategorija = $imepodkat;
		}

		$oglasID = $this->_request->getParam ( "oglas" );
		$this->_request->getParam ( "oglas" );

		//cache
		$bootstrap = $this->getInvokeArg ( 'bootstrap' );
		$cache = $bootstrap->getResource ( 'cache' );
		$cacheKey = 'sadrzajoglasa_' . $oglasID;
		$oglasCacheResult = $cache->load ( $cacheKey );

		if (! $oglasCacheResult) {
			$oglasModel = new Oglas_Model_Oglas ();
			$oglasCacheResult = $oglasModel->getOglas ( $oglasID );
			$tags [] = 'oglas_' . $oglasCacheResult [0]->id_oglasa;
			$cache->save ( $oglasCacheResult, $cacheKey, $tags );
		}
		$this->view->headTitle ()->append ( $oglasCacheResult [0]->naslov );
		$this->view->headMeta ()->prependName ( "Description", $oglasCacheResult [0]->detalji );

		$this->view->title = $oglasCacheResult [0]->naslov;
		$this->view->oglas = $oglasCacheResult;
	}
}
