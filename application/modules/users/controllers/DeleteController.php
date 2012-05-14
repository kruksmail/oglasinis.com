<?php
class Users_DeleteController extends Users_Library_Controller_Action_Abstract
{
	public function indexAction() 
	{
		$id = $this->_request->getParam('id');
      	$mdlUser = new Users_Model_User();
      	$this->view->user = $mdlUser->getUser($id);
        $newForm = new Zend_Form();
        $newForm->addElement('hidden','id',array('value' => $id));
        $newForm->addElement('submit','da',array('label'=>'Da'));
        $newForm->addElement('submit','ne',array('label'=>'Ne'));
      	if($this->_request->isPost() && $newForm->isValid($_POST))
      	{
      		if($newForm->getValue('da') == "Da")
      		{
      			$image = $this->view->user->image_url;
      			$userId = $newForm->getValue('id');
		        $result = $mdlUser->deleteUser($userId);
		        if($result === TRUE)
		        {
			        if($image !== NULL)
			        {
			        	unlink(APP_PUBLIC .'/images/userupload/'.$image);
			        }
			        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL && (stripos($_SERVER['HTTP_REFERER'],'/users/login') === false) && (stripos($_SERVER['HTTP_REFERER'],'/users/delete') === false))
			        {
			        	return $this->_redirect($_SERVER['HTTP_REFERER']);
			        }
			       	return $this->_redirect('/users/list');
		        }
		        else
		        {
		        	$this->view->error = "Operacija nije uspela!";
		        }
      		}
      		else
      		{
      			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL && (stripos($_SERVER['HTTP_REFERER'],'/users/login') === false) && (stripos($_SERVER['HTTP_REFERER'],'/users/delete') === false))
			    {
			       	return $this->_redirect($_SERVER['HTTP_REFERER']);
			    }
			    return $this->_redirect('/users/list');
      		}
      	}
      	$this->view->form = $newForm;
	}
}

