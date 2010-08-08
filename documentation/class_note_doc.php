<?php

/**
 *STAT Note Class Documenation
 *This class is the main note taking class for STAT. It extends main 
 */
 

note extends main{

/* Properties */

int public $id 			 /* The auto inc database id */
int public $cid 		 /* CID of the student */
int public $date		 /* unix timestamp of the date */
int public $category_id  	 /* category id (foreign key of note category table */
string public $summary  	 /* summary of note */
string public $private_summary /* summary only viewable to admins */
string public $author    		 /* person submitting the note */
int public $duration   		 /* duration of training session (in seconds) */
string public $training_items 	 /* Items covered on the training notes (a serialized array) */
array public $amend_items	 /* grabbed from a seperate table */

/* Methods */

void public retrieve_note_by_id(void)  	/* This function actually does the pull from the database for the note */
void public save(void)	 	/* This function saves the note to the database */
void public delete(void)    	/* This function "deletes" a note */
void public retrieve_amendments(void)   /* This function collects the note amendments */
void public delete_amendment(void) 	/* This function deletes an amendment to a note */
void public insert_amendment(void) 	/* This function inserts an amendment to a note */ 
}

} 
?>
