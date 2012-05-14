<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	#stores a copy of the config object in the Registry for future references
	#!IMPORTANT: Must be runed before any other inits
	protected function _initConfig()
    {
    	Zend_Registry::set('config', new Zend_Config($this->getOptions()));
    }
	
	#Initializes the default timezone for the php ENV
	protected function _initDate()
    {
    	date_default_timezone_set(Zend_Registry::get('config')->settings
    														  ->application
    														  ->datetime);
    }
    
    #initializes all controller plugins
    protected function _initControllerPlugins()
    {
    	Zend_Controller_Front::getInstance()->registerPlugin(
    		new Custom_Controller_Plugin_ModuleBasedErrorHandler());
    }
    
    #stores a copy of all the database adapters in the Registry for future references
	protected function _initDatabases()
    {
		$this->bootstrap('multidb');
		$resource = $this->getPluginResource('multidb');
    	$databases = Zend_Registry::get('config')->resources->multidb;
	    foreach ($databases as $name => $adapter)
	    {
	    	$db_adapter = $resource->getDb($name);
	    	Zend_Registry::set($name, $db_adapter);
	    }
    }
}