<?php
class Custom_Links_LinkBuilder
{
	private $baseLink = null;
	private $baseUrl = null;
	private $request = null;
	private $modules = array();
	private $controllers = array();
	private $actions = array();
	private $otherParams = null;
	
	private $defaultModuleName = "vlasotince";
	public function __construct($baseURL,$request)
	{
		$this->baseUrl = $baseURL;
		$this->request = $request;
		$this->baseLink = $this->baseUrl;		
		if(isset($this->request))
		{
			foreach ($this->request as $index => $lValue)
			{
				if($index == "module" && $lValue == $this->defaultModuleName)
				{
					continue;
				}
				
				if($index == "action")
				{
					array_push($this->actions,$lValue);
				}
				if($index == "module")
				{
					array_push($this->modules,$lValue);
				}
				if($index == "controller")
				{
					array_push($this->controllers,$lValue);
				}
				
				if($index != "action" && $index != "controller" && $index != "module")
				{
					$this->baseLink .= "/". $index ."/". $lValue;
					$this->otherParams .= "/". $index ."/". $lValue;
				}
				else
				{
					$this->baseLink .= "/". $lValue;
				}
			}
		}
	}
	
	public function getLink()
	{
		return $this->baseLink;
	} 
	
	public function getRequest()
	{
		return $this->request;
	}
	
	public function getBaseUrl()
	{
		return $this->baseUrl;
	}
	
	public function getOthers($i = NULL)
	{
		if($i == NULL || (!is_numeric($i)) || $i < 0)
		{
			return $this->otherParams;
		}
		
		$tmp = explode('/',$this->otherParams);
		
		if(isset($tmp) && $tmp != NULL && $i < count($tmp))
		{
			return $tmp[$i];
		}
		else
		{
			return NULL;
		}
	}
	public function removeOthers()
	{
		return $this->baseLink = substr($this->baseLink, 0, strlen($this->baseLink)- strlen($this->otherParams));
	}
	
	public function addOthers($params)
	{
		if(isset($params))
		{
			$paramsVar = null;
			foreach($params as $index => $pValue)
			{
				$paramsVar .= "/". $index ."/". $pValue;
			}
			$this->otherParams .= $paramsVar;
			$this->baseLink .= $paramsVar;
		}
	}
	
	public function insertAction($controller,$action)
	{
		$link = array();
		if(isset($this->request))
		{
			foreach ($this->request as $index => $lValue)
			{
				if($index == "module" && $lValue == $this->defaultModuleName)
				{
					continue;
				}
				
				if($index == "action")
				{
					$lValue = $action;
				}
				$link += array($index => $lValue);
			}
		}
		else
		{
			$link = array('controller' => $controller, 'action' => $action);
		}
		$this->request = $link;
	} 
}