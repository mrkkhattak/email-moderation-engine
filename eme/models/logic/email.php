<?php
/**
 * Email Moderation Engine
 * 
 * This class provides basic operations of get / write to database for email 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

/* includes */
require_once APP_DIR. 'models/logic/logic.php';
require_once APP_DIR. 'models/entities/email.php';

class Logic_Email extends Logic
{
    
    /**
     * Class constructer
     * It provides the class name to the constructer to log.
     * 
     */	    
	
	public function __construct() {
    	parent::__construct("Logic_Email");
    }
     
    /**
     * Gets all emails from the db.
     *
     * @return $retVal
     */	    
    
    public function getAll(){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setOrderBy("id");
	        $this->getDB()->executeSelect("email",true);
	        $ct=0;
	        while($this->getDB()->next()){
	        	$temp = new Entities_Email();
	        	$temp->setID($this->getDB()->getValue("id"));
	        	$temp->setUID($this->getDB()->getValue("uid"));
	        	$temp->setFlag($this->getDB()->getValue("flag"));
	        	$temp->setReminder($this->getDB()->getValue("reminder"));
	        	
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
     * Get email information according to the specific given email id.
     *
     * @param numeric $id
     * @return $retVal
     */	    
    
    public function get($id){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setNumCondition("id", $id);
	        $this->getDB()->executeSelect("email",true);
	        if($this->getDB()->next()){
	        	$retVal = new Entities_Email();
	        	$retVal->setID($this->getDB()->getValue("id"));
	        	$retVal->setUID($this->getDB()->getValue("uid"));
	        	$retVal->setFlag($this->getDB()->getValue("flag"));
	        	$retVal->setReminder($this->getDB()->getValue("reminder"));
	        }
	        return $retVal;
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of $email and add to the database
     *
     * @param string $email
     * @return
     */	

    public function add($email){
    	try{
			$this->RefreshDB();
        	$this->getDB()->setNumValue("id", $email->getID());
        	$this->getDB()->setNumValue("uid", $email->getUID());
        	$this->getDB()->setNumValue("flag", $email->getFlag());
        	$this->getDB()->setNumValue("reminder", $email->getReminder());
			$this->getDB()->executeInsert("email");			
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of updated $email and update the database accordingly
     *
     * @param string $email
     * @return 
     */	    
    
    public function update($email){
    	try{
	    	$this->RefreshDB();
        	$this->getDB()->setNumCondition("id", $email->getID());
        	$this->getDB()->setNumValue("uid", $email->getUID());
        	$this->getDB()->setNumValue("flag", $email->getFlag());
        	$this->getDB()->setNumValue("reminder", $email->getReminder());
			$this->getDB()->executeUpdate("email", true);
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }

    /**
     * Delete the specific email 
     *
     * @param numeric $id
     * @return 
     */
    
    public function delete($id){
    	try{
	    	$this->RefreshDB();
	    	$this->getDB()->setNumCondition("id",$id);
	    	$this->getDB()->executeDelete("email",true);    		
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }   
}
?>