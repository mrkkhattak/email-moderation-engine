<?php
/**
 * Email Moderation Engine
 * 
 * This class provides util methods for logic 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

/* includes */
require_once APP_DIR. 'models/logic/db.php';

class Logic extends DB {
	
    private $messages = NULL;
    protected $db= NULL;
    protected $fileName= NULL;
    protected $logger;
        
	public function __construct($fileName){
		//Logger::configure(LOG_CONFIG);
		//$this->logger =& Logger::getLogger('SYMBOL_LOOKUP');		
		
        $this->fileName = $fileName;
        //$this->logger->info("Logic.__consturct(): File ".$fileName." is called.");
	}    
    
	public function getMessages(){
		return $this->messages;
	}
	
	public function addMessage($message){
		$this->messages[]=$message;
	}

	public function addMessages($messages){
		foreach($messages as $val){
			$this->messages[]=$val;
		}
	}
	
	public function RefreshDB(){
		if ($this->db == NULL){
	        $this->db = new DB();
	        $this->db->setHolderFile($this->fileName);
	    }
	    else{
	        $this->db->clear();
	    }
	}
	
	public function getDB(){
		return $this->db;
	}
}
?>