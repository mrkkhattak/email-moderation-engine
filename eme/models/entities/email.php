<?php
/**
 * Email Moderation Engine
 * 
 * This class provides simple getter / setter for email
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

class Entities_Email
{
	private $id;
	private $uid;
	private $msgid;	
	private $flag;
	private $reminder;	
		
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
	
	public function getUID(){
		return $this->uid;
	}
	public function setUID($uid){
		$this->uid=$uid;
	}

	public function getMsgID(){
		return $this->msgid;
	}
	public function setMsgID($msgid){
		$this->msgid=$msgid;
	}		
	
	public function getFlag(){
		return $this->flag;
	}
	public function setFlag($flag){
		$this->flag=$flag;
	}

	public function getReminder(){
		return $this->reminder;
	}
	public function setReminder($reminder){
		$this->reminder=$reminder;
	}
	
}
?>