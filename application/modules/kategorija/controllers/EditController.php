<?php
class Kategorija_EditController extends Kategorija_Library_Controller_Action_Abstract
{
	public function init()
	{
		$this->view->skin = "mySkin";
		//$this->view->headTitle("Vlasotince Online");
		$this->view->headTitle()->setSeparator(' - ');
		$this->view->adminExpand = TRUE;
	}
	
	public function indexAction()
	{
		
	}
	
	public function listkategorijaAction()
	{
		
		$this->view->headTitle("Kategorije");
		$mdlKategorija = new Kategorija_Model_Glavnekategorije();
		$this->view->kategorije = $mdlKategorija->getKategorije();
	}
	
	public function listpodkategorijaAction()
	{
		$this->view->headTitle("Podkategorije");
		$mdlKategorija = new Kategorija_Model_Glavnekategorije();
		$mdlPodkategorija = new Kategorija_Model_Podkategorije();
		$this->view->kategorije = $mdlKategorija;
		$this->view->podkategorije = $mdlPodkategorija->getPodkategorije();	
	}
		
	public function createkategorijaAction()
	{
		$frmKategorija = new Kategorija_Form_Kategorija();
		$this->view->headTitle("Dodavanje nove kategorije");
		$mdlKategorija = new Kategorija_Model_Glavnekategorije();
		if($this->getRequest()->isPost())        
	    {       
	        if($frmKategorija->isValid($_POST))        
	        {        
	        	$Name = $frmKategorija->getValue('name');        
	        	$result = $mdlKategorija->createKategorije($Name);       
	        	if($result)       
	       		{    
			       	return $this->_redirect('/kategorija/edit/listkategorija');  
	       		}             
	       	}        
	   	}
	   	$frmKategorija->setAction($this->view->baseUrl(). '/kategorija/edit/createkategorija');
		$this->view->form = $frmKategorija;    
	}
	
	public function createpodkategorijaAction()
	{
		$this->view->headTitle("Dodavanje nove podkategorije");
		$frmPodkategorija = new Kategorija_Form_Podkategorija();
		$mdlKategorija = new Kategorija_Model_Glavnekategorije();
		$kategorije = $mdlKategorija->getKategorije();
		$mdlPodkategorija = new Kategorija_Model_Podkategorije();
		$id = $this->_request->getParam("id");
		if($this->getRequest()->isPost())        
	    {       
	      	if($frmPodkategorija->isValid($_POST))        
	       	{        
	       		$label = $frmPodkategorija->getValue('label');    
	       		$link = $frmPodkategorija->getValue('link');       
	       		$kat = $frmPodkategorija->getValue('kategorija');   
	       		if($kat == "nedefinisano" || !is_numeric($kat))
	       		{
	       			$kat = NULL;
	       		}
	       		$this->view->result = $mdlPodkategorija->createPodkategorije($kat,$label,NULL,$link);          
		       	if($this->view->result)       
		       	{    
				   	return $this->_redirect('/kategorija/edit/listpodkategorija');  
		       	}             
	       	}        
	    }
	   
		$mutliOptArray = array('nedefinisano' => 'Nedefinisano');
		if(isset($kategorije) &&  $kategorije != false)
		{
			foreach($kategorije as $kategorija)
			{
				$mutliOptArray += array($kategorija->id => $kategorija->name);
			}
		}
		$frmPodkategorija->getElement('kategorija')->setMultiOptions($mutliOptArray);
		$frmPodkategorija->getElement('kategorija')->setRequired(TRUE);
	         
		$frmPodkategorija->setAction($this->view->baseUrl(). '/kategorija/edit/createpodkategorija');
		$this->view->form = $frmPodkategorija;
	}
	
	public function deletekategorijaAction()
	{
		$id = $this->_request->getParam("id");
		$mdlKategorija = new Kategorija_Model_Glavnekategorije();
		$result = $mdlKategorija->deleteKategorije($id);
	    if($result)
	    {
			return $this->_redirect('/kategorija/edit/listkategorija'); 
	    }
	}
	
	public function deletepodkategorijaAction()
	{
		$id = $this->_request->getParam("id");
		$mdlPodkategorija = new Kategorija_Model_Podkategorije();
		$result = $mdlPodkategorija->deletePodkategorije($id);	
		if($result)
	    {
			return $this->_redirect('/kategorija/edit/listpodkategorija'); 
	    }
	}
	
	public function kategorijaAction()
	{
		$frmKategorija = new Kategorija_Form_Kategorija();
		$frmKategorija->getElement('name')->removeValidator('Zend_Validate_Db_NoRecordExists');
		$id = $this->_request->getParam("id");
		
		$validator = new Zend_Validate_Db_NoRecordExists(
		array(
		        'table' => 'kategorije',
		        'field' => 'name',
		   		'exclude' => array('field' => 'id', 'value' => $id)
		));
		
		$validator->setMessage("Kategorija '%value%' postoji! Morate uneti drugu ime za kategoriju!",Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND);
			
		$frmKategorija->getElement('name')->addValidator($validator);
		$mdlKategorija = new Kategorija_Model_Glavnekategorije();
		
		if($this->getRequest()->isPost())        
	    {       
	        if($frmKategorija->isValid($_POST))        
	        {        
	        	$Name = $frmKategorija->getValue('name');        
	        	$result = $mdlKategorija->updateKategorije($id, $Name);       
	        	if($result)       
	        	{     
				  	return $this->_redirect('/kategorija/edit/listkategorija');                
	        	} 
	        }     
		}
		else
		{
			$currentKat = $mdlKategorija->find($id)->current();
			$frmKategorija->populate($currentKat->toArray());
		}
		$frmKategorija->setAction($this->view->baseUrl(). '/kategorija/edit/kategorija');
		$this->view->form = $frmKategorija;
	}
	
	public function podkategorijaAction()
	{
		$frmPodkategorija = new Kategorija_Form_Podkategorija();
		$mdlKategorija = new Kategorija_Model_Glavnekategorije();
		$mdlPodkategorija = new Kategorija_Model_Podkategorije();
		$id = $this->_request->getParam("id");
		if($this->getRequest()->isPost())        
	    {       
	       	if($frmPodkategorija->isValid($_POST))        
	       	{        
	       		$label = $frmPodkategorija->getValue('label');   
	       		$link = $frmPodkategorija->getValue('link');  
	       		$kat = $frmPodkategorija->getValue('kategorija');   
	       		if($kat == "nedefinisano" || !is_numeric($kat))
	       		{
	       			$kat = NULL;
	       		}       
	       		$result = $mdlPodkategorija->updatePodkategorije($id,$kat,$label,NULL,$link);       
	       		if($result)       
		       	{    
				   	return $this->_redirect('/kategorija/edit/listpodkategorija');  
		       	}      
	       	}    
	    }       
	    else        
	    {      
			$currentPodKat = $mdlPodkategorija->find($id)->current();
			$frmPodkategorija->populate($currentPodKat->toArray());
		}
		$mutliOptArray = array('nedefinisano' => 'Nedefinisano');
		$kategorije = $mdlKategorija->getKategorije();
		if(isset($kategorije) &&  $kategorije != false)
		{
			foreach($kategorije as $kategorija)
			{
				$mutliOptArray += array($kategorija->id => $kategorija->name);
			}
		}
		$frmPodkategorija->getElement('kategorija')->setMultiOptions($mutliOptArray);
			
		$frmPodkategorija->setAction($this->view->baseUrl(). '/kategorija/edit/podkategorija');
		$this->view->form = $frmPodkategorija;
	}
}