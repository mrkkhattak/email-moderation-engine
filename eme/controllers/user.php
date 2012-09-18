<?php
/**
 * Email Moderation Engine
 * 
 * This page provides basic operations for controlling user 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

include APP_DIR . 'models/logic/user.php';

//get unique id for email
if (isset($_GET["action"]) && !empty($_GET["action"])) {
	$action = $_GET["action"];
	
	$userLogic = new Logic_User();
	
	//logout
	if ($action == "logout") {
		
		//get loggedin user
		$user_id = Utils::getLoggedInUser();
		
		if ($userLogic->logout($user_id) == true){
			//redirect to main page
			Utils::redirect(APP_URL ."index.php?action=login");			
		}
		else {
			//redirect to main page
			Utils::redirect(APP_URL ."index.php?action=login");					
		}
	}
	//login
	else {
		if (isset($_POST["login"])) {			
			$user = new Entities_User();
			$user->setEmail($_POST["email"]);
			$user->setPassword($_POST["password"]);

			//login user
			if ($userLogic->login($user) == true){
				
				//redirect to main page
				Utils::redirect(APP_URL ."index.php?action=inbox");
			}
		}
	}
}

//include template at end
include APP_DIR . 'templates/user.php';
?>