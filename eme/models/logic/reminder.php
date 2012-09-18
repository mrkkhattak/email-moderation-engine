<?php
/**
 * Email Moderation Engine
 * 
 * This class provides basic operations of get / write to database for reminder 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

/* includes */
require_once APP_DIR. 'models/logic/logic.php';
require_once APP_DIR. 'models/entities/reminder.php';

class Logic_Reminder extends Logic
{
    
    /**
     * Class constructer
     * It provides the class name to the constructer to log.
     * 
     */	    
	
	public function __construct() {
    	parent::__construct("Logic_Reminder");
    }
     
    /**
     * Gets all reminders from the db.
     *
     * @return $retVal
     */	    
    
    public function getAll(){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setOrderBy("id");
	        $this->getDB()->executeSelect("reminder",true);
	        $ct=0;
	        while($this->getDB()->next()){
	        	$temp = new Entities_Reminder();
	        	$temp->setID($this->getDB()->getValue("id"));
	        	$temp->setUID($this->getDB()->getValue("uid"));
	        	$temp->setUserID($this->getDB()->getValue("user_id"));
	        	$temp->setDate($this->getDB()->getValue("date"));
	        	
	        	$retVal[$ct]=$temp;
	        	$ct++;
	        }
	        
	        return $retVal;
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }

    /**
     * Gets all reminders from the db.
     *
     * @param numeric $user_id
     * @return array $retVal
     */	    
    
    public function getAllForUser($user_id){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setOrderBy("id");
	        $this->getDB()->setNumCondition("user_id", $user_id);
	        $this->getDB()->executeSelect("reminder",true);
	        $ct=0;
	        while($this->getDB()->next()){
	        	$temp = new Entities_Reminder();
	        	$temp->setID($this->getDB()->getValue("id"));
	        	$temp->setUID($this->getDB()->getValue("uid"));
	        	$temp->setUserID($this->getDB()->getValue("user_id"));
	        	$temp->setDate($this->getDB()->getValue("date"));
	        	
	        	$retVal[$ct]=$temp;
	        	$ct++;
	        }
	        return $retVal;
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    
    /**
     * Get email information according to the specific given reminder id.
     *
     * @param numeric $id
     * @return $retVal
     */	    
    
    public function get($id){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setNumCondition("id", $id);
	        $this->getDB()->executeSelect("reminder",true);
	        if($this->getDB()->next()){
	        	$retVal = new Entities_Reminder();        	
	        	$retVal->setID($this->getDB()->getValue("id"));
	        	$retVal->setUID($this->getDB()->getValue("uid"));
	        	$retVal->setUserID($this->getDB()->getValue("user_id"));	        	
	        	$retVal->setDate($this->getDB()->getValue("date"));        	
	        }
	        return $retVal;
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of $reminder and add to the database
     *
     * @param string $reminder
     * @return
     */	

    public function add($reminder){
    	try{
			$this->RefreshDB();
        	$this->getDB()->setNumValue("id", $reminder->getID());
        	$this->getDB()->setNumValue("uid", $reminder->getUID());
        	$this->getDB()->setNumValue("user_id", $reminder->getUserID());
        	$this->getDB()->setStrValue("date", $reminder->getDate());
			$this->getDB()->executeInsert("reminder");			
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of updated $reminder and update the database accordingly
     *
     * @param string $reminder
     * @return 
     */	    
    
    public function update($reminder){
    	try{
	    	$this->RefreshDB();
        	$this->getDB()->setNumCondition("id", $reminder->getID());
        	$this->getDB()->setNumValue("uid", $reminder->getUID());
        	$this->getDB()->setNumValue("user_id", $reminder->getUserID());        	
        	$this->getDB()->setStrValue("date", $reminder->getDate());      	
			$this->getDB()->executeUpdate("reminder", true);
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }

    /**
     * Delete the specific reminder 
     *
     * @param numeric $id
     * @return 
     */
    
    public function delete($uid){
    	try{
	    	$this->RefreshDB();
	    	$this->getDB()->setNumCondition("uid",$uid);
	    	$this->getDB()->executeDelete("reminder",true);    		
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }
    
    /**
     * This checks database for the given date and if date has reached it 
     * returns true 
     *
     * @param string $date
     * @param $string $user_id 
     * @return boolean
     */
    public function checkReminder($date, $user_id=false){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;    		
	        $this->getDB()->setStrCondition("date", $date);
	        
	        if (!empty($user_id)){
	        	$this->getDB()->setNumCondition("user_id", $user_id);
	        }
	        $this->getDB()->executeSelect("reminder",true);
	        $ct=0;
	        while($this->getDB()->next()){
	        	$temp = new Entities_Reminder();
	        	$temp->setID($this->getDB()->getValue("id"));
	        	$temp->setUID($this->getDB()->getValue("uid"));
	        	$temp->setUserID($this->getDB()->getValue("user_id"));
	        	$temp->setDate($this->getDB()->getValue("date"));
	        	
	        	$retVal[$ct]=$temp;
	        	$ct++;
	        }
	        return $retVal;
    	}
    	catch (Exception $e){
    		throw $e;
    	}
    }
}
?>