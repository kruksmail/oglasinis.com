<?php
class Custom_Controller_Action_Helper_View
{
	public $view;

	public function __construct($view)
	{
		$this->view = $view;
	}

	public function init()
	{
		// set encoding and doctype
		$this->view->setEncoding('ISO-8859-2');

		$this->view->doctype('XHTML1_STRICT');

		$this->view->skin = 'mySkin';

		// set the content type and language
		$this->view->headMeta()
		->appendHttpEquiv('Content-Type', 'text/html; charset=ISO-8859-2');

		$this->view->headMeta()
		->appendHttpEquiv('Content-Language', 'en-US');
		
		// setting the site in the title
		$this->view->headTitle('Oglasi Niš');
		//	setting a separator string for segments:
		$this->view->headTitle()->setSeparator(' - ');

		return $this->view;
	}


}