<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
    }

    public function indexAction()
    {
        // action body
        //$user = new User();
        //$data = $user->getAdapter()->fetchAll()->toArray();
        //print_r($data);
        //echo check_string_db_available('user', 'Username', 'khanhbc');
    	//$public_key = '6LfyetQSAAAAAGsmGBMAmCCtoEfXdPRksEnnFFwf';
    	//$private_key = '6LfyetQSAAAAAKlJvPNF55f4df3ou00n9z5JUbaN';
    	//echo check_captcha_match('03AHJ_VuvlI0UvAT2gFztxzQiTsAUbhZLURhPlWh1OuMQlHdco5zuJMlVYN2OfxCdehxbeO4OuCKzLyaUhK0CH9_e0B5jSlackb6D5wdKJiSocCbyXzsK8N-_99L415YyInmdqF9Qw9C9mFeEzsPNYp8z-hlB5kThv5g', 'Conte) wslavisi', $public_key, $private_key);
    	//Get root folder
    	//$this->_redirect('/user/');
    	//echo $ip = $this->getRequest()->getServer('REMOTE_ADDR');
    	//BẮT BIẾN GET POST AJAX
    	/*
    	if($this->_request->isPost())
    	{
    		echo $this->_request->getPost('id');
    	}
    	
    	if($this->_request->isGet())
    	{
    		echo $this->_request->getQuery('id');
    	}
    	
    	if($this->_request->isXmlHttpRequest())
    	{
    		echo $this->_request->getQuery("id");
    	}
    	*/
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
}