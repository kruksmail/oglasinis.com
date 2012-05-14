<?php
class Kategorija_Model_Podkategorije extends Zend_Db_Table_Abstract {
	protected $_name = 'podkategorije';
		
	public function getPodkategorije()
	{
		$select = $this->select();
		$select->order("kategorija");
		$items = $this->fetchAll($select);
		if($items->count() > 0)
		{
			return $items;
		}
		else
		{
			return false;
		}
	}
	
	public function getPodkategorijeByKategorija($kat)
	{
		$select = $this->select();
		$select->where('kategorija = ?', $kat);
		$select->order("position");
		$items = $this->fetchAll($select);
		if($items->count() > 0)
		{
			return $items;
		}
		else
		{
			return false;
		}
	}
	
	public function getPodkategorijeByID($id)
	{
		if(!is_numeric($id))
		{
			return false;
		}
		return $this->find($id)->current();
		
	}
	
	public function getPodkategorijeByLabel($kategorija,$label)
	{
		if(!isset($label) || !isset($kategorija))
		{
			return NULL;
		}
		$select = $this->select();
		$select->where('kategorija = ?', $kategorija);
		$select->where('label = ?', $label);
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
	
	public function createPodkategorije($kategorija, $label, $pageId = 0, $link = null)
	{
		$row = $this->createRow();
		$row->kategorija = $kategorija;
		$row->label = $label;
		$row->page_id = $pageId;
		$row->link = $link;
		
		$row->position = $this->_getLastPosition($kategorija) + 1;
		return $row->save();
	}
	
	private function _getLastPosition($kategorija)
	{
		if($kategorija === null)
		{
			return 0;
		}
		$select = $this->select();
		$select->where('kategorija = ?', $kategorija);
		$select->order('position DESC');
		$row = $this->fetchRow($select);
		if($row)
		{
			return $row->position;
		}
		else
		{
			return false;
		}
	}
	
	public function updatePodkategorije($id, $kategorija, $label, $pageId = 0, $link = null)
	{
		if(!is_numeric($id))
		{
			return false;
		}
		$row = $this->find($id)->current();
		if($row)
		{
			$row->label = $label;
			$row->kategorija = $kategorija;
			$row->page_id = $pageId;
			if($pageId < 1)
			{
				$row->link = $link;
			}
			else
			{
				$row->link = null;
			}
			return $row->save();
		}
		else
		{
			return false;
			//throw new Zend_Exception('Error loading menu item');
		}
	}
	
	public function deletePodkategorije($id)
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
			//throw new Zend_Exception('Error loading menu');
		}
	}
}