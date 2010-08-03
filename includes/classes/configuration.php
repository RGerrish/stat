<?php
/**
 *Configuration Class
 *@package stat
 *@version 1.0
 *@desc This file contains loads the configuration parameters and internationalization files
 */
class configuration {

 /*Properties*/

 /**
  * @global lang
  * @desc Contains language array
  */
 public $lang;

 /**
  * @global db
  * @desc Contains the database objects
  */

 public $db;

 /**
  * @global config
  * @desc Contains the configuration parameters
  */

 public $config;


 /**
   * @method configuration::__construct()
   * @desc Initalizes the configuration class
   */
  public function __construct(){
    $this->parse_yaml(); 
    $this->init_db(); 
    $this->set_php_vars();
  }

  /**
   * @method configuration::init_db
   * @desc This function initates the database variables
   * @returns Array of database objects
   */
  private function init_db(){
     /**
      * @todo Initalize database informations based upon presence of DBA
      */
  }

  /**
   * @method configuration::parse_yaml
   * @desc Parses the various YAML files required for use
   * @return array Returns associative array of parsed config and internationalization file
   */
  private function parse_yaml(){
    $yml = new sfYamlParser();

    try {
      $this->config = $yml->parse(file_get_contents('../config/config.yaml'));
    }

    catch (InvalidArgumentException $e){
      die("Unable to parse the STAT Configuration File: ".$e->getMessage());
    }

    try{
      $this->lang = $yml->parse(file_get_contents('../l18n/' . $config['LANG'] . '.yml'));
    }

    catch (InvalidArgumentException $e){
      die("Unable to parse the STAT Language file: ".$e->getMessage());
    }
  }

  /**
   * @method configuration::parse_yaml
   * @desc This method sets misc PHP variables
   * @return true
   */
  private function set_php_vars(){

		//Set Timezone
	  date_default_timezone_set($this->config['TIMEZONE']);

		//Set Timeout
		set_time_limit('60');
		ini_set('upload_max_filesize', '10M');
		ini_set('post_max_size', '15M');

  }
}
?>
