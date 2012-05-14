<?php
class Custom_Controller_Plugin_ModuleBasedErrorHandler extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
    	$module = $request->getModuleName();
        $errorHandler = Zend_Controller_Front::getInstance()
					->getPlugin('Zend_Controller_Plugin_ErrorHandler')
                    ->setErrorHandlerModule($module);
	}
} 