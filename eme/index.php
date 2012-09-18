<?php
/**
 * This class provides basic operations of email client
 * @package 		EME
 * @copyright		Copyright (c) 2011   
 * @author 			Meraj Khattak 
 * 
 */

require_once("conf.php");

//start session
session_start();

if (isset($_GET["action"]) && !empty($_GET["action"])) {
	$action = $_GET["action"];

	//save state of loggedin
	if (isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == true){
		$loggedin = true; 	
	}
	else {
		$loggedin = false;
	}
	
	//redirect to pages accordingly
	if ($loggedin == false){
		include APP_DIR. 'controllers/user.php';
	}
	else {
		//open appropriate pages
		if ($action == "reminder"){ 
			include APP_DIR. 'controllers/reminder.php';
		}
		else if ($action == "followup"){ 
			include APP_DIR. 'controllers/followup.php';
		}		
		else if ($action == "flag"){ 
			include APP_DIR. 'controllers/flag.php';
		}
		else if ($action == "view"){ 
			include APP_DIR. 'controllers/view.php';
		}
		else if ($action == "compose"){ 
			include APP_DIR. 'controllers/compose.php';
		}		
		else if ($action == "logout"){ 
			include APP_DIR. 'controllers/user.php';
		}
		else if ($action == "login"){
			//redirect to main page
			Utils::redirect(APP_URL ."index.php?action=inbox&message=login");					
		}
		else {
			include APP_DIR. 'controllers/inbox.php';
		}
	}
}
else {
	Utils::redirect(APP_URL ."index.php?action=login");
}
?>