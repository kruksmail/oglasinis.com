<?php
class Custom_Controller_Plugin_Layout extends Zend_Layout_Controller_Plugin_Layout
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
		$this->getLayout()->setLayoutPath( 
			Zend_Registry::get('config')->resources->frontController->moduleDirectory
			. DS . $request->getModuleName() . DS . 'layouts' );
    }
} 