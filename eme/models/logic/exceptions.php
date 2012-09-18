<?php
/**
 * Email Moderation Engine
 *
 * Exceptions, which provides exceptions handling classes and methods
 *  
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

class DatabaseException extends Exception {
	
	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
		//$this->logger->error($message);
		echo "ERROR:" . $message;		
	}
}

class ApplicationException extends Exception{

	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}

}

class FatalException extends Exception{

	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
		//$this->logger->error($message);
		echo "ERROR:" . $message;
	}

}

class AccessDeniedException extends Exception{

	public function __construct() {
		parent::__construct(NULL, 0);
	}

}

?>