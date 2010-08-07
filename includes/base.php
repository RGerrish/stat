<?php

/**
 * Base File 
 * @package stat
 * @version 1.0
 * @desc This file initates auto loading function for the classes and nessicary includes
 */
@session_start();
/**
 * Check Version of PHP. Minimum Version Required is 5.0
 */
if (phpversion() < "5.0") {
  die("Your version of PHP is " . phpversion() . ". STAT requires a minimum PHP version of 5.0");
}

/**
 * @method debug
 * @access public
 * @param string The string to be debugged
 */
function debug($string) {
  if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '192.168.0.2' || $_SERVER['REMOTE_ADDR'] == '70.40.219.151') {
    echo '<pre>' . print_r($string, true) . '</pre>';
  } else {
    return;
  }
}

/**
 * @method __autoload
 * @access private
 * @param string String name of class to be loaded
 *
 */
function __autoload($class) {

  if (file_exists('includes/classes/' . $class . '.php')) {
    include('includes/classes/' . $class . '.php');
  }

  if (file_exists('includes/frameworks/' . $class . '.php')) {
    include('includes/frameworks/' . $class . '.php');
  }
}
?>

