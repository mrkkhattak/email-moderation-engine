<?php 
//show info messages
$ret_message=null;
$ret_type=null;
$message=null;
$type=null;
$reminder=null;

//save message and its type
if (isset($_GET["message"]) && !empty($_GET["message"])) {
	$ret_message = $_GET["message"];	
}

if (isset($_GET["type"]) && !empty($_GET["type"])) {
	$ret_type = $_GET["type"];	
}
if (isset($_GET["reminder"]) && !empty($_GET["reminder"])) {
	$ret_reminder = $_GET["reminder"];	
}

//prepare message
if ($ret_type == "delete"){
	$msg = " has been deleted successfully.";
}
else if ($ret_message == "login") {
	$message = "You are already logged in.";	
}
else if ($ret_message == "sent") {
	$msg = "Your message has been sent.";	
}
else {
	$msg = " has been saved successfully.";
}

//final message
if ($ret_message != "login" || $ret_message != "sent"){
	$message = ucwords($ret_message) . $msg;
}

//add entity
if ($ret_message != null) {
	echo '<div id="message" align="center">';
	echo '<span class="message-info">'. $message .'</span>';
	echo '</div>';	
}

if (!empty($ret_reminder)){
	echo '<div id="message" align="center">';
	echo '<span class="message-followup">There are some message(s) in priority pane, which require(s) your followup.</span>';
	echo '</div>';	
}

?>
