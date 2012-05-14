<?php
class Users_Model_EmailConfirmation extends Zend_Db_Table_Abstract
{
	protected $_name = 'confirmation';
	protected $_referenceMap = array(
		'Confirm' => array(
			'columns' => array('user_id'),
			'refTableClass' => 'Users_Model_User',
			'refColumns' => array('id'),
			'onDelete' => self::CASCADE,
			'onUpdate' => self::RESTRICT
		)
	);
	
	public function createUser($user_id, $code)
	{
		$rowUser = $this->createRow();
		if($rowUser)
		{
			$rowUser->user_id = $user_id;
			$rowUser->code = $code;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function confirmUser($user_id)
	{
		$select = $this->select();
		$select->where('user_id =?',$user_id);
		$rowUser = $this->fetchRow($select);
		if($rowUser)
		{
			$rowUser->confirmed = TRUE;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function updateUser($user_id, $code)
	{
		$select = $this->select();
		$select->where('user_id =?',$user_id);
		$rowUser = $this->fetchRow($select);
		if($rowUser)
		{
			$rowUser->user_id = $user_id;
			$rowUser->code = $code;
			$rowUser->confirmed = NULL;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			$rowUser = $this->createUser($user_id, $code);
			if($rowUser)
			{
				return $rowUser;
			}
			else
			{
				return false;
			}
		}
	}
	
	public function getUser($id)
	{
		$select = $this->select();
		$select->where('user_id =?',$id);
		$rowUser = $this->fetchRow($select);
		if($rowUser)
		{
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
}