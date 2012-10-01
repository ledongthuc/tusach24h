<?php
define('APPLICATION_PATH', dirname(__FILE__) . '/application');
set_include_path(APPLICATION_PATH. '/../library'); 
require_once('Zend/Application.php');
require_once(APPLICATION_PATH . '/includes/functions.php');
$application = new Zend_Application( 
    "production", 
    APPLICATION_PATH . '/configs/application.ini' 
); 
$application->bootstrap()->run(); 
?>