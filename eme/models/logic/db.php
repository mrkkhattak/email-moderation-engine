<?php
/**
 * Email Moderation Engine
 * 
 * This class provides utility operations for db 
 * @package 		EME
 * @copyright		Copyright (c) 2012   
 * @author 			Meraj Rasool Khattak 
 * 
 */

include "exceptions.php";

class DB{
	private $values=NULL;
	private $conditions=NULL;
	private $selections=NULL;
	private $orderBy=NULL;
	private $sortBy=NULL;	
	private $result=NULL;
	private $cols=NULL;
	private $con;
	private $debug=true;
	private $currentRow=NULL;
	private $recordsPerPage = -1;
	private $holderFile = "Utils_DB";
	
	//db settings
	private $dbhost = DB_HOST;
	private $dbuser = DB_USER;
	private $dbpassword = DB_PASSWORD;
	private $dbname = DB_NAME;
	protected $logger;
	
	//initialize db connection and logger
	public function __construct(){
		$this->con = $this->getConnection();

		//Logger::configure(LOG_CONFIG);
		//$this->logger =& Logger::getLogger('EME');
	}
	
	protected function getConnection(){		
		$mysqli = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
		$mysqli->autocommit(true);
		return $mysqli;
	}
	
	public function setDebug($debug){
		$this->debug = $debug;
	}
	
	public function setHolderFile($holderFile){
		$this->holderFile = $holderFile;
	}
		
	public function enablePaging($recordsPerPage){
		$this->recordsPerPage = $recordsPerPage;
	}

	public function disablePaging(){
		$this->recordsPerPage = -1;
	}	
	
	public function setNumValue($colname, $value){
		//$this->values[$colname] = $value;
		$this->setStrValue($colname, $value);
	}

	public function setUncheckedNumValue($colname, $value){
		$this->values[$colname] = $value;
	}

	public function setStrValue($colname, $value){
		$this->values[$colname] = "'" . $this->escape($value) . "'";
	} 

	private function setCondition($colname, $value, $operator){
		$cond = new Condition($value,$operator);
		$this->conditions[$this->escape($colname)] = $cond;
	}

	public function setUncheckedNumCondition($colname, $value, $operator = '='){
		$this->setCondition($colname, $value, $operator);
	}
	
	public function setNumCondition($colname, $value, $operator = '='){		
		if(strtolower($value) == "null"){
			$this->setCondition($colname, $value, $operator);
		}
		else if(strtolower($operator) <> "in" and strtolower($operator) <> "not in"){			
			$this->setStrCondition($colname, $value, $operator);
		}
		else{
			$value = $this->escapeInValues($value);
			$this->setCondition($colname, $value, $operator);
		}
	}
	
	private function escapeInValues($values){
		$values = trim($values);
		$values = substr($values,0,strlen($values)-1);
		$values = substr($values,1,strlen($values));
		$valuesArray = explode(",",$values);
		foreach ($valuesArray as $key=>$v){
			$v = trim($v);
			if(substr($v, 0, 1) == "'"){
				$v = substr($v, 0, strlen($v)-1);
				$v = substr($v, 1, strlen($v));
				$valuesArray[$key] = "'" . $this->escape($v) . "'";
			}
			else{
				$valuesArray[$key] = $this->escape($v);
			}
		}
		return "(" . implode(",",$valuesArray) . ")";
	}

	public function setStrCondition($colname, $value, $operator = '='){
		$this->setCondition($colname, "'" . $this->escape($value) . "'", $operator);
	}

	public function setSelection($column){
		$this->selections[] = $column;
	}

	public function setOrderBy($orderBy, $sort="ASC"){
		$this->orderBy = $orderBy;
		$this->sortBy = $sort;
	}

	public function clearValues(){
		$this->values=NULL;
	}

	public function clearConditions(){
		$this->conditions=NULL;
	}

	public function clearSelections(){
		$this->selections=NULL;
	}

	public function clear(){
		$this->clearValues();
		$this->clearConditions();
		$this->clearSelections();
		$this->orderBy=NULL;
		$this->sortBy=NULL;
	}

	private function resetValues(){
		if ($this->values!=NULL)
			reset($this->values);
	}

	private function resetConditions(){
		if ($this->conditions!=NULL)
			reset($this->conditions);
	}

	private function resetSelections(){
		if ($this->selections!=NULL)
			reset($this->selections);
	}

	public function resetAll(){	
		$this->clearValues();
		$this->clearConditions();
		$this->clearSelections();
	}
	
	public function getAutoGeneratedId(){
		return $this->con->insert_id;
	}

	public function execute($sqlwithnoresult){		
		
		// first we check if there are any erros in establishing a connection
		if (mysqli_connect_error()){
			throw new DatabaseException("Connetion failed due to (". mysqli_connect_error() .") Please check configuration file to fix database permissions.");
		}		
		else {
			if($this->debug==true){
				//$this->logger->debug("Executing Query: " . $sqlwithnoresult . " - Number of rows affected: " . $this->con->affected_rows);
			}
			
			//echo "Executing Query: " . $sqlwithnoresult . " - Number of rows affected: " . $this->con->affected_rows;
	
			if (!$this->con->query($sqlwithnoresult)){
				throw new DatabaseException("File: {".$this->holderFile."} " . "Unable to execute query { $sqlwithnoresult } due to error {". $this->con->error ."}");
			}
		}
	}

	public function executeQuery($sqlwithresult, $pageNumber=1, $fromSelect=1){

		// if it is being called from selectQuery
		if ($fromSelect == 1){
			// if we have paging enabled on this 
			if($this->recordsPerPage <> -1){
				$sqlwithresult .= " limit ". (($pageNumber -1) * ($this->recordsPerPage)) . " , " . $this->recordsPerPage;
			}
		}

		
		// first we check if there are any erros in establishing a connection
		if (mysqli_connect_error()){
			throw new DatabaseException("Connetion failed due to (". mysqli_connect_error() .") Please check configuration file to fix database permissions.");
		}
		else {
			if($this->debug==true){
				//$this->logger->debug("Executing Query: " . $sqlwithresult . " - Number of rows returned");
			}		
	
			if ($this->result = $this->con->query($sqlwithresult)){
				 $this->cols = $this->result->fetch_fields();
				 $this->currentRow=NULL;
			}
			else{
				throw new DatabaseException("File: {".$this->holderFile."} " . "Unable to execute query { $sqlwithresult } due to error {". $this->con->error ."}");
			}
		}
		
		//echo $sqlwithresult;
	}
	
	public function tableExists($tableName){

		//run query
		$this->executeQuery("SHOW TABLES LIKE '" .$tableName ."'");	
		
		//save the result array in retval 
        $resultArray = $this->nextArray();
        while($resultArray <> null){
			$retVal[] = $resultArray;
			$resultArray = $this->nextArray();
        }			
		
        //if retval is empty return false
        if (empty($retVal) ){
        	return false;
        }
        
        //otherwise return true
        else {
        	return true;
        }
	}
	
	public function size(){
		return $this->result->num_rows;
	}

	public function next(){
		if ($row = $this->result->fetch_row()) {
			for ($ct=0; $ct < count($this->cols); $ct++){
				$temp=$this->cols[$ct]->table . "." . $this->cols[$ct]->name;
				if ($this->cols[$ct]->table == "_self"){
					$temp=$this->cols[$ct]->name;
				}
				//echo $temp . " : " . $row[$ct] . "<br>";
				$this->currentRow[$temp] = $row[$ct];
			}
			return true;
		}
		else{
			return false;
		}
	}
	
	public function nextArray(){
		return $this->result->fetch_array();
	}

	public function getValue($colname, $stripSlashes=false){
		
		if ($stripSlashes == true){
			return stripslashes($this->currentRow[$colname]);
		}
		else {
			// here we are explicitly asking to not remove slashes
			return $this->currentRow[$colname];
		}
	}

	public function getNonColumnValue($colname){
		return $this->currentRow["." . $colname];
	}

	public function getTotalRecordCount($tableName, $all){
		$this->executeSelect($tableName,$all,null,"count(*) cnt"); $this->next();
		return $this->getNonColumnValue("cnt");
	}
	
	public function executeSelect($tableName, $all, $pageNumber=1, $query_selection=null){
		$this->resetSelections();
		$this->resetConditions();
		if($query_selection == null){
			$sel = "";
			if ($this->selections != NULL){
				while(list($no, $value) = each($this->selections)){
					$sel = $sel  . "$value,";
				}
				$sel= substr($sel,0,strlen($sel)-1);
			}
			else{
				$sel="*";
			}
			$query = "select $sel from $tableName _self";
		}
		else{
			$query = "select $query_selection from $tableName _self";
		}

		if(count($this->conditions)>0){
			$query = $query . " where ";
		}		
		
        $operator = " and ";
		
		if($all != true) $operator = " or  " ;
		
		if (count($this->conditions)>0){
			while(list($colname, $colvalue) = each($this->conditions)){
				$query = $query  . "$colname" . " " . $colvalue->getOperator() . " " . $colvalue->getValue() . $operator;
			}
			$query= substr($query,0,strlen($query)-5);
		}
		if($this->orderBy!=NULL){
			$query = "$query order by $this->orderBy $this->sortBy";
		}
		
		if($this->recordsPerPage <> -1 and $query_selection == null){
			$query .= " limit ". (($pageNumber -1) * ($this->recordsPerPage)) . " , " . $this->recordsPerPage;
		}
		
		$this->executeQuery($query, $pageNumber=1, $fromSelect=2);
	}

	public function executeInsert($tableName){
		$this->resetValues();
		$query = "insert into $tableName (";
		while(list($colname, $colvalue) = each($this->values)){
			$query = $query  . "$colname,";
		}
		$query= substr($query,0,strlen($query)-1) . ") values (";
		$this->resetValues();
	
		while(list($colname, $colvalue) = each($this->values)){
			//currently it is only handling gmtEndOfDay here
			if ($colvalue == "''"){
				if ($colname == "gmtEndOfDay"){
					$colvalue='NULL';
					$query = $query  . $colvalue .",";
				}
				else {
					$query = $query  . $colvalue .",";
				}
			}
			else {
				$query = $query  . "$colvalue,";
			}
		}		
		$query= substr($query,0,strlen($query)-1) . ")";
		$this->execute($query);
	}

	public function executeUpdate($tableName, $all){
		$this->resetValues();
		$this->resetConditions();
		$query = "update $tableName set ";
		while(list($colname, $colvalue) = each($this->values)){
			
			//2615
			if ($colvalue == "''"){
				$colvalue='NULL';
				$query = $query  . "$colname=$colvalue,";
			}
			else {
				$query = $query  . "$colname=$colvalue,";
			}
		}
		
		$query= substr($query,0,strlen($query)-1);
		$operator = " and ";
		
		if($all != true) $operator = " or  " ;
		
		if (count($this->conditions)>0){
			$query = $query . " where ";
			while(list($colname, $colvalue) = each($this->conditions)){
				$query = $query  . "$colname" . " " . $colvalue->getOperator() . " " . $colvalue->getValue() . $operator;
			}
			$query= substr($query,0,strlen($query)-5);
		}
		$this->execute($query);
	}

	public function executeDelete($tableName, $all){
		$this->resetConditions();
		$query="delete from $tableName ";
		$operator = " and ";

		if($all != true) $operator = " or  " ;
		
		if (count($this->conditions)>0){
			$query = $query . " where ";
			while(list($colname, $colvalue) = each($this->conditions)){
				$query = $query  . "$colname" . " " . $colvalue->getOperator() . " ". $colvalue->getValue() . $operator;
			}
			$query= substr($query,0,strlen($query)-5);
		}
		$this->execute($query);			
	}

	private function escape($str){
		return $this->con->real_escape_string($str);
	}
}

class Condition{
	private $val;
	private $op;

	public function __construct($val, $op) {
		$this->val = $val;
		$this->op = $op;
	}

	public function getValue() {
		return $this->val;
	}

	public function getOperator() {
		return $this->op;
	}

	public function setValue($val) {
		$this->val = $val;
	}

	public function setOperator($op) {
		$this->op = $op;
	}
}
	
?>