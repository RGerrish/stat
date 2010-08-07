<?php

/**
 * Configuration Class
 * @package stat
 * @version 1.0
 * @desc This file contains loads the configuration parameters and internationalization files
 */
class configuration {
  /* Properties */

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
   * @desc Contains the database strings
   */
  public $config;

  /**
   * @method configuration::__construct()
   * @desc Initalizes the configuration class
   */
  public function __construct() {
    $this->parse_yaml();
    $this->init_db();
    $this->set_php_vars();
  }

  /**
   * @method configuration::init_db
   * @desc This function initates the database variables
   * @returns Array of database object
   */
  public function init_db() {

    require_once 'MDB2.php';

    //Create DB String(s)
    $conn['STAT'] = $this->config['STAT_DBTYPE'] . '://' . $this->config['STAT_DBUSER'] .
      ':' . $this->config['STAT_DBPASS'] . '@' . $this->config['STAT_DBHOST'] . '/' .
      $this->config['STAT_DB'];
    $conn['USER'] = $this->config['USER_DBTYPE'] . '://' . $this->config['USER_DBUSER'] .
      ':' . $this->config['USER_DBPASS'] . '@' . $this->config['USER_DBHOST'] . '/' .
      $this->config['USER_DB'];

    $this->db['STAT'] = & MDB2::factory($conn['STAT']);
    $this->db['USER'] = & MDB2::factory($conn['USER']);

    //Sets Fetch mode to associative array, must pass MDB2_FETCHMODE_ORDERED
    //for normal ordered array

    $this->db['STAT']->setFetchMode(MDB2_FETCHMODE_ASSOC);
    $this->db['USER']->setFetchMode(MDB2_FETCHMODE_ASSOC);
  }

  /**
   * @method configuration::parse_yaml
   * @desc Parses the various YAML files required for use
   * @return array Returns associative array of parsed config and internationalization file
   */
  public function parse_yaml() {
    $yml = new sfYamlParser();

    try {
      if (!$yml->parse(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/includes/config/config.yml'))) {
        throw new InvalidArgumentException('Unable to parse the STAT Configuration File: config.yml');
      } else {
        $this->config = $yml->parse(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/includes/config/config.yml'));
      }
      if (!$yml->parse(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/includes/l18n/' . $this->config['LANG'] . '.yml'))) {
        throw new InvalidArgumentException('Unable to parse the STAT Language File: ' . $this->config['LANG'] . '.yml');
      } else {
        $this->lang = $yml->parse(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/includes/l18n/' . $this->config['LANG'] . '.yml'));
      }
    } catch (InvalidArgumentException $e) {
      die($e->getMessage());
    }
  }

  /**
   * @method configuration::parse_yaml
   * @desc This method sets misc PHP variables
   * @return true
   */
  public function set_php_vars() {

    //Set Timezone
    date_default_timezone_set($this->config['TIMEZONE']);

    //Set Timeout
    set_time_limit('60');
    ini_set('upload_max_filesize', '10M');
    ini_set('post_max_size', '15M');
  }

}

?>
