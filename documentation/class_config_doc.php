<?php

/**
 *STAT Configuration Class Documenation
 *This is the first class loaded, and parses YAML files for config/internationalization
 *as well as setting various php variables needed and substantiating db object 
 */
 
config {

/* Properties */

public $db      /* The main DB Object for STAT */
public $config  /* The config variable housing the parsed YAML config file */
public $lang    /* The internationalization file */


/* Methods */

public __construct(void) /*Initiates the class */
private initiate_db(void)  /*This intiates the $db varible using params parsed from the config file */
private parse_yaml_files(void) /* This parses the config YAML and Internationalization YAML files. Sets the $config, $lang properties*/
private set_php_vars(void)  /* This sets any required PHP Variables for the STAT System*/


} 
?>
