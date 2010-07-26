<?php

/**
 *STAT Note Class Documenation
 *This class is the main note taking class for STAT. It extends main 
 */
 

note extends main{

/* Properties */

int public $id 			 /* The auto inc database id */
int public $cid 		 /* CID of the student */
string public $fname 		 /* The first name of the student */
string public $lname 		 /* The last name of the student */
timestamp public $date		 /* unix timestamp of the date */
int public $category_id  	 /* category id */
string public $summary  	 /* summary of note */
string public $user    		 /* person submitting the note */
int public $duration   		 /* duration of training session (in seconds) */
string public $training_items 	 /* Items covered on the training notes */
array public $note_error	 /* Errors created for note class */
array public $amend_items	 /* Note Ammendments add to the specific note */

/* Methods */

void public __construct(int $id) 	/* This constructs the function and sets note properties if id is provided */
void public retrieve_note(void)  	/* This function actually does the pull from the database for the note */
void public save_note(void)	 	/* This function saves the note to the database */
void public update_note(void)    	/* This function updates the note in the database */
void public delete_note(void)    	/* This function "deletes" a note */
void public retrieve_amendments(void)   /* This function collects the note amendments */
void public delete_amendment(void) 	/* This function deletes an amendment to a note */
void public insert_amendment(void) 	/* This function inserts an amendment to a note */ 
}

} 
?>
