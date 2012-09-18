<?php
/**
 * Email Moderation Engine
 * 
 * This class provides simple getter / setter for reminder
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

class Entities_Reminder
{
	private $id;
	private $uid;
	private $user_id;
	private $date;	
		
    /**
     * Class constructer
     * It provides the class name to log.
     * 
     */	 	
	
	public function __construct(){
		//Log::info("Entities_Reminder is called.");
	}
	
	public function getID(){
		return $this->id;
	}
	public function setID($id){
		$this->id=$id;
	}	

	public function getUID(){
		return $this->uid;
	}
	public function setUID($uid){
		$this->uid=$uid;
	}	
	
	public function getUserID(){
		return $this->user_id;
	}
	public function setUserID($user_id){
		$this->user_id=$user_id;
	}	
	
	public function getDate(){
		return $this->date;
	}
	public function setDate($date){
		$this->date=$date;
	}
	
}
?>