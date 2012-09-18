<?php
/**
 * Email Moderation Engine
 * 
 * This page provides basic operations for controlling flag 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

require_once APP_DIR. 'models/entities/flag.php';
require_once APP_DIR. 'models/logic/flag.php';

//get unique id for email
if (isset($_GET["uid"]) && !empty($_GET["uid"])) {
	$unique_id = $_GET["uid"];	
}

//check if a flag is supposed to be removed
if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
	$delete = $_GET["delete"];	
}

// instantiate logic
$flagLogic = new Logic_Flag();

$delete=null;
if ($delete == 1){
	$flagLogic->delete($unique_id);

	//redirect to main page
	Utils::redirect(APP_URL ."index.php?action=inbox&message=flag&type=delete");	
}
else {
	//make sure page is posted
	if (isset($_POST["save"])) {
		$flag_post = $_POST["flag"];
		
		//set in entity
		$flag = new Entities_Flag();
		$flag->setUID($unique_id);
		$flag->setUserID(1);
		$flag->setFlag($flag_post);
		
		//now add to database
		$flagLogic->add($flag);
		
		//redirect to main page
		Utils::redirect(APP_URL ."index.php?action=inbox&message=flag");
	}
}

//include template at end
include APP_DIR . 'templates/flag.php';
?>