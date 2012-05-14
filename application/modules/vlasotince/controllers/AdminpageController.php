<?php


class AdminpageController extends Vlasotince_Library_Controller_Action_Abstract
{
	/*
	public function init()
	{
		$this->_helper->layout->setLayout('adminlayout');
		//$this->view->headTitle('Vlasotince Online');
		//	setting a separator string for segments:
		//$this->view->headTitle()->setSeparator(' - ');
		$this->view->setEncoding('UTF-8');

		$this->view->doctype('XHTML1_STRICT');
		
		// set the content type and language
		$this->view->headMeta()
			       ->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
		
		$this->view->headMeta()
				   ->appendHttpEquiv('Content-Language', 'en-US');

		// setting the site in the title
		$this->view->headTitle('Vlasotince Online');
		//	setting a separator string for segments:
		$this->view->headTitle()->setSeparator(' - ');
		$this->view->req = $this->_request->getParams();
	}
	*/
	public function indexAction() 
	{
		$this->view->headTitle('Administratorski panel');
	}
	
}
?>

