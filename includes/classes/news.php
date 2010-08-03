<?php
/**
 *News Class
 *@package stat
 *@version 1.0
 *@desc This file contains the functions for the news class
 */

class news extends main{

 /**
  * @global $news_id
  * @desc This variable contiains the auto increment value of the news item
  */
  public $news_id;

	/**
	 *@global $author
	 *@desc The author of the news item
	 */
	public $author;

	/**
	 *@global $title
	 *@desc The title of the news item
	 */
  public $title;

	/**
	 *@global $content
	 *@desc The content of the news item
	 */
	public $content;

	/**
	 * @global $beg_date
	 * @desc A unix timestamp of the beginning date
	 */
	public $beg_date;

	/**
	 *@global $end_date
	 *@desc A unix timestamp of the ending date
	 */
	public $end_date;

	/**
	 *@global $order
	 *@desc The order int of the news item
	 */
  public $order;

	/**
	 * @global $deleted
	 * @desc Status of deletion for the news item. 0 for deleted, 1 for not deleted
	 */
	public $deleted;

	/**
	 *@global $published
	 *@desc Determines if the news item is published. 1 if so, 0 if not
	 */
	public $published;

	}