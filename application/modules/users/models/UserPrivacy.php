<?php
class Users_Model_UserPrivacy extends Zend_Db_Table_Abstract
{
	protected $_name = 'privacy';
	protected $_referenceMap = array(
		'User' => array(
			'columns' => array('user_id'),
			'refTableClass' => 'Users_Model_User',
			'refColumns' => array('id'),
			'onDelete' => self::CASCADE,
			'onUpdate' => self::RESTRICT
		)
	);
	public function createUser($user_id, $custom)
	{
		$rowUser = $this->createRow();
		if($rowUser)
		{
			$rowUser->user_id = $user_id;
			$rowUser->custom = $custom;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
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
	
	public function getUsers()
	{
		$select = $this->select();
		return $select->fetchAll($select);
	}
	
	public function updateUser($user_id, $custom)
	{
		$select = $this->select();
		$select->where('user_id =?', $user_id);
		$rowUser = $this->fetchRow($select);
		if($rowUser)
		{
			$rowUser->custom = $custom;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
}