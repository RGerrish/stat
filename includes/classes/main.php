<?php

/**
 * Main Class
 * @package stat
 * @version 1.0
 * @desc Contains core funcationality for the program
 */
class main extends configuration {

  /**
   * @method main::clean_input
   * @param String $string
   * @desc This method preforms a real-escape-string and htmlentities and returns string
   * @return returns DB ready formatting of string
   */
  public function clean_input($string) {
    /**
     * @todo Insert DBA escape_string function for $string
     */
    $string = htmlentities($string);
    $string = trim($string);
    return $string;
  }

  /**
   * @method main::set_error
   * @param string $error error string to be ouputted
   * @param string $type type of error to output. Choice is error, or notice, success
   * @desc This method will set any required errors
   */
  public function set_error($error, $type) {
    $_SESSION['error'][$type][] = $error;
  }

  /**
   * @method main::display_errors
   * @desc This method will output errors
   * @return string returns the html of the errors
   */
  public function display_errors() {
    //Errors
    if ($_SESSION['error']['error']) {
      $output .= '<ul>';
      foreach ($_SESSION['error']['error'] as $error) {
        $output .= "<li class='stat-error'>" . $error . "</li>";
      }
      $output .= '</ul>';
    }

    //Warnings
    if ($_SESSION['error']['notice']) {
      $output .= '<ul>';
      foreach ($_SESSION['error']['notice'] as $notice) {
        $output .= "<li class='stat-notice'>" . $notice . "</li>";
      }
      $output .= '</ul>';
    }

    //Success(s)
    if ($_SESSION['error']['success']) {
      $output .= '<ul>';
      foreach ($_SESSION['error']['success'] as $success) {
        $output .= "<li class='stat-success'>" . $success . "</li>";
      }
      $output .= '</ul>';
    }
    //Destory Variable
    unset($_SESSION['error']);
    return $output;
  }

}