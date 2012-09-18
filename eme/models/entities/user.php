<?php
/**
 * Email Moderation Engine
 * 
 * This class provides simple getter / setter for user
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

class Entities_User
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $loggedin;		
		
    /**
     * Class constructer
     * It provides the class name to log.
     * 
     */	 	
	
	public function __construct(){
		//Log::info("Entities_Company_Client is called.");
	}
	
	public function getID(){
		return $this->id;
	}
	public function setID($id){
		$this->id=$id;
	}	

	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name=$name;
	}

	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email=$email;
	}

	public function getPassword(){
		return $this->password;
	}
	public function setPassword($password){
		$this->password=$password;
	}

	public function getLoggedIn(){
		return $this->loggedin;
	}
	public function setLoggedIn($loggedin){
		$this->loggedin=$loggedin;
	}	
	
}
?>