<?php
/**
 * Email Moderation Engine
 * 
 * This page provides basic operations for controlling followup 
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

if ($_SESSION['user_id'] && !empty($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
}

	//get curent date time
	$current_date = date('Y-m-d G:i');
	$current_date_time = $current_date .":00";
	
	//now read from database
	$reminderLogic = new Logic_Reminder();
	$reminders = $reminderLogic->checkReminder($current_date_time, $user_id);
	
	//process the reminders 
	if (count($reminders) > 0 ){
		//redirect to followup
		Utils::redirect(APP_URL ."index.php?action=inbox&reminder=yes");							
	}
	else {
		//redirect to main page
		Utils::redirect(APP_URL ."index.php?action=inbox");		
	}
?>