<?php
class Model_User extends Zend_Db_Table_Abstract{
    protected $_name="user";
    protected $_primary="UserID";
	
	public function listAll()
	{
		$table = Zend_Db_Table::getDefaultAdapter();
		$sql = 'select * from user';
		$data = $table->query($sql)->fetchAll();
		echo '<p style="font-size: 20px; font-weight: bold; text-transform: uppercase; margin-top: 20px; color: blue;">List test user</p>';
		echo '<table border="1" cellspacing="5" cellpadding="10">';
		echo '<tr>';
		echo '<td>UserID</td>';
		echo '<td>Username</td>';
		echo '<td>Password</td>';
		echo '<td>Email</td>';
		echo '<td>CreatedDate</td>';
		echo '<td>GroupID</td>';
		echo '<td>Gender</td>';
		echo '<td>Status</td>';
		echo '</tr>';
		
		foreach ($data as $row)
		{
			if($row['Gender'] == 1)
			{
				$gender = "Nữ";
			}
			else if($row['Gender'] == 2)
			{
				$gender = "Nam";
			}
			else
			{
				$gender = "Không xác định";
			}
			echo '<tr>';
			echo '<td>' . $row['UserID'] . '</td>';
			echo '<td>' . $row['Username'] . '</td>';
			echo '<td>' . $row['Password'] . '</td>';
			echo '<td>' . $row['Email'] . '</td>';
			echo '<td>' . $row['CreatedDate'] . '</td>';
			echo '<td>' . $row['GroupID'] . '</td>';
			echo '<td>' . $gender . '</td>';
			echo '<td>' . $row['Status'] . '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	
			//Select
		//$sql='select * from user';
		//print_r($table->fetchAll($sql));
		/*
		//Insert
		$data = array('id'=>6, 'username'=>'kakaka', 'password'=>'123');
		$table->insert('user', $data);
		echo $id = $table->lastInsertId('user', 'id');
		
		//Update
		$data = array('username' => 'good');
		$where = "id = 1";
		$table->update('user', $data, $where);
		
		$where = 'id = 1';
		$table->delete('user', $where);
		*/
	public function UserInsert($data)
	{
		$table = Zend_Db_Table::getDefaultAdapter();
		$table->insert('user', $data);
		//echo $id = $table->getLastInsertId();
	}
	public function UserUpdate()
	{
	
	}
	public function UserSelect()
	{
	
	}
	public function UserDelete()
	{
	
	}
}

