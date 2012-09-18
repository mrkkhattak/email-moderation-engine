<?php
/**
 * Email Moderation Engine
 * 
 * This class provides basic operations of get / write to database for flag 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

/* includes */
require_once APP_DIR. 'models/logic/logic.php';
require_once APP_DIR. 'models/entities/flag.php';

class Logic_Flag extends Logic
{
    
    /**
     * Class constructer
     * It provides the class name to the constructer to log.
     * 
     */	    
	
	public function __construct() {
    	parent::__construct("Logic_Flag");
    }
     
    /**
     * Gets all flag from the db.
     *
     * @return $retVal
     */	    
    
    public function getAll(){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setOrderBy("id");
	        $this->getDB()->executeSelect("flag",true);
	        $ct=0;
	        while($this->getDB()->next()){
	        	$temp = new Entities_Flag();
	        	$temp->setID($this->getDB()->getValue("id"));
	        	$temp->setUID($this->getDB()->getValue("uid"));
	        	$temp->setUserID($this->getDB()->getValue("user_id"));
	        	$temp->setFlag($this->getDB()->getValue("flag"));
	        	
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
     * Gets all flags from the db for given user.
     *
     * @return $retVal
     */	    
    
    public function getAllForUser($user_id){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setOrderBy("id");
	        $this->getDB()->setNumCondition("user_id", $user_id);
	        $this->getDB()->executeSelect("flag",true);
	        $ct=0;
	        while($this->getDB()->next()){
	        	$temp = new Entities_Flag();
	        	$temp->setID($this->getDB()->getValue("id"));
	        	$temp->setUID($this->getDB()->getValue("uid"));
	        	$temp->setUserID($this->getDB()->getValue("user_id"));
	        	$temp->setFlag($this->getDB()->getValue("flag"));
	        	
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
     * Get email information according to the specific given flag id.
     *
     * @param numeric $id
     * @return $retVal
     */	    
    
    public function get($id){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setNumCondition("id", $id);
	        $this->getDB()->executeSelect("flag",true);
	        if($this->getDB()->next()){
	        	$retVal = new Entities_Flag();       	
	        	$retVal->setID($this->getDB()->getValue("id"));
	        	$retVal->setUID($this->getDB()->getValue("uid"));
	        	$retVal->setUserID($this->getDB()->getValue("user_id"));	        	
	        	$retVal->setFlag($this->getDB()->getValue("flag"));        	
	        }
	        return $retVal;
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of $flag and add to the database
     *
     * @param string $flag
     * @return
     */	

    public function add($flag){
    	try{
			$this->RefreshDB();
        	//$this->getDB()->setNumValue("id", $flag->getID());
        	$this->getDB()->setNumValue("uid", $flag->getUID());
        	$this->getDB()->setNumValue("user_id", $flag->getUserID());
        	$this->getDB()->setStrValue("flag", $flag->getFlag());
			$this->getDB()->executeInsert("flag");			
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of updated $flag and update the database accordingly
     *
     * @param string $flag
     * @return 
     */	    
    
    public function update($flag){
    	try{
	    	$this->RefreshDB();
        	$this->getDB()->setNumCondition("id", $flag->getID());
        	$this->getDB()->setNumValue("uid", $flag->getUID());
        	$this->getDB()->setNumValue("user_id", $flag->getUserID());        	
        	$this->getDB()->setStrValue("flag", $flag->getFlag());      	
			$this->getDB()->executeUpdate("flag", true);
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }

    /**
     * Delete the specific flag 
     *
     * @param numeric $id
     * @return 
     */
    
    public function delete($uid){
    	try{
	    	$this->RefreshDB();
	    	$this->getDB()->setNumCondition("uid",$uid);
	    	$this->getDB()->executeDelete("flag",true);    		
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }   
}
?>