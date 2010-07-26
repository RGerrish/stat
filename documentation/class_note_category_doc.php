<?php

/**
 *STAT Category Class Documenation
 *This class is the main note taking class for STAT. It extends note 
 */
 

note_category extends note{

/* Properties */

int public $id 			 /* The auto inc database id */
string public $name		 /* The name of the category */
int public $access		 /* The access level required to view this category */
int public $visible		 /* Is this "deleted"? */

/* Methods */

void public __construct(int $id) 	/* This constructs the function and sets category  properties if id is provided */
void public retrieve_category(void)  	/* This function actually does the pull from the database for the note */
void public save_category(void)	 	/* This function saves the note to the database */
void public update_category(void)    	/* This function updates the note in the database */
void public delete_category(void)    	/* This function "deletes" a note */
void public get_notes_by_id(int $id)    /* This function collects the notes based upon a category id*/

}
?>
