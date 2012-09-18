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
include_once "Mail.php";

//get user name and password
$user_id = Utils::getLoggedInUser();
$userLogic = new Logic_User();
$user = $userLogic->get($user_id);
 
if (isset($_POST["send"])) {
	
	$from = "meraj@eme.org";
	$to = $_POST["to"];
	$cc = $_POST["cc"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	
	$username = "meraj@eme.org";
	$password = "khattak";

	$headers = array ('From' => $from,
  		'To' => $to,
  		'Subject' => $subject);
		$smtp = Mail::factory('smtp',
  		array ('host' => SMTP_HOST,
    		'auth' => true,
    		'username' => $username,
    		'password' => $password));

	//send email
	$mail = $smtp->send($to, $headers, $message);

	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
	} else {
		echo("<p>Message successfully sent!</p>");
	}

	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
	} else {		
		//redirect to main page
		Utils::redirect(APP_URL ."index.php?action=inbox&message=sent");
	}					
}	


//include template at end
include APP_DIR . 'templates/compose.php';
?>