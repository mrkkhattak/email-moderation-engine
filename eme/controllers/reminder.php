<?php
/**
 * Email Moderation Engine
 * 
 * This page provides basic operations for controlling reminder 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

require_once APP_DIR. 'models/entities/reminder.php';
require_once APP_DIR. 'models/logic/reminder.php';

//get unique id for email
if (isset($_GET["uid"]) && !empty($_GET["uid"])) {
	$unique_id = $_GET["uid"];	
}

//check if a flag is supposed to be removed
$delete=null;
if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
	$delete = $_GET["delete"];	
}


// instantiate logic
$reminderLogic = new Logic_Reminder();

if ($delete == 1){
	$reminderLogic->delete($unique_id);

	//redirect to main page
	Utils::redirect(APP_URL ."index.php?action=inbox&message=reminder&type=delete");	
}
else {
	//make sure page is posted
	if (isset($_POST["save"])) {
		
		$day = $_POST["day"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$hour = $_POST["hour"];
		$minutes = $_POST["minutes"];
	
		//set in correct date format
		$date = $year."-".$month."-".$day." ".$hour.":".$minutes.":00";
		
		//set in entity
		$reminder = new Entities_Reminder();
		$reminder->setUID($unique_id);
		$reminder->setUserID(1);
		$reminder->setDate($date);
		
		//now add to database
		$reminderLogic->add($reminder);
		
		//redirect to main page
		Utils::redirect(APP_URL ."index.php?action=inbox&message=reminder");
	}
}

//include template at end
include APP_DIR . 'templates/reminder.php';
?>