<?php
/**
 * this class loads the CMS skin
 */

class Zend_View_Helper_LoadSkin extends Zend_View_Helper_Abstract
{
	public function loadSkin($skin)
	{
		$skinData = new Zend_Config_Xml('skins/'. $skin .'/skin.xml');
		$view = new Zend_View ();		
		$stylesheets = $skinData->stylesheets->stylesheet->toArray();
		
		if(is_array($stylesheets))
		{
			foreach($stylesheets as $stylesheet)
			{
				$this->view->headLink()->appendStylesheet($this->view->baseUrl('/skins/'. $skin .'/css/'. $stylesheet));
			}
		}
		
	}
	
	
}