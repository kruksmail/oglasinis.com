<?php
class Oglas_Bootstrap extends Zend_Application_Module_Bootstrap 
{ 
	protected function _initLibraryAutoloader()
	{
		return $this->getResourceLoader()
					->addResourceType('library', 
									  'library', 
									  'library');
	} 
}