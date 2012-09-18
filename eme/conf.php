<?php
/**
 * This file provides defining system variables
 * @package 		EME
 * @copyright		Copyright (c) 2011   
 * @author 			Meraj Khattak 
 * 
 */

//main app directory
define("APP_DIR", "E:/work/www/eme/");
define("APP_URL", "/eme/");

//include required files
require_once("log4php/Logger.php");
require_once(APP_DIR . 'models/logic/utils.php');

//define db settings
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "vu_eme");

//define email settings
define("EMAIL_HOST", "localhost");
define("EMAIL_PORT", 110);

//define smtp settings
define("SMTP_HOST", "localhost");
define("SMTP_PORT", 25);

//set log config path
define("LOG_CONFIG", APP_DIR . "log4php.xml");

//set version
define("VERSION", "1.0");
?>
