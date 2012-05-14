<?php
class Kategorija_IndexController extends Kategorija_Library_Controller_Action_Abstract
{
	public function init()
	{
		$this->view->skin = "mySkin";
	}
	public function indexAction()
	{
		$mdlOglas = new Oglas_Model_Oglas();
		$mdlKategorije = new Kategorija_Model_Glavnekategorije();
		$this->view->kategorije = $mdlKategorije->getKategorije();
		$mdlPodkategorije = new Kategorija_Model_Podkategorije();
		$this->view->podkategorije = null;
		$this->view->selector1 = $this->_request->getParam("kategorija");
		$this->view->selector2 = $this->_request->getParam("podkategorija");
		$this->view->oglasi = $mdlOglas;
		
		foreach($this->view->kategorije as $kategorija)
		{
			$podkategorije = $mdlPodkategorije->getPodkategorijeByKategorija($kategorija->id);
			if(NULL != $podkategorije)
			{	
				$this->view->podkategorije[$kategorija->name] = $podkategorije;
			} 	
		}
	}
	
	public function proveraAction()
	{
		$kategorija = $this->_request->getParam("kategorija");
		$podkategorija = $this->_request->getParam("podkategorija");
		$this->kategorije = NULL;
		$this->podkategorije = NULL;
		$mdlKategorije = new Kategorija_Model_Glavnekategorije();
		$kategorijeDb = $mdlKategorije->getKategorijeById($kategorija);
		$mdlPodkategorije = new Kategorija_Model_Podkategorije();
		$podkategorijeDb = $mdlPodkategorije->getPodkategorijeById($podkategorija);
		
		if(($kategorijeDb == NULL && $kategorija != NULL)
		 || ($podkategorijeDb == NULL && $podkategorija  != NULL)
		 || ($kategorija == NULL && $podkategorija  != NULL)
		 )
		{
			$this->view->error =  "Strana nije pronađena!";
		}
		else
		{
			$this->view->error = NULL;
		}
	}
	
	public function listaAction()
	{
		$mdlKategorije = new Kategorija_Model_Glavnekategorije();
		$this->view->rowsetObj = $mdlKategorije->getKategorije();
		
	}
}
