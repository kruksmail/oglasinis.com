<?php
class Custom_Service_Notifier_Error
{
	protected $_environment;  
	protected $_mailer;  
	protected $_session;  
	protected $_error;  
	protected $_cookies;
	protected $_server;
	public function _construct($environment,
	         ArrayObject $error,  
		     Zend_Mail $mailer,  
			 Zend_Session_Namespace $session, $cookies, Array $server)
	{
		$this->_environment = $environment;  
		$this->_mailer = $mailer;  
       	$this->_error = $error;  
	    $this->_session = $session;  
       	$this->_cookies = $cookies;  
       	$this->_server = $server;  
	}
	public function getFullErrorMessage()
	{
		
	}
	
	public function notify()
	{
		
	}
}