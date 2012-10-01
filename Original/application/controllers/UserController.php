<?php 
	class UserController extends Zend_Controller_Action
	{
		const PASSWORD_HASH = "MY_PASSWORD_HASH_WHICH_SHOULD_BE_SOMETHING_SECURE";
		public function init()
		{
		}
		public function preDispatch()
		{
			//Redirecting user when not login
			
			/*$auth = Zend_Auth::getInstance();
			if(!$auth->hasIdentity())
			{
				if($this->_request->getActionName() != 'login')
				{
					$this->_redirect('/user/login');
				}
			}*/
		}
		public function indexAction()
		{ 
			//$this->_helper->redirector->gotoRoute(array('controller'=>'users', 'action' => 'signup'));
			//$this->_redirect('/user/register');
			//Get root folder
			$base = $this->_request->getBaseUrl();
			//Get current module name
			$mod = $this->_request->getModuleName();
			$this->view->root = $base;
			
			//$user = new Model_User();
			//$user->listAll();
			$test = new Model_LoginCookie();
			//$test->LoginCookie_Insert('100', 'kjsahjkfhsjadkhflsajdfkhello');
			$test->LoginCookie_Delete('100');
		}
		public function registerAction()
		{
			//THE SPECIAL THING OF THIS CODE IS: IT CAN AVOID AUTO REG BY CHECKING STATUS OF CAPTCHA ALTHOUGH VALIDATE BY JQUERY.
			
			$session_captcha = new Zend_Session_Namespace('captcha');
			//Key for recaptcha of ts24h
			$public_key = '6LfyetQSAAAAAGsmGBMAmCCtoEfXdPRksEnnFFwf';
			$private_key = '6LfyetQSAAAAAKlJvPNF55f4df3ou00n9z5JUbaN';
			if($this->_request->isPost())
			{
				//Declare for short view of working
				//==================================
				if($this->_request->isPost('username'))
				{
					$post_username = $this->_request->getPost('username');
				}
				//==================================
				if($this->_request->isPost('password'))
				{
					$post_password = $this->_request->getPost('password');
				}
				//==================================
				if($this->_request->isPost('repassword'))
				{
					$post_repassword = $this->_request->getPost('repassword');
				}
				//==================================
				if($this->_request->isPost('email'))
				{
					$post_email = $this->_request->getPost('email');
				}
				//==================================
				if($this->_request->isPost('sex'))
				{
					$post_sex = $this->_request->getPost('sex');
				}
				//==================================
				if($this->_request->isPost('agree'))
				{
					$post_agree = $this->_request->getPost('agree');
				}
				//==================================
				if($this->_request->isPost('respone'))
				{
					$post_captcha_response = $this->_request->getPost('response');
				}
				//==================================
				if($this->_request->isPost('challenge'))
				{
					$post_captcha_challenge = $this->_request->getPost('challenge');
				}
				//==================================
				if($this->_request->isPost('func'))
				{
					$post_func = $this->_request->getPost('func');
				}
				//==================================
				
				if(($post_func == "testtest"))
				{
					echo $post_func;
				}
				//Postback check email
				if(($post_func == "check_email") && $this->_request->isPost('email'))
				{
					echo check_email_format($post_email);
				}
				
				//Postback check email available
				if(($post_func == "check_email_available") && $this->_request->isPost('email'))
				{
					echo check_string_db_available('user', 'Email', $post_email);
				}
				
				//Postback check username available
				if(($post_func == "check_username_available") && $this->_request->isPost('username'))
				{
					echo check_string_db_available('user', 'Username', $post_username);
				}
				
				if($post_func == "getstatus")
				{
					$stt = ($session_captcha->status == null)?'null':$session_captcha->status;
					$rsp = ($session_captcha->response == null)?'null':$session_captcha->response;
					echo 'Status: ' . $stt . ' Response: ' . $rsp;
				}
				
				//Postback check captcha
				if($post_func == "check_captcha")
				{
					$ch = $post_captcha_challenge;
					$res = $post_captcha_response;
					$status = check_captcha_match($ch, $res, $public_key, $private_key);
					//if get page => clear session 
					if(($session_captcha->status != null) && ($session_captcha->response != null))
					{
						if ($res == $session_captcha->response)
						{
							echo 1;
						}
						else 
						{
							echo 0;
						}
					}
					else 
					{
						if($status == 1)
						{
							$session_captcha->status = 1;
							$session_captcha->response = $res;
							echo 1;
						}
						else 
						{
							echo 0;
						}
					}
				}
				if(($post_func == "check_username_format") && $this->_request->isPost('username'))
				{
					echo check_username_format($this->_request->getPost('username'));
				}
				
				if($post_func == "reg_completed")
				{
					//Postback check all and insert db if valid
					if($this->_request->isPost('username') && $this->_request->isPost('password') && $this->_request->isPost('repassword') && $this->_request->isPost('email') && $this->_request->isPost('sex') && $this->_request->isPost('agree') && ($session_captcha->status == 1))
					{
						//Check username
						if(check_username_format($this->_request->getPost('username')) == 0)
						{
							echo 0;
							//echo 'username out of range';
							return false;
						}
						else if(check_string_db_available('user', 'Username', $post_username) == 0)
						{
							echo 0;
							//echo 'username not available';
							return false;
						}
						//Check password
					
							
						else if(check_string_length($post_password, 6, 32) == 0)
						{
							echo 0;
							//echo 'password out of range';
							return false;
						}
							
						else if(check_pass_match($post_password, $post_repassword) == 0)
						{
							echo 0;
							//echo '2 pass does not match';
							return false;
						}
						//Check email
						else if(check_email_format($post_email) == 0)
						{
							echo 0;
							//echo 'email wrong format';
							return false;
						}
						else if(check_string_db_available('user', 'Email', $post_email) == 0)
						{
							echo 0;
							//echo 'email not available';
							return false;
						}
						else if(!is_numeric($post_sex))
						{
							echo 0;
							//echo 'sex is wrong';
							return false;
						}
						else if((intval($post_sex) == 0) || (intval($post_sex) > 4))
						{
							echo 0;
							//echo 'sex not choose or out of range';
						}
						else if($session_captcha->status !=  1)
						{
							echo 0;
							//echo 'captcha not match';
						}
						else if($post_agree != 'on')
						{
							echo 0;
							//echo 'Need check agree';
						}
						else
						{
							try {
								$data = array(
										'Username' => $post_username,
										'Password' => EncryptPassword($post_password, self::PASSWORD_HASH),
										'Email' => $post_email,
										'CreatedDate' => date('y-m-d'),
										'GroupID' => '1',
										'Gender' => $post_sex,
										'Status' => '1'
								);
								
								$table = Zend_Db_Table::getDefaultAdapter();
								$table->insert('user', $data);
								echo 1;
							}
							catch (Exception $e)
							{
								echo 0;
							}
						}
					}
					else
					{
						echo 0;	
					}
				}
			}
			else
			{
				$auth = Zend_Auth::getInstance();
				if($auth->hasIdentity())
				{
					if($this->_request->getActionName() != 'login')
					{
						$this->_redirect('/index/index');
					}
				}
				else {
					//Declare for checking sesion captcha
					$session_captcha->status = null;
					$session_captcha->response = null;
					
					//Hide if isset Postback
					$this->view->show_content = true;
					
					//Set layout
					$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
					Zend_Layout::startMvc($option);
					
					//Get root folder
					$base = $this->_request->getBaseUrl();
					
					//Get current module name
					$mod = $this->_request->getModuleName();
					
					//Get paths
					$imgdir = "$base/html/images";
					$cssdir = "$base/html/css";
					$jsdir = "$base/html/js";
						
					//Declare for list views
					$this->view->baseurl = $base;
					$this->view->modulename = $mod;
					$this->view->doctype('XHTML11');
					$this->view->headTitle("Trang chu | tusach24h.com");
					$this->view->imgdir = $imgdir;
					$this->view->cssdir = $cssdir;
					$this->view->jsdir = $jsdir;
				}
			}
		}
		public function loginAction()
		{
			if($this->_request->isPost())
			{	
				if(isset($_POST['username']) && isset($_POST['password']))
				{
					//goi ket noi db
					$db = Zend_Db_Table::getDefaultAdapter();
					//khoi tao zend_auth
					$auth = Zend_Auth::getInstance();
					//khoi tao bang va 2 cot username password tham chieu trong qua trinh tham chieu
					$authAdapter = new Zend_Auth_Adapter_DbTable($db);
					$authAdapter->setTableName('user');
					$authAdapter->setIdentityColumn('Username');
					$authAdapter->setCredentialColumn('Password');
					
					//lay du lieu post tu form
					$username = $this->_request->getPost('username');
					$password = $this->_request->getPost('password');
			
					//so sanh du lieu post voi db
					$authAdapter->setIdentity($username);
					$authAdapter->setCredential(EncryptPassword($password, self::PASSWORD_HASH));
					//kiem tra trang thai cua user la 1 moi duoc login
					$select = $authAdapter->getDbSelect();
					$select->where('status = 1');
					$result = $auth->authenticate($authAdapter);
					$flag = false;
					if($result->isValid())
					{
					//lay nhun gdu lieu can thiet
						$data = $authAdapter->getResultRowObject(null, 'Password');
						$auth->getStorage()->write($data);
						$flag = true;
					}
					else
					{
						if(isset($_POST['login_postback']))
						{
							echo 0;
						}
						else
						{
							echo 'Login fail.';
						}
					}
					if($flag)
					{
						if(isset($_POST['login_postback']))
						{
							echo $auth->getIdentity()->Username;
						}
						else 
						{
							//$this->_redirect('/user/index');
							echo 'Login success.';
						}
					}
					else 
					{
						echo 0;
					}
				}
				else 
				{
					echo 0;
				}
			}
			else
			{
				$this->view->show_content = true;
				$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
				Zend_Layout::startMvc($option);
				//Get root folder
				$base = $this->_request->getBaseUrl();
				//Get current module name
				$mod = $this->_request->getModuleName();
				//Get paths
				$imgdir = "$base/html/images";
				$cssdir = "$base/html/css";
				$jsdir = "$base/html/js";
					
				//List views
				$this->view->doctype('XHTML11');
				$this->view->headTitle("Quen mat khau | tusach24h.com");
				$this->view->imgdir = $imgdir;
				$this->view->cssdir = $cssdir;
				$this->view->jsdir = $jsdir;
			}
		}
		public function lostpasswordAction()
		{
			if($this->_request->isPost())
			{
				
			}
			else
			{
				$this->view->show_content = true;
				$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
				Zend_Layout::startMvc($option);
				//Get root folder
				$base = $this->_request->getBaseUrl();
				//Get current module name
				$mod = $this->_request->getModuleName();
				//Get paths
				$imgdir = "$base/html/images";
				$cssdir = "$base/html/css";
				$jsdir = "$base/html/js";
			
				//List views
				$this->view->doctype('XHTML11');
				$this->view->headTitle("Quen mat khau | tusach24h.com");
				$this->view->imgdir = $imgdir;
				$this->view->cssdir = $cssdir;
				$this->view->jsdir = $jsdir;
			}
		}
		public function changeinfoAction()
		{
			if($this->_request->isPost())
			{
			
			}
			else
			{
				$this->view->show_content = true;
				$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
				Zend_Layout::startMvc($option);
				//Get root folder
				$base = $this->_request->getBaseUrl();
				//Get current module name
				$mod = $this->_request->getModuleName();
				//Get paths
				$imgdir = "$base/html/images";
				$cssdir = "$base/html/css";
				$jsdir = "$base/html/js";
					
				//List views
				$this->view->doctype('XHTML11');
				$this->view->headTitle("Quen mat khau | tusach24h.com");
				$this->view->imgdir = $imgdir;
				$this->view->cssdir = $cssdir;
				$this->view->jsdir = $jsdir;
			}
		}
		public function logoutAction()
		{
			$auth = Zend_Auth::getInstance();
			$auth->clearIdentity();
			$this->_redirect('/');
		}
		public function addfavoriteAction()
		{	
			if($this->_request->isPost())
			{
					
			}
			else
			{
				$this->view->show_content = true;
				$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
				Zend_Layout::startMvc($option);
				//Get root folder
				$base = $this->_request->getBaseUrl();
				//Get current module name
				$mod = $this->_request->getModuleName();
				//Get paths
				$imgdir = "$base/html/images";
				$cssdir = "$base/html/css";
				$jsdir = "$base/html/js";
					
				//List views
				$this->view->doctype('XHTML11');
				$this->view->headTitle("Quen mat khau | tusach24h.com");
				$this->view->imgdir = $imgdir;
				$this->view->cssdir = $cssdir;
				$this->view->jsdir = $jsdir;
			}
		}
		public function testAction()
		{
		}
		
	}
?>