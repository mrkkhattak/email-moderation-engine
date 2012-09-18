<?php
/**
 * Email Moderation Engine
 * 
 * This page provides basic operations for controlling email view 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

include APP_DIR . 'models/logic/user.php';
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

//get unique id for email
if (isset($_GET["mid"]) && !empty($_GET["mid"])) {
	$message_id = $_GET["mid"];	
}

$emailHeaders = $pop3->getParsedHeaders($message_id);
$emailBody = $pop3->getBody($message_id);

//include template at end
include APP_DIR . 'templates/view.php';

// disconnect at totally page end
$pop3->disconnect();
?>