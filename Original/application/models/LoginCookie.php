<?php
	class Model_LoginCookie extends Zend_Db_Table_Abstract
	{
		protected $_name = 'login_cookies';
		protected $_primary = 'UserID';
		
		public function LoginCookie_Insert($userid, $usercode)
		{	
			$db = Zend_Db_Table::getDefaultAdapter();
			$data = array(
					'UserID' => $userid,
					'UserCode' => $usercode
					);
			$db->insert('login_cookies', $data);
		}
		
		public function LoginCookie_Delete($userid)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->delete('login_cookies', 'UserID = ' . $userid);
		}
	} 