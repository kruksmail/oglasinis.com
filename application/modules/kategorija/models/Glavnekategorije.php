<?php

class Kategorija_Model_Glavnekategorije extends Zend_Db_Table_Abstract {
	protected $_name = 'kategorije';
	
	public function getKategorije()
	{
		$select = $this->select();
		$select->order("name");
		$kategorije = $this->fetchAll($select);
		if($kategorije->count() > 0)
		{
			return $kategorije;
		}
		else 
		{
			return false;
		}
	}
	
	public function getKategorijeNames()
	{
		$select = $this->select("name");
		$kategorije = $this->fetchAll($select);
		if($kategorije->count() > 0)
		{
			return $kategorije;
		}
		else 
		{
			return false;
		}
	}
	
	
	public function getKategorijeById($id)
	{
		if(!is_numeric($id))
		{
			return false;
		}
		return $this->find($id)->current();	
	}
	
	public function getKategorijeByName($name)
	{
		if(!isset($name))
		{
			return false;
		}
		$select = $this->select();
		$select->where('name = ?', $name);
		$row = $this->fetchRow($select);
		if($row)
		{
			return $row->id;
		}
		else
		{
			return false;
		}
	}
	
	
	public function createKategorije($name)
	{
		$row = $this->createRow();
		$row->name = $name;
		return $row->save();
	}
	
	public function updateKategorije($id, $name)
	{
		$currentKategorija = $this->find($id)->current();
		if($currentKategorija)
		{
			$currentKategorija->name = $name;
			$currentKategorija->save();
			return true;
		}
		else
		{
			return false;
			//throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function deleteKategorije($id)
	{
		if(!is_numeric($id))
		{
			return false;
		}
		$row = $this->find($id)->current();
		if($row)
		{
			return $row->delete();
		}
		else
		{
			return false;
		}
	}
}