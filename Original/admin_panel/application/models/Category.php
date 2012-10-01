<?php 
	class Model_Category extends Zend_Db_Table_Abstract
	{
		protected $_name="category";
		protected $_primary="CategoryID";
		public function IsUnique($title)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$sql = "SELECT * FROM category WHERE Title = '".$title."'";
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
		public function IsExist($id)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$sql = "SELECT * FROM category WHERE CategoryID = " . $id;
			$data = $db->query($sql)->fetchAll();
			$row = count($data);
			if ($row > 0)
			{
				//row found -> exist
				return true;
			}
			else
			{
				return false;
			}
		}
		public function ListOne($id)
		{
			$sql = "SELECT Title FROM category WHERE CategoryID = '".$id."'";
			$db = Zend_Db_Table::getDefaultAdapter();
			$data = $db->fetchCol($sql);
			return $data;
		}
		public function ListAll()
		{
			$sql = "SELECT * FROM category ORDER BY Title ASC";
			$db = Zend_Db_Table::getDefaultAdapter();
			$data = $db->query($sql)->fetchAll();
			return $data;
		}
		public function Insert($data)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->insert('category', $data);
		}
		public function Update($data, $where)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->update('category', $data, $where);
		}
		public function Delete($id)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$where = "CategoryID=".$id;
			$db->delete('category', $where);
		}
	}
?>