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

include_once 'Net/POP3.php';

//$email = new Logic_Email();
//$retVal = $email->getAll();

// Create the class
$pop3 = new Net_POP3();

$user = "meraj@eme.org";
$pass = "khattak";
$host = EMAIL_HOST;
$port = EMAIL_PORT;

//$pop3->setDebug();

// Connect to localhost on usual port
// If not given, defaults are localhost:110

if(PEAR::isError( $ret= $pop3->connect($host , $port ) )){
    echo "ERROR: " . $ret->getMessage() . "\n";
    exit();
}


// Login using username/password. APOP will
// be tried first if supported, then basic.

//$pop3->login($user , $pass , 'APOP');
//$pop3->login($user , $pass , 'CRAM-MD5');

/*if($ret= $pop3->login($user , $pass,'USER' )){
    echo "ERROR: " . $ret->getMessage() . "\n";
    exit();
}*/


if(PEAR::isError( $ret= $pop3->login($user , $pass ) )){
    echo "ERROR: " . $ret->getMessage() . "\n";
    exit();
}

/*
if(PEAR::isError( $ret= $pop3->login($user , $pass , 'CRAM-MD5') )){
    echo "ERROR: " . $ret->getMessage() . "\n";
    exit();
}
*/


$a=$pop3->getListing();
echo "\n";
print_r($a);
//exit();


// Get the raw headers of message 1

echo "<h2>getRawHeaders()</h2>\n";
echo "<pre>" . htmlspecialchars($pop3->getRawHeaders(1)) . "</pre>\n";


// Get structured headers of message 1

echo "<h2>getParsedHeaders()</h2> <pre>\n";
print_r($pop3->getParsedHeaders(1));
echo "</pre>\n";


// Get body of message 1

echo "<h2>getBody()</h2>\n";
echo "<pre>" . htmlspecialchars($pop3->getBody(4)) . "</pre>\n";


// Get number of messages in maildrop

echo "<h2>getNumMsg</h2>\n";
echo "<pre>" . $pop3->numMsg() . "</pre>\n";


// Get entire message

echo "<h2>getMsg()</h2>\n";
echo "<pre>" . htmlspecialchars($pop3->getMsg(1)) . "</pre>\n";



// Get listing details of the maildrop
echo "<h2>getListing()</h2>\n";
echo "<pre>\n";
print_r($pop3->getListing());
echo "</pre>\n";


// Get size of maildrop

echo "<h2>getSize()</h2>\n";
echo "<pre>" . $pop3->getSize() . "</pre>\n";


// Disconnect
$pop3->disconnect();

?>