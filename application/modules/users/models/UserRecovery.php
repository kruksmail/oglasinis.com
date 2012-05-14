<?php

class Users_Model_UserRecovery extends Zend_Db_Table_Abstract
{
	protected $_name = 'temporarypassword';
	protected $_referenceMap = array(
		'Recovery' => array(
			'columns' => array('id'),
			'refTableClass' => 'Users_Model_User',
			'refColumns' => array('id'),
			'onDelete' => self::CASCADE,
			'onUpdate' => self::RESTRICT
		)
	);
	
	public function createUser($id, $username, $password, $firstName, $lastName, $email, $sex, $role)
	{
		$rowUser = $this->createRow();
		if($rowUser)
		{
			$rowUser->id = $id;
			$rowUser->username = $username;
			$rowUser->password = $password;
			$rowUser->first_name = $firstName;
			$rowUser->last_name = $lastName;
			$rowUser->email = $email;
			$rowUser->sex = $sex;
			$rowUser->role = $role;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function confirmUser($id)
	{
		$select = $this->select();
		$select->where('id =?',$id);
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
	
	public function updateUser($id, $username, $password, $firstName, $lastName, $email, $sex, $role)
	{
		$select = $this->select();
		$select->where('id =?',$id);
		$rowUser = $this->fetchRow($select);
		if($rowUser)
		{
			$rowUser->id = $id;
			$rowUser->username = $username;
			$rowUser->password = $password;
			$rowUser->first_name = $firstName;
			$rowUser->last_name = $lastName;
			$rowUser->email = $email;
			$rowUser->sex = $sex;
			$rowUser->role = $role;
			$rowUser->confirmed = NULL;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			$rowUser = $this->createUser($id, $username, $password, $firstName, $lastName, $email, $sex, $role);
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
		$select->where('id =?',$id);
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
	
	public function getUserByUsernamePass($username,$password)
	{
		$select = $this->select();
		$select->where('username = ?', $username);
		$select->where('password = ?', $password);
		$select->limit(1); 
		$row = $this->fetchRow($select);
		if($row != NULL)
		{
			return $row;
		}
		else
		{
			return false;
		}
	}
	
	public function deleteUser($id)
	{
		$select = $this->select();
		$select->where('id =?',$id);
		$rowUser = $this->fetchRow($select);
		if($rowUser)
		{
			$rowUser->delete();
			return true;
		}
		else
		{
			return false;
		}
	}
}