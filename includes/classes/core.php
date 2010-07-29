<?php
/*Chicago ARTCC Core, Coded by Rahul A. Parkar, ZAU Webmaster 2010 - Present */
$_config = array();
$_config['db_type'] = "mysql";
$_config['db_server'] = "localhost";
$_config['db_username'] = "xxx";
$_config['db_password'] = 'xxx';
$_config['db_database'] = "xxx";
$_config['db_tbl_prefix'] = '';
$_config['404'] = "404";
$_config['403'] = "403";
$_config['title_start'] = "<h1>";
$_config['title_end'] = "</h1>";
$_config['content_start'] = "";
$_config['content_end'] = "";
$_config['user_table'] = "controllers";
$_config['user_username'] = "CID";
$_config['user_password'] = "password";
$_config['user_active'] = "active";
$_config['user_role1'] = "prirole";
$_config['user_role2'] = "secrole";
$_config['pass_hash_func'] = "SHA1";
session_start();
 
function build_page($pagename, $access, $display_title) {
        global $_config;

        if (!$pagename)
        {
                return -1;
        }
 
        $row = fetch_row("SELECT `title`, `content`, `accesslevel` FROM `pages` WHERE `pagename`='" . $pagename . "' LIMIT 1");
        if (!$row['content'])
        {
                if ($pagename == $_config['404']) { echo "There was an error... ABORT!!!"; die; }
                return build_page($_config['404'], 0, TRUE);
        }
        else if ($row['accesslevel'] == $access)
        {
                $handle = fopen($pagename . session_id() . ".php", "w");
                if ($display_title == TRUE) { fputs($handle, $_config['title_start'] . $row['title'] . $_config['title_end'] . "\n"); }
                fputs($handle, $config['content_start'] . $row['content'] . $config['content_end'] . "\n");
                fclose($handle);
                return $pagename . session_id() . ".php";
        }
        else
        {
                return build_page($_config['403'], 0, TRUE);
        }
}
 
function fetch_row($query)
{
        build_connection($db);
        sql_exec($db, $query, $result);
        sql_fetchone($result, $row);
        finish_connection($db);
        return $row;
}
 
function build_connection(&$db)
{
	global $_config;
	if ($_config['db_type'] == "mysql")
	{
		$db = mysql_connect($_config['db_server'], $_config['db_username'], $_config['db_password']) or die(mysql_error());
		mysql_select_db($_config['db_database'], $db) or die(mysql_error());
	}
}
 
function sql_exec(&$db, $query, &$result)
{
        global $_config;
        if ($_config['db_type'] == "mysql")
              $result = mysql_query($query, $db) or die(mysql_error() . "/$query");
}
 
function sql_fetchone(&$result, &$row)
{
	global $_config;
      if ($_config['db_type'] == "mysql")
      {
              $row = mysql_fetch_assoc($result);
              @mysql_free_result($result);
      }
}

function sql_do(&$db, $query)
{
	global $_config;
	sql_exec($db, $query, $noclue);
	finish_connection($db);
}

function finish_result(&$result)
{
	global $_config;
	if ($_config['db_type'] == "mysql")
		@mysql_free_result($result);
}

function finish_connection(&$db)
{
	global $_config;
	if ($_config['db_type'] == 'mysql')
		mysql_close($db);
}
 
function check_auth($username, $password)
{
	global $_config;
      $row = fetch_row("SELECT `" . $_config['user_active'] . "`, `" . $_config['user_password'] . "`, " . $_config['pass_hash_func'] . "('" . $password . "') AS `passcheck`, `name`, `ci` FROM `" . $_config['user_table'] . "` WHERE `" . $_config['user_username'] . "`='" . $username . "' LIMIT 1");
      if (!$row[$_config['user_active']]) { return -1; }
      else
      {
              if ($row[$_config['user_active']] != 1) { return -2; }
              else if ($row[$_config['user_password']] == $row['passcheck'])
              {
                      $_SESSION['username'] = $username;
                      $_SESSION['name'] = $row['name'];
					  $_SESSION['ci'] = $row['ci'];
                      return 1;
              }
              else
              {
                      return -1;
              }
      }
}
 
function load_access()
{
	global $_config;
        if ($_SESSION['username'])
        {
                $row = fetch_row("SELECT `" . $_config['user_role1'] . "`, `" . $_config['user_role2'] . "` FROM `" . $_config['user_table'] . "` WHERE `" . $_config['user_username'] . "`='" . $_SESSION['username'] . "' LIMIT 1");
                $role1 = $row[$_config['user_role1']];
                $role2 = $row[$_config['user_role2']];
                $_SESSION['role1'] = $role1;
                $_SESSION['role2'] = $role2;
        }
        else
        {
                return -1;
        }
}

function has_level()
{
	for ($i = 0; $i < func_num_args(); $i++)
	{
		if (func_get_arg($i) == $_SESSION['role1'] || func_get_arg($i) == $_SESSION['role2']) { return 1; }
	}
	return 0;
}


function gen_md5_password($len = 8)
{
    // function calculates 32-digit hexadecimal md5 hash
    // of some random data
    return substr(md5(rand().rand()), 0, $len);
}


function date_diff($start, $end)
{
        $sdate = strtotime($start);
        $edate = strtotime($end);

        $time = $edate - $sdate;
                // Days + Hours + Minutes
                $pday = ($edate - $sdate) / 86400;
                $preday = explode('.',$pday);
               
                $timeshift = $preday[0];

}
        return $timeshift;



/**
 * Convert number of seconds into hours, minutes and seconds
 * and return an array containing those values
 *
 * @param integer $seconds Number of seconds to parse
 * @return array
 */
function secondsToTime ($sec, $padHours = false) {

    $hms = "";
    
    // there are 3600 seconds in an hour, so if we
    // divide total seconds by 3600 and throw away
    // the remainder, we've got the number of hours
    $hours = intval(intval($sec) / 3600); 

    // add to $hms, with a leading 0 if asked for
    $hms .= ($padHours) 
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ':'
          : $hours. ':';
     
    // dividing the total seconds by 60 will give us
    // the number of minutes, but we're interested in 
    // minutes past the hour: to get that, we need to 
    // divide by 60 again and keep the remainder
    $minutes = intval(($sec / 60) % 60); 

    // then add to $hms (with a leading 0 if needed)
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';

    // seconds are simple - just divide the total
    // seconds by 60 and keep the remainder
    $seconds = intval($sec % 60); 

    // add to $hms, again with a leading 0 if needed
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

    return $hms;
}


?>