<?php
class Users_Model_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';
	protected $_dependentTables = array('Users_Model_UserPrivacy','Users_Model_EmailConfirmation','Users_Model_UserRecovery');
	
	public function createUser($username, $password, $firstName, $lastName, $role)
	{
		$rowUser = $this->createRow();
		if($rowUser)
		{
			$rowUser->username = $username;
			$rowUser->password = md5($password);
			$rowUser->first_name = $firstName;
			$rowUser->last_name = $lastName;
			$rowUser->role = $role;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function registerUser($username, $password, $firstName, $lastName, $email, $sex)
	{
		$rowUser = $this->createRow();
		if($rowUser)
		{
			$rowUser->username = $username;
			$rowUser->password = md5($password);
			$rowUser->first_name = $firstName;
			$rowUser->last_name = $lastName;
			$rowUser->email = $email;
			$rowUser->sex = $sex;
			$rowUser->signup_date = Zend_Date::now()->toString('dd-MM-yyyy');
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return NULL;
		}
	}
	
	public function getUsers()
	{
		$userModel = new self();
		$select = $userModel->select();
		$select->order(array('last_name','first_name'));
		return $userModel->fetchAll($select);
	}
	
	public function getUser($id)
	{
		return $this->find($id)->current();
	}
	
	public function getUserByUsername($username)
	{
		$select = $this->select();
		$select->where('username = ?', $username);
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
	
	public function getUserByEmail($email)
	{
		$select = $this->select();
		$select->where('email = ?', $email);
		//$select->limit(1); 
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
	
	public function getUserByIdPass($id,$password)
	{
		$select = $this->select();
		$select->where('id = ?', $id);
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
	
	public function updateUser($id, $username, $firstName, $lastName, $role)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->username = $username;
			$rowUser->first_name = $firstName;
			$rowUser->last_name = $lastName;
			$rowUser->role = $role;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	
	public function updateUsername($id, $username)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->username = $username;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function updateEmail($id, $email)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->email = $email;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function updatePersonalInfo($id, $firstName, $lastName, $sex, $birthdate, $employee)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->first_name = $firstName;
			$rowUser->last_name = $lastName;
			$rowUser->sex = $sex;
			$rowUser->birthdate = $birthdate;
			$rowUser->employee = $employee;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function updateAdditionalInfo($id,$description)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->description = $description;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function updateContactInfo($id,$address,$phone_mobile,$phone_home,$fax,$city,$site)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->address = $address;
			$rowUser->phone_mobile = $phone_mobile;
			$rowUser->phone_home = $phone_home;
			$rowUser->fax = $fax;
			$rowUser->city = $city;
			$rowUser->site = $site;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function updatePersonalImage($id,$image_url)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->image_url = $image_url;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function updatePassword($id, $password)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->password = md5($password);
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function deleteUser($id)
	{
		$rowUser = $this->find($id)->current();
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
	
	public function saveSid($id,$sid)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			$rowUser->last_sid = $sid;
			$rowUser->save();
			return $rowUser;
		}
		else
		{
			return false;
		}
	}
	
	public function getSid($id)
	{
		$rowUser = $this->find($id)->current();
		if($rowUser)
		{
			return $rowUser->last_sid;
		}
		else
		{
			return false;
		}
	}
}