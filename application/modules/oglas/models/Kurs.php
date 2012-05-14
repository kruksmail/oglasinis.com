<?php
class Oglas_Model_Kurs extends Zend_Db_Table_Abstract {
   protected $_name = 'kurs';
   
   function getAll()
   {
      $select = $this->select ();
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
   
   function getByValutaName($name)
   {
      $select = $this->select ("vrednost");
      $select->where("valuta = ?", $name);
      $items = $this->fetchAll($select);
		if($items->count() > 0)
		{
			foreach ( $items as $row )
			{
			   return $row->vrednost;
			}
		}
		else
		{
			return false;
		}
   }
}