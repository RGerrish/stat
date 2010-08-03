<?php
/**
 *Main Class
 *@package stat
 *@version 1.0
 *@desc Contains core funcationality for the program
 */
 
class main extends configuration {
	
  /**
   *@method main::clean_input
   *@param String $string
   *@desc This method preforms a real-escape-string and htmlentities and returns string
   *@return returns DB ready formatting of string
   */
   
   public function clean_input($string){
     $string = $this->db->escape_string($string);
	 $string = htmlentities($string);
	 $string = trim($string);
	 return $string;
   }
  
  /**
   *@method main::debug
   *@param string $string string to be debugged
   *@param string $type type of debugging operation to perform
   *@desc This method will return debugging information to specified users
   *@return string debugging information to the selected user
   */
   
   public function debug($string, $type = NULL){
	 if (!$this->config['DEBUG'] == 1) { 
	   return;
	 }else{
	   switch($type) { 
	    case 'dump':
		  $debug_output = '<pre>' . var_dump($string) . '</pre>';
		break;
		default:
		  $debug_output = '<pre>' . print_r($string) . '</pre>';   
	  }
	    return $debug_output;
	 }
   }
}

