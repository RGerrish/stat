<?php

/**
 * News Class
 * @package stat
 * @version 1.0
 * @desc This file contains the functions for the news class
 */
class news extends main {

  /**
   * @global $news_id
   * @desc This variable contiains the auto increment value of the news item
   */
  public $news_id;
  /**
   * @global $author
   * @desc The author of the news item
   */
  public $author;
  /**
   * @global $title
   * @desc The title of the news item
   */
  public $title;
  /**
   * @global $content
   * @desc The content of the news item
   */
  public $content;
  /**
   * @global $beg_date
   * @desc A unix timestamp of the beginning date
   */
  public $beg_date;
  /**
   * @global $end_date
   * @desc A unix timestamp of the ending date
   */
  public $end_date;
  /**
   * @global $order
   * @desc The order int of the news item
   */
  public $order;
  /**
   * @global $deleted
   * @desc Status of deletion for the news item. 0 for deleted, 1 for not deleted
   */
  public $deleted;
  /**
   * @global $published
   * @desc Determines if the news item is published. 1 if so, 0 if not
   */
  public $published;

  /**
   * @method news::load_news_from_id
   * @param int $news_id
   * @desc Sets the values of the class
   */
  public function load_news_from_id($news_id) {

    $sql = & $this->db['STAT']->prepare("SELECT * FROM " . $this->config['STAT_DBPREFIX'] . "news WHERE id=?");
    $result = & $sql->execute($news_id);
    if (PEAR::isError($result)) {
      return false;
    }
    $row = $result->fetchRow();
    $this->news_id = $row['news_id'];
    $this->author = $row['author'];
    $this->title = $row['title'];
    $this->beg_date = $row['beg_date'];
    $this->end_date = $row['end_date'];
    $this->order = $row['order'];
    $this->deleted = $row['deleted'];
    $this->published = $row['published'];
  }

  /**
   * @method news::retrieve_all_news_items
   * @param bool $within_date pull items based upon publish start and expiry date, true or false
   * @param int $published 0 if non visible items, 1 if visible
   * @param int $deleted 0 to select non-deleted items, 1 to select deleted items
   * @desc Retrieves all news items depending on parameters
   * @return array Returns array of news items if success, false if fails
   */
  public function retrieve_all_news_items($within_date, $published=1, $deleted=0) {
    $time = time();
    if ($within_date) {
      $where = "((beg_date < $time) AND (end_date > $time)) AND";
    }
    $sql = & $this->db['STAT']->prepare("SELECT * FROM " . $this->config['STAT_DBPREFIX'] . "news WHERE $where published=? and deleted=?");
    $result = & $sql->execute(array($published, $deleted));
    if (PEAR::isError($result)) {
      return false;
    }
    while ($row = $result->fetchRow()) {
      $data[] = $row;
    }
    return $data;
  }

  /**
   * @method news::save
   * @desc Retrieves all news items depending on parameters
   * @return Returns true if success, false if fails
   */
  function save() {
    $sql = & $this->db['STAT']->prepare("SELECT * FROM " . $this->config['STAT_DBPREFIX'] . "news WHERE id=?");
    $result = & $sql->execute($this->id);
    if ($result->numRows() == 0) {
      $sql = & $this->db['STAT']->prepare("INSERT INTO" . $this->config['STAT_DBPREFIX'] . "news(
        author,title,content,beg_date,end_date,order,deleted,published)VALUES(
        ?,?,?,?,?,?,?,?)");
      $result = & $this->db['STAT']->execute(array(
          $this->author,
          $this->title,
          $this->beg_date,
          $this->end_date,
          $this->order,
          $this->deleted,
          $this->published
        ));
    } else {
      $sql = & $this->db['STAT']->prepare("UPDATE " . $this->config['STAT_DBPREFIX'] . "news SET
        author = ?, 
        title = ?, 
        beg_date = ?, 
        end_date = ?, 
        order = ?, 
        deleted = ?, 
        published = ? WHERE id = ?");
      $result = & $this->db['STAT']->execute(array(
          $this->author,
          $this->title,
          $this->beg_date,
          $this->end_date,
          $this->order,
          $this->deleted,
          $this->published,
          $this->news_id
        ));
    }

    if (PEAR::isError($result)) {
      $this->set_error($this->lang['ERROR_SAVE_NEWS'], 'error');
      return false;
    } else {
      $this->set_error($this->lang['SUCCESS_NEWS_SAVE'], 'success');
      return true;
    }
  }

}