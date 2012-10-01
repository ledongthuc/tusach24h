<?php

class ComicController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
    }

    public function indexAction()
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
    		$this->view->headTitle("Trang chu | tusach24h.com");
    		$this->view->imgdir = $imgdir;
    		$this->view->cssdir = $cssdir;
    		$this->view->jsdir = $jsdir;
    	}
    }	
	
    public function createAction()
    {
    	//$request = $this->getRequest();
    	//$this->view->comic = $request->getParam('user');
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
    		$this->view->headTitle("Trang chu | tusach24h.com");
    		$this->view->imgdir = $imgdir;
    		$this->view->cssdir = $cssdir;
    		$this->view->jsdir = $jsdir;
    	}
    }
    
    public function addpagesAction()
    {
    }
    
}