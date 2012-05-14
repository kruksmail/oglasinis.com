<?php
class Custom_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		try{
			$acl = new Zend_Acl();
			$acl->addRole(new Zend_Acl_Role('guest'));
			$acl->addRole(new Zend_Acl_Role('user'),'guest');
			$acl->addRole(new Zend_Acl_Role('administrator'),'user');

			$acl->add(new Zend_Acl_Resource('users'));
			$acl->add(new Zend_Acl_Resource('oglas'));
			$acl->add(new Zend_Acl_Resource('kategorija'));
			$acl->add(new Zend_Acl_Resource('vlasotince'));
			$acl->add(new Zend_Acl_Resource('prijateljskisajtovi'));
			$acl->add(new Zend_Acl_Resource('search'));
				
			$acl->allow(null,'vlasotince');
				
			$acl->deny(null,'vlasotince','adminpage');
			$acl->deny(null,'kategorija');
			$acl->deny(null,'users');
			$acl->deny(null,'oglas');
			$acl->deny(null,'prijateljskisajtovi');
				
			$acl->allow ('guest','oglas','index');
			$acl->allow ('guest','oglas','unosoglasa');

			$acl->allow ('guest','search','search');
				
			$acl->allow('guest','prijateljskisajtovi','pregled');
				
			$acl->allow('guest','users','login');
			$acl->allow('guest','users','registration');
			$acl->allow('guest','users','recovery');
				
				
			$acl->allow('user','users','logout');
			$acl->allow('user','users','updateuser');
			$acl->allow('user','users','useraccount');
			$acl->allow('user','users','avatar');
			$acl->allow('user','users','confirm');
			$acl->allow('user','oglas','user');
				
			$acl->allow('administrator','vlasotince','adminpage');
			$acl->allow('administrator','kategorija','edit');
			$acl->allow('administrator','search','build');
			$acl->allow('administrator','users');
			$acl->allow('administrator','oglas','admin');
			$acl->allow('administrator','prijateljskisajtovi');
				
			$acl->deny('administrator','users','index');
				
			$acl->allow('administrator',null);
				
			$auth = Zend_Auth::getInstance();
			$p = new Zend_Auth_Storage_Session('PROJECT_vlasotinceonline');
			$auth->setStorage($p);
				
			if($auth->hasIdentity())
			{
				$mdlUser = new Users_Model_User();
				$lastSid = $mdlUser->getSid($auth->getIdentity()->id);
				if(Zend_Session::getId() != $lastSid)
				{
					$auth->clearIdentity();
				}
			}
				
			if($auth->hasIdentity())
			{
				$identity = $auth->getIdentity();
				$role = strtolower($identity->role);
			}
			else
			{
				$role = 'guest';
			}
			$module = $request->module;
			$controller = $request->controller;
			$action = $request->action;
			if(!$acl->isAllowed($role,$module,$controller,$action))
			{
				if($role == 'guest')
				{
					$request->setModuleName('users');
					$request->setControllerName('login');
					$request->setActionName('index');
				}
				else
				{
					$request->setModuleName('users');
					$request->setControllerName('error');
					$request->setActionName('noauth');
				}
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
}