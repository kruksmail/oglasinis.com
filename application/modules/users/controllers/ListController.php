<?php
class Users_ListController extends Users_Library_Controller_Action_Abstract
{
	
	public function init()
	{
		$this->view->skin = "mySkin";
	}
	
	public function indexAction()
    {
    	$this->view->headTitle('Korisnici');
    	$currentUsers = Users_Model_User::getUsers();
    	$this->view->adminExpand = TRUE;
        if($currentUsers->count() > 0)
        {
        	$this->view->users = $currentUsers;
        }
        else
        {
        	$this->view->users = null;
        }
    }
}