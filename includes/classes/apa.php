<?php
if (!has_level(9, 8, 4)) {
$denied = build_page($_config['403'],0,FALSE);
require_once($denied);
}
else
{
	if ($_REQUEST['save'] == 1)
	{
		build_connection($db);
		sql_do($db, "UPDATE `pages` SET `pagename`='" . $_REQUEST['pagename'] . "', `title`='" . $_REQUEST['title'] . "', `content`='" . $_REQUEST['content'] . "', `modifiedby`='" . $_SESSION['username'] . "', `modifieddate`=NOW() WHERE `pagename`='" . $_REQUEST['pn'] . "' LIMIT 1");
		$_REQUEST['pageselect'] = $_REQUEST['pagename'];
		echo "<b>Saved.</b>";
	}
	else if ($_REQUEST['save'] == 2)
	{
		build_connection($db);
		$_REQUEST['pageselect'] = $_REQUEST['pagename'];
		sql_do($db, "INSERT INTO `pages` VALUES('" . $_REQUEST['pagename'] . "', '" . $_REQUEST['title'] . "', '" . $_REQUEST['content'] . "', '" . $_SESSION['username'] . "', NOW(), 0)");
		echo "<b>Saved.</b>";
	}
?>
<form action="/?page=apa" method="POST">
<?php
build_connection($db);
sql_exec($db, "SELECT `pagename`, `title` FROM `pages` ORDER BY `pagename`", $result);
echo "Select Page: <select name=\"pageselect\"><option value=\"1\">New Page</option>";
while ($row = mysql_fetch_assoc($result)) { echo "<option value=\"" . $row['pagename'] . "\">" . $row['pagename'] . " - " . $row['title'] . "</option>"; }
echo " <input type=\"submit\" value=\"Edit Page\">\n";
finish_result($result);
finish_connection($db);
?>
</form>
<?php
	if ($_REQUEST['pageselect'])
	{
		if ($_REQUEST['pageselect'] != 1)
			$pagerow = fetch_row("SELECT `pagename`,`title`,`content` FROM `pages` WHERE `pagename`='" . $_REQUEST['pageselect'] . "' LIMIT 1");
?>
<br/><br/>
<form action="/?page=apa" method="POST">
<? if ($_REQUEST['pageselect'] == 1) { ?>
<input type="hidden" name="save" value="2"/>
<? } else { ?>
<input type="hidden" name="save" value="1"/>
<? } ?>
<input type="hidden" name="pn" value="<?=$_REQUEST['pageselect']?>"/>
Page Name: <input type="text" name="pagename" value="<?=$pagerow['pagename']?>"/><br/>
Title: <input type="text" name="title" value="<?=$pagerow['title']?>"/><br/>
Body: <textarea name="content" rows="25" cols="60"><?=$pagerow['content']?></textarea>
<br/>
<input type="submit" value="Save" />
<?php
	}

}
?>