<?php
Class Custom_Db_Table_Abstract extends Zend_Db_Table_Abstract
{
	public function __construct()
	{
		if (isset($this->_use_adapter)) 
		{
            $config = Zend_Registry::get($this->_use_adapter);
        }
        
        if (Zend_Registry::isRegistered('cache'))
        {
        	Zend_Db_Table_Abstract::setDefaultMetadataCache(Zend_Registry::get('cache'));
        } 
        
        return parent::__construct($config);
	}
	
	public function select($options = null)
	{
		$select = parent::select($options = null)->setIntegrityCheck(false);
		return $select;
	}
}