<?php

/**
 *STAT News Class Documenation
 *This class is the news  class for STAT. It extends main 
 */
 

news extends note{

/* Properties */

int public $id 			    /* The auto inc database id */
string public $author		/* The author of the news item */
string public $title		/* The title of the news item */
string public $content		/* The content of the news item */
int public $beg_date		/* The beginning date the news item was published */
int public $end_date		/* The ending date the news item was published */
int public $order		/* The order id of the news item */
int public $deleted		/* Status of the news item being deleted */
int public $published		/* Status of the news approval (if needed) */


/* Methods */

void public __construct(int $id) 	/* This constructs the function and sets news  properties if id is provided */
void public retrieve_news_item($int)  	/* This function actually does the pull from the database for the note */
array public retrieve_all_news_items(int $visible=1, int $deleted=0) /* This function returns news items based upon parameter */ 
void public save_news(void)	 	/* This function saves the news item to the database */
void public update_news(void)    	/* This function updates the news item in the database */
void public delete_news(void)    	/* This function "deletes" a news item */
}
?>
