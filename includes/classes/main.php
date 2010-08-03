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

  /**
   *@method main::set_error
   *@param string $error error string to be ouputted
   *@param string $type type of error to output. Choice is error, or notice, success
   *@desc This method will set any required errors
   */

	 public function set_error($error, $type){
	   $_SESSION['error'][$type][] = $error;
	 }

	/**
   *@method main::display_errors
   *@desc This method will output errors
	 *@return string returns the html of the errors
	 */

	 public function display_errors(){
		 //Errors
		if($_SESSION['error']['error']){
		 $output .= '<ul>';
		 foreach($_SESSION['error']['error'] as $error){
			 $output .= "<li class='stat-error'>" . $error . "</li>";
		 }
		 $output .= '</ul>';
		}

		//Warnings
	  if($_SESSION['error']['notice']){
		 $output .= '<ul>';
		 foreach($_SESSION['error']['notice'] as $notice){
			 $output .= "<li class='stat-notice'>" . $notice . "</li>";
		 }
		 $output .= '</ul>';
		}

		//Success(s)
		if($_SESSION['error']['success']){
		 $output .= '<ul>';
		 foreach($_SESSION['error']['success'] as $success){
			 $output .= "<li class='stat-success'>" . $success . "</li>";
		 }
		 $output .= '</ul>';
		}
		//Destory Variable
		unset($_SESSION['error']);
	 }

}

