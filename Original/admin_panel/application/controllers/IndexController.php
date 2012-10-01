<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
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
		$this->view->headTitle("Admin Panel | tusach24h.com");
		$this->view->imgdir = $imgdir;
		$this->view->cssdir = $cssdir;
		$this->view->jsdir = $jsdir;
		$this->view->title = "Trang quản lý tusach24h.com";
    }


}

