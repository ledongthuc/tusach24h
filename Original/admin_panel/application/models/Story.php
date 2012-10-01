<?php 
	class Model_Story extends Zend_Db_Table_Abstract
	{
		protected $_name="truyen";
		protected $_primary="TruyenID";
		public function IsUnique($title)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$sql = "SELECT * FROM truyen WHERE Title = '".$title."'";
			$data = $db->query($sql)->fetchAll();
			$row = count($data);
			if ($row > 0)
			{
				//row found -> exist
				return false;
			}
			else
			{
				return true;
			}
		}
		public function ListOne($id)
		{
			$sql = "SELECT Chapters FROM truyen WHERE TruyenID = '".$id."'";
			$db = Zend_Db_Table::getDefaultAdapter();
			$data = $db->fetchCol($sql);
			return $data[0];
		}
		public function InsertPage($data)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->insert('pages', $data);
		}
		public function ListCategory()
		{
			$sql = "SELECT * FROM category ORDER BY Title ASC";
			$db = Zend_Db_Table::getDefaultAdapter();
			$data = $db->query($sql)->fetchAll();
			return $data;
		}
		public function Insert($data)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->insert('truyen', $data);
		}
		public function Update($data, $where)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->update('truyen', $data, $where);
		}
		public function Delete()
		{
				
		}
		public function Censor()
		{
		
		}
		public function ListAll()
		{
			$sql = "SELECT * FROM truyen ORDER BY Title ASC";
			$db = Zend_Db_Table::getDefaultAdapter();
			$data = $db->query($sql)->fetchAll();
			return $data;
		}

	}
?>