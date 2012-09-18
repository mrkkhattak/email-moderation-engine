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
require_once APP_DIR. 'models/entities/user.php';

class Logic_User extends Logic
{
    
    /**
     * Class constructer
     * It provides the class name to the constructer to log.
     * 
     */	    
	
	public function __construct() {
    	parent::__construct("Logic_User");
    }
     
    /**
     * Gets all user from the db.
     *
     * @return $retVal
     */	    
    
    public function getAll(){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setOrderBy("id");
	        $this->getDB()->executeSelect("user",true);
	        $ct=0;
	        while($this->getDB()->next()){
	        	$temp = new Entities_User();
	        	$temp->setID($this->getDB()->getValue("id"));
	        	$temp->setName($this->getDB()->getValue("name"));
	        	$temp->setEmail($this->getDB()->getValue("email"));
	        	$temp->setPassword($this->getDB()->getValue("password"));
	        	$temp->setLoggedIn($this->getDB()->getValue("loggedin"));
	        	
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
     * Get email information according to the specific given user id.
     *
     * @param numeric $id
     * @return $retVal
     */	    
    
    public function get($id){
    	try{
    		$this->RefreshDB();
	        $retVal=NULL;
	        $this->getDB()->setNumCondition("id", $id);
	        $this->getDB()->executeSelect("user",true);
	        if($this->getDB()->next()){
	        	$retVal = new Entities_User();
	        	$retVal->setID($this->getDB()->getValue("id"));
	        	$retVal->setName($this->getDB()->getValue("name"));
	        	$retVal->setEmail($this->getDB()->getValue("email"));
	        	$retVal->setPassword($this->getDB()->getValue("password"));	 
	        	$retVal->setLoggedIn($this->getDB()->getValue("loggedin"));       	
	        }
	        return $retVal;
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of $user and add to the database
     *
     * @param string $user
     * @return
     */	

    public function add($user){
    	try{
			$this->RefreshDB();
        	$this->getDB()->setNumValue("id", $user->getID());
        	$this->getDB()->setStrValue("name", $user->getName());
        	$this->getDB()->setStrValue("email", $user->getEmail());
        	$this->getDB()->setStrValue("password", $user->getPassword());
        	$this->getDB()->setNumValue("loggedin", $user->getLoggedIn());
			$this->getDB()->executeInsert("user");			
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    } 
    
    /**
     * Gets a parameter of updated $user and update the database accordingly
     *
     * @param string $user
     * @return 
     */	    
    
    public function update($user){
    	try{
	    	$this->RefreshDB();
        	$this->getDB()->setNumCondition("id", $user->getID());
        	$this->getDB()->setStrValue("name", $user->getName());
        	$this->getDB()->setStrValue("email", $user->getEmail());
        	$this->getDB()->setStrValue("password", $user->getPassword());
        	$this->getDB()->setNumValue("loggedin", $user->getLoggedIn());        	
			$this->getDB()->executeUpdate("user", true);
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
	    	$this->getDB()->executeDelete("user",true);    		
    	}
    	catch(Exception $e){
    		throw $e;
    	}
    }  

    /**
     * Check for given user and email and register in session if true
     * otherwise return false
     *
     * @param string $user
     * @return boolean
     */
    
    public function login($user){
    	try {   		
    		$this->RefreshDB();
	        $this->getDB()->setStrCondition("email", $user->getEmail());
	        $this->getDB()->setStrCondition("password", $user->getPassword());
	        $this->getDB()->executeSelect("user",true);
	        if($this->getDB()->next()){
	        	$user_id = $this->getDB()->getValue("id");	        
	        	
        		$_SESSION['is_logged_in'] = true;
        		$_SESSION['user_id'] = $user_id;
        		
   				//also update logon state
   				$this->updateLoginState($user_id, 1);
        		
        		return true;
	        }
	        else {
				return false;	        	
	        }
    	}
    	catch(Exception $e){
    		throw $e;		
    	}
    }
   
    /**
     * Check for given user and email and register in session if true
     * otherwise return false
     *
     * @param numeric $user_id 
     * @return boolean
     */
    
    public function logout($user_id){
    	try {    		
    		if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
   				$_SESSION['is_logged_in'] = null;
   				$_SESSION['user_id'] = null;
   				
   				//also update logon state
   				$this->updateLoginState($user_id, 0);
   				
   				return true;
    		}
    		else {
    			return false;
    		}
    	}
    	catch(Exception $e){
    		throw $e;		
    	}
    }

    /**
     * Update table for logon state: where state:
     *
     * @params string $user_id
     * @param numeric $state
     */
    
    private function updateLoginState($user_id, $state){
        try {        	
	    	$this->RefreshDB();
        	$this->getDB()->setNumCondition("id", $user_id);
        	$this->getDB()->setNumValue("loggedin", $state);        	
			$this->getDB()->executeUpdate("user", true);
    	}
    	catch(Exception $e){
    		throw $e;	
    	}
    }
}
?>