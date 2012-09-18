<?php
/**
 * Email Moderation Engine
 * 
 * This page provides basic operations for controlling inbox 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

include APP_DIR . 'models/logic/reminder.php';
include APP_DIR . 'models/logic/flag.php';
include APP_DIR . 'models/logic/user.php';
include APP_DIR . 'models/entities/email.php';
include_once 'Net/POP3.php';

//get user name and password
$user_id = Utils::getLoggedInUser();
$userLogic = new Logic_User();
$user = $userLogic->get($user_id);

//create the class
$pop3 = new Net_POP3();

//connect to pop server
if(PEAR::isError( $ret= $pop3->connect(EMAIL_HOST , EMAIL_PORT))){
    echo "ERROR: " . $ret->getMessage() . "\n";
    exit();
}

//login
if(PEAR::isError( $ret= $pop3->login($user->getEmail(), $user->getPassword()))){
    echo "ERROR: " . $ret->getMessage() . "\n";
    exit();
}

//get emails 
$noOfMsgs = $pop3->numMsg();
$listing = $pop3->getListing();

//get reminder
$reminderLogic = new Logic_Reminder();
$userReminders = $reminderLogic->getAllForUser($user_id);

//get flag
$flagLogic = new Logic_Flag();
$userFlags = $flagLogic->getAllForUser($user_id);

//prepare listing for priority emails
foreach ($listing as $key => $newemail){
	foreach ($userFlags as $flag){
		if ($flag->getUID() == $newemail["uidl"]){
			$priority_listing[] = $newemail;
			unset($listing[$key]);
		}
	}
}

//check for reminders in pemail
foreach ($priority_listing as $plist){
	
	$email = new Entities_Email();	
	foreach ($userReminders as $reminder){
		if ($reminder->getUID() == $plist["uidl"]){
			$email->setReminder($reminder->getID());
			$email->setUID($plist["uidl"]);
			$email->setMsgID($plist["msg_id"]);
		}
		else {
			$email->setUID($plist["uidl"]);
			$email->setMsgID($plist["msg_id"]);
		}
	}
	
	//save in array and return
	$emails[] = $email;
}

//include template at end
include APP_DIR . 'templates/inbox.php';

// disconnect at totally page end
$pop3->disconnect();
?>