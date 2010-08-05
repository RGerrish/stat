<?php

/**
 * Base File 
 * @package stat
 * @version 1.0
 * @desc This file initates auto loading function for the classes and nessicary includes
 */
/**
 * @todo Set .htaccess file to auto_prepend base.php
 */
/**
 * Check Version of PHP. Minimum Version Required is 5.0
 */
if (phpversion() < "5.0") {
  die("Your version of PHP is " . phpversion() . ". STAT requires a minimum PHP version of 5.0");
}

/**
 * @param string $class Class name
 */
function __autoload($class) {
  require_once 'frameworks/sfyaml.php';
  require_once 'classes/' . $class;
}

?>
