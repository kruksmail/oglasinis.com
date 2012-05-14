<?php
class OglasiController extends Vlasotince_Library_Controller_Action_Abstract
{
	public function indexAction()
	{
		$this->view->kategorija = $this->_request->getParam('kategorija');
		$this->view->podkategorija = $this->_request->getParam('podkategorija');
		$this->view->oglas = $this->_request->getParam('oglas');
		$this->view->page = $this->_request->getParam('page');
	}
	
	
}
