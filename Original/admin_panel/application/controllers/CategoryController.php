<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	//Init Model
    	$category = new Model_Category();
    	
    	//Postback style
    	if($this->_request->isPost())
    	{
    		$this->view->show_content = false;
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
    		
    		//Paginator
    		$paginator = Zend_Paginator::factory($category->ListAll());
    		$paginator->setItemCountPerPage(10);
    		$paginator->setPageRange(5);
    		$currentPage = $this->_request->getParam('page', 1);
    		$paginator->setCurrentPageNumber($currentPage);
    		
    		//List views
    		$this->view->doctype('XHTML11');
    		$this->view->headTitle("Quan ly the loai | Admin Panel | tusach24h.com");
    		$this->view->title = "Liệt kê thể loại A-Z";
    		$this->view->imgdir = $imgdir;
    		$this->view->cssdir = $cssdir;
    		$this->view->jsdir = $jsdir;
    		$this->view->data = $paginator;
    	}
    }
	public function createAction()
	{
		//Init model
		$category = new Model_Category();
		
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
		$this->view->headTitle("Tạo the loai | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->jsdir = $jsdir;
		$this->view->title = "Tạo thể loại";

		if(isset($_POST['create']) && isset($_POST['title']))
		{
			try {
				$this->view->show_content = false;
				if ($category->IsUnique($_POST['title']))
				{
					if ((strlen($_POST['title']) < 3) || (strlen($_POST['title']) > 32))
					{
						echo '<div style="font-weight: bold; font-size: 12px;">Tên thể loại không hợp lệ. Phải từ 3 kí tự trở lên.</div>';
					}
					else 
					{
						$data = array(
								'Title' => $_POST['title']
						);
						$category->Insert($data);
						echo 'Thêm thành công.<script type="text/javascript">setTimeout(function(){window.location="http://'.$this->getRequest()->getHttpHost(). $root.'/category";},2000);</script>';
					}
				}
				else
				{
					echo '<div style="font-weight: bold; font-size: 12px;">Thể loại này đã tồn tại.</div>';
				}
			} catch (Exception $e) {
				echo '<div style="font-weight: bold; font-size: 12px;">Lỗi.</div>';
			}
		}
		else 
		{
			$this->view->show_content = true;
		}
		
	}
	public function deleteAction()
	{
		//Init model
		$category = new Model_Category();
		
		//Config Layout
		$this->view->show_content = true;
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
		$this->view->headTitle("Xoa the loai | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->jsdir = $jsdir;
		$this->view->title = "Xóa thể loại";
		
		$id = $this->_request->getParam('id');
		
		if (is_numeric($id))
		{
			if ($category->IsExist($id))
			{
				try {
					$category->Delete($id);
					echo '<div style="font-weight: bold; font-size: 12px;">Xóa thành công.</div><script type="text/javascript">setTimeout(function(){window.location="http://'.$this->getRequest()->getHttpHost(). $root.'/category";},2000);</script>';
				} catch (Exception $e) {
					echo '<div style="font-weight: bold; font-size: 12px;">Lỗi. Vẫn còn truyện thuộc thể loại này.</div>';
				}
			}
			else
			{
				echo '<div style="font-weight: bold; font-size: 12px;">Lỗi.</div>';
			}	
		}
		else
		{
			echo '<div style="font-weight: bold; font-size: 12px;">Lỗi.</div>';
		}
	}
	public function editAction()
	{
		//Init model
		$category = new Model_Category();
		
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
		$this->view->headTitle("Sua the loai | Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->jsdir = $jsdir;
		$this->view->title = "Sửa thể loại";
		
		if(isset($_POST['edit']) && isset($_POST['id']) && isset($_POST['title']))
		{
			$this->view->show_content = false;
			if (is_numeric($_POST['id']))
			{
				if ($category->IsExist($_POST['id']))
				{
					if ($category->IsUnique($_POST['title']))
					{
						$data = array(
								'Title' => $_POST['title']
						);
						$category->Update($data, 'CategoryID='.$_POST['id']);
						echo $category->IsUnique($_POST['title']);
						echo 'Sửa thành công.<script type="text/javascript">setTimeout(function(){window.location="http://'.$this->getRequest()->getHttpHost(). $root.'/category/edit/id/'.$_POST['id'].'";},2000);</script>';
						
					}
					else 
					{
						echo '<div style="font-weight: bold; font-size: 12px;">Thể loại này đã tồn tại.</div>';
					}
				}
				else
				{
					echo '<div style="font-weight: bold; font-size: 12px;">Lỗi.</div>';
				}
			}
			else 
			{
				echo '<div style="font-weight: bold; font-size: 12px;">Lỗi.</div>';
			}
		}
		else
		{
			$this->view->show_content = false;
			$id = $this->_request->getParam('id');
			if (is_numeric($id))
			{
				if ($category->IsExist($id))
				{
					$this->view->show_content = true;
					$this->view->id = $id;
					$title = $category->ListOne($id);
					$this->view->cattitle = $title[0];
				}
				else
				{
					echo '<div style="font-weight: bold; font-size: 12px;">Lỗi.</div>';
				}
			}
			else
			{
				echo '<div style="font-weight: bold; font-size: 12px;">Lỗi.</div>';
			}
		}
	}
}

