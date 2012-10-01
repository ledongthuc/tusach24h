<?php

class StoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //Init model
    	$story = new Model_Story();
    	
    	//Config layout
    	$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
    	Zend_Layout::startMvc($option);
    	
    	//Get root folder
    	$root = $this->_request->getBaseUrl();
    	
    	//Get paths
    	$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
    	$imgdir = $root.'/'.$config->img->path;
    	$cssdir = $root.'/'.$config->css->path;
    	$jsdir = $root.'/'.$config->js->path;
    	
    	//Paginator
    	$paginator = Zend_Paginator::factory($story->ListAll());
    	$paginator->setItemCountPerPage(10);
    	$paginator->setPageRange(5);
    	$currentPage = $this->_request->getParam('page', 1);
    	$paginator->setCurrentPageNumber($currentPage);
    	
    	//List views
    	$this->view->doctype('XHTML11');
    	$this->view->headTitle("Danh sach truyen | Admin Panel | tusach24h.com");
    	$this->view->imgdir = $imgdir;
    	$this->view->cssdir = $cssdir;
    	$this->view->jsdir = $jsdir;
    	$this->view->root = $root;
    	$this->view->title = "Danh sách truyện A-Z";
  
    	$this->view->data = $paginator;
    }
	public function createAction()
	{
		//Init model
		$story = new Model_Story();
		
		//Postback style
		if($this->_request->isPost())
		{
			$this->view->show_content = false;
				if(($_POST['func'] == 'create') && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['chapters']))
			{
				if ($story->IsUnique($_POST['title']))
				{
					$data = array(
							'Title' => $_POST['title'],
							'Image' => $_POST['image'],
							'Author' => $_POST['author'],
							'CategoryID' => $_POST['category'],
							'UserID' => '1',
							'Description' => $_POST['description'],
							'Chapters' => $_POST['chapters'],
							'Status' => 0,
							'PostedDate' => date('Y-m-d H:i:s')
					);
					$story->Insert($data);
					echo 1;
				}
				else
				{
					echo 2;
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
			
			//Config Layout
			$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
			Zend_Layout::startMvc($option);
			
			//Get root folder
			$root = $this->_request->getBaseUrl();
			
			//Get paths
    		$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
    		$imgdir = $root.'/'.$config->img->path;
    		$cssdir = $root.'/'.$config->css->path;
    		$jsdir = $root.'/'.$config->js->path;
				
			//List views
			$this->view->doctype('XHTML11');
			$this->view->headTitle("Tao truyen | tusach24h.com");
			$this->view->imgdir = $imgdir;
			$this->view->cssdir = $cssdir;
			$this->view->jsdir = $jsdir;
			$this->view->root = $root;
			$this->view->title = "Tạo truyện";
		}
	}
	public function deleteAction()
	{
		$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
		Zend_Layout::startMvc($option);
		//Get root folder
		$base = $this->_request->getBaseUrl();
		//Get paths
		$imgdir = "$base/html/images";
		$cssdir = "$base/html/css";
		$jsdir = "$base/html/js";
		 
		//List views
		$this->view->doctype('XHTML11');
		$this->view->headTitle("Xoa truyen | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->title = "Xóa truyện";
	}
	public function editAction()
	{
		$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
		Zend_Layout::startMvc($option);
		//Get root folder
		$base = $this->_request->getBaseUrl();
		//Get paths
		$imgdir = "$base/html/images";
		$cssdir = "$base/html/css";
		$jsdir = "$base/html/js";
		 
		//List views
		$this->view->doctype('XHTML11');
		$this->view->headTitle("Danh sÃ¡ch truyá»‡n | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->title = "Comming soon";
	}
	public function censorAction()
	{
		$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
		Zend_Layout::startMvc($option);
		//Get root folder
		$base = $this->_request->getBaseUrl();
		//Get paths
		$imgdir = "$base/html/images";
		$cssdir = "$base/html/css";
		$jsdir = "$base/html/js";
		 
		//List views
		$this->view->doctype('XHTML11');
		$this->view->headTitle("Danh sach truyen | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->title = "Comming soon";
	}
	public function addpageAction()
	{
		$addpage = new Model_Story();
		
		if($this->_request->isPost())
		{
			$this->view->show_content = false;
			if(($_POST['func'] == 'getchapters') && is_numeric($_POST['storyid']))
			{
				echo $addpage->ListOne($_POST['storyid']);
			}
			if(($_POST['editor1'] != ''))
			{
				$this->view->show_content = false;
				$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
				Zend_Layout::startMvc($option);
				//Get root folder
				$root = $this->_request->getBaseUrl();
				//Get paths
				$imgdir = "$root/html/images";
				$cssdir = "$root/html/css";
				$jsdir = "$root/html/js";
				
				//List views
				$this->view->doctype('XHTML11');
				$this->view->headTitle("Them trang cho truyen | Admin Panel | tusach24h.com");
				$this->view->imgdir = $imgdir;
				$this->view->cssdir = $cssdir;
				$this->view->jsdir = $jsdir;
				$this->view->root = $root;
				$this->view->title = "Thêm trang cho truyện";
				$data = array(
						"TruyenID" => is_numeric($_POST['storyid']),
						"Chapter" => is_numeric($_POST['chapter']),
						"Name" => 'page',
						"Content" => htmlspecialchars('<div padding="40px">'.$_POST['editor1'].'</div>')
						);
				$addpage->InsertPage($data);
				echo 'Thêm truyện thành công.';
			}
		}
		else 
		{
			$this->view->show_content = true;
			$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
			Zend_Layout::startMvc($option);
			//Get root folder
			$root = $this->_request->getBaseUrl();
			//Get paths
			$imgdir = "$root/html/images";
			$cssdir = "$root/html/css";
			$jsdir = "$root/html/js";
				
			//List views
			$this->view->doctype('XHTML11');
			$this->view->headTitle("Them trang truyen | Admin Panel | tusach24h.com");
			$this->view->imgdir = $imgdir;
			$this->view->cssdir = $cssdir;
			$this->view->jsdir = $jsdir;
			$this->view->root = $root;
			$this->view->title = "Thêm trang truyện";
		}
	}
	public function readAction()
	{
		//Init model
		$story = new Model_Story();
		
		//Postback style
		if($this->_request->isPost())
		{
			$this->view->show_content = false;
			//Update cover
			if (($_POST['func'] == 'update_cover') && isset($_POST['position']) && isset($_POST['source']))
			{
				
			}
			//Load pages
			if (($_POST['func'] == 'load_page') && isset($_POST['seq']))
			{
				
			}
		}
		else
		{
			$this->view->show_content = true;
					
			//Config Layout
			$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
			Zend_Layout::startMvc($option);
				
			//Get root folder
			$root = $this->_request->getBaseUrl();
				
			//Get paths
			$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
			$imgdir = $root.'/'.$config->img->path;
			$cssdir = $root.'/'.$config->css->path;
			$jsdir = $root.'/'.$config->js->path;
		
			//List views
			$this->view->doctype('XHTML11');
			$this->view->headTitle("Tao bia | tusach24h.com");
			$this->view->imgdir = $imgdir;
			$this->view->cssdir = $cssdir;
			$this->view->jsdir = $jsdir;
			$this->view->root = $root;
			$this->view->title = "Tạo bìa cho truyện";
		}
	}
	public function updatecoversAction()
	{
		//Init model
		$story = new Model_Story();
		
		//Postback style
		if($this->_request->isPost())
		{
			$this->view->show_content = false;
			if(is_numeric($_POST['storyid']))
			{
				$text = 'Bạn vừa tạo ';
				if(isset($_POST['c_f_o_position']) && isset($_POST['c_f_o_source']))
				{
					$data = array(
							"TruyenID" => $_POST['storyid'],
							"Chapter" => '0',
							"Name" => $_POST['c_f_o_position'],
							"Content" => $_POST['c_f_o_source']
					);
					$story->InsertPage($data);
					$text .= 'bìa trước ngoài, '; 
				}
				if(isset($_POST['c_f_i_position']) && isset($_POST['c_f_i_source']))
				{
					$data = array(
							"TruyenID" => $_POST['storyid'],
							"Chapter" => '0',
							"Name" => $_POST['c_f_i_position'],
							"Content" => $_POST['c_f_i_source']
					);
					$story->InsertPage($data);
					$text .= 'bìa trước trong, '; 
				}
				if(isset($_POST['c_b_o_position']) && isset($_POST['c_b_o_source']))
				{
					$data = array(
							"TruyenID" => $_POST['storyid'],
							"Chapter" => '0',
							"Name" => $_POST['c_b_o_position'],
							"Content" => $_POST['c_b_o_source']
					);
					$story->InsertPage($data);
					$text .= 'bìa sau ngoài, '; 
				}
				if(isset($_POST['c_b_i_position']) && isset($_POST['c_b_i_source']))
				{
					$data = array(
							"TruyenID" => $_POST['storyid'],
							"Chapter" => '0',
							"Name" => $_POST['c_b_i_position'],
							"Content" => $_POST['c_b_i_source']
					);
					$story->InsertPage($data);
					$text .= 'bìa sau trong, '; 
				}
				$text .= 'thành công.';
				echo $text;
			}
		}
		else
		{
			$this->view->show_content = true;
				
			//Config Layout
			$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
			Zend_Layout::startMvc($option);
		
			//Get root folder
			$root = $this->_request->getBaseUrl();
		
			//Get paths
			$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
			$imgdir = $root.'/'.$config->img->path;
			$cssdir = $root.'/'.$config->css->path;
			$jsdir = $root.'/'.$config->js->path;
		
			//List views
			$this->view->doctype('XHTML11');
			$this->view->headTitle("Tao truyen | tusach24h.com");
			$this->view->imgdir = $imgdir;
			$this->view->cssdir = $cssdir;
			$this->view->jsdir = $jsdir;
			$this->view->root = $root;
			$this->view->title = "Đọc truyện";
		}
	}
	
	
	//CONVERTING...
	public function uploadAction()
	{
		$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
		Zend_Layout::startMvc($option);
	
		//Get root folder
		$root = $this->_request->getBaseUrl();
		
		//Get paths
    	$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
    	$imgdir = $root.'/'.$config->img->path;
    	$cssdir = $root.'/'.$config->css->path;
    	$jsdir = $root.'/'.$config->js->path;
    	
	
		//List views
		$this->view->doctype('XHTML11');
		$this->view->headTitle("Upload truyen | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->jsdir = $jsdir;
		$this->view->root = $root;
		$this->view->title = "Upload truyện";
	
	}
	public function uploadprocessAction()
	{
		//Config layout
		$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
		Zend_Layout::startMvc($option);
		
		//Get root folder
		$root = $this->_request->getBaseUrl();
		
		//Get paths
    	$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
    	$imgdir = $root.'/'.$config->img->path;
    	$cssdir = $root.'/'.$config->css->path;
    	$jsdir = $root.'/'.$config->js->path;
		
		//List views
		$this->view->doctype('XHTML11');
		$this->view->headTitle("Upload truyen | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->jsdir = $jsdir;
		$this->view->title = "Upload truyện";
		
		$allowedExts = "mobi";
		$extension = end(explode(".", $_FILES["file"]["name"]));
		$fileid = RandomID();
		if ($extension == $allowedExts)
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "lỗi: " . $_FILES["file"]["error"] . "<br />";
			}
			else
			{
				if (file_exists("upload/story_mobies/" . $fileid . '.' . $allowedExts))
				{
					echo "File " . $_FILES["file"]["name"] . " đã tồn tại. ";
				}
				else
				{
					move_uploaded_file($_FILES["file"]["tmp_name"], "upload/story_mobies/" . $fileid . '.' . $allowedExts);
					echo '<h3>Bước 2: chuyển đổi tập tin sang dạng text</h3>'. 
						 '<form action="'.$root.'/story/convert" method="post">'.
						 '<input name="story" type="hidden" value="'.$_POST["story"].'" />'.
						 '<input name="fileid" type="hidden" value="'.$fileid.'" />'.
						 'Tập tin: '. $_FILES["file"]["name"] . '<br/>' .
						 '<input type="submit" value="Chuyển" onclick="javascript:Loading();"/>'.
						 '</form>';
				}
			}
		}
		else
		{
			echo "File không hợp lệ. Vui lòng chọn tập tin .mobi";
		}
	}
	public function convertAction()
	{
		$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
		Zend_Layout::startMvc($option);
		
		//Get root folder
		$root = $this->_request->getBaseUrl();
		
		//Get paths
    	$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
    	$imgdir = $root.'/'.$config->img->path;
    	$cssdir = $root.'/'.$config->css->path;
    	$jsdir = $root.'/'.$config->js->path;
		
		//List views
		$this->view->doctype('XHTML11');
		$this->view->headTitle("Chuyen doi truyen | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->title = "Chuyển đổi truyện";
		
		if (isset($_POST['fileid']) && isset($_POST['story']))
		{
			$allowedExts = 'mobi'; 
			if (file_exists("upload/story_mobies/" . $_POST['fileid'] . '.' . $allowedExts))
			{
				if (preg_match("/Please wait... Your file is being converted now and this can take up to several minutes./", Convert($_POST['fileid'])))
				{
					echo '<h3>Bước 3: Nhận tập tin .text</h3>'.
							'<form action="'.$root.'/story/download" method="post">'.
							'<p>ID tập tin: '. $_POST['fileid'] . '</p>' .
							'<input name="id" type="hidden" value="'. $_POST['fileid'] .'" />'.
							'<input name="story" type="hidden" value="'.$_POST["story"].'" />'.
							'<input name="del_empty_line" id="cb" type="checkbox" /> <label for="cb">Bạn có muốn xóa các dòng trắng?</label>'.
							'<div><input type="submit" value="Nhận" onclick="javascript:Loading();" /></div>'.
							'</form>';
				}
				else
				{
					echo "Lỗi trong quá trình chuyển đổi. Xin thử lại. Cám ơn.";
				}
			}
			else
			{
				echo "Lỗi trong quá trình chuyển đổi. Xin thử lại. Cám ơn.";
			}
			
		}
		else 
		{
			echo "lỗi.";
		}
	}
	public function downloadAction()
	{
		//Init model
		$story = new Model_Story();
		
		//Config layout
		$option = array("layout" => "layout", "layoutPath" => APPLICATION_PATH . "/../html/");
		Zend_Layout::startMvc($option);
		
		//Get root folder
		$root = $this->_request->getBaseUrl();
		
		//Get paths
    	$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'tusach24h');
    	$imgdir = $root.'/'.$config->img->path;
    	$cssdir = $root.'/'.$config->css->path;
    	$jsdir = $root.'/'.$config->js->path;
		
		//List views
		$this->view->doctype('XHTML11');
		$this->view->headTitle("Tai truyen | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->title = "Tải truyện";
		
		if (isset($_POST['id']) && isset($_POST['story']))
		{
			$url = GetLinkMobiFile($_POST['id']);
			echo DownloadTextFile($_POST['id'], $url, $_POST['path']);
		}
		else if (isset($_POST['source']) && isset($_POST['truyenid']) && ($_POST['cbsource'] == 'on'))
		{
			$data = array(
					"Source" => $_POST['source']
					);
			$where = "TruyenID=".$_POST['truyenid'];
			try {
				$story->Update($data, $where);
				echo '<div style="font-weight: bold; font-size: 12px;">Thêm source thành công.</div>';
			} catch (Exception $e) {
				echo '<div style="font-weight: bold; font-size: 12px;">lỗi.</div>';
			}
		}
		else 
		{
			echo "lỗi.";
		}
	}
	
}


