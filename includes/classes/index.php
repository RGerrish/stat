<?php
require("core.php");
$links = build_page("links",0,FALSE);
if ($_REQUEST['page']) { $pn = $_REQUEST['page']; } else { $pn = "home"; }
$page = build_page($pn, 0, TRUE);
$page2 = $_REQUEST['page']
?>
<!doctype html public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--  Expandable Content Box Script Start, Controller/Staff Notes  -->
<script language="javascript">
var ie4 = false; if(document.all) { ie4 = true; }
function getObject(id) { if (ie4) { return document.all[id]; } else { return document.getElementById(id); } }
function toggle(link, divId) { var lText = link.innerHTML; var d = getObject(divId);
 if (lText == '+') { link.innerHTML = '−'; d.style.display = 'block'; }
 else { link.innerHTML = '+'; d.style.display = 'none'; } }
</script>
<!--  Expandable Content Box Script End, Controller/Staff Notes  -->
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="list.js"></script>
<title>vZAU ARTCC</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="copyright" content="2009-2010" />
<meta name="author" content="Rahul Parkar" />
<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />
<script type="text/javascript" src="chromejs/chrome.js"></script>
<link rel="stylesheet" type="text/css" href="/theme.css" />
<link rel="stylesheet" type="text/css" href="/zauartcc.css" />
</head>
<body onLoad="fillCategory();">

<div id="outter">
<div id="container">
  <div id="header"><img src="/images/logo.jpg" alt="VATSIM Chicago ARTCC" /></div>
  <div style="height: 1px; background-color:#000000; width: 910px;"></div>
<!-- NAVBAR -->
<?php
if ($links == -1) {
?><div><b>There was an error loading the NAVBAR...</b></div><?php
} else {
require_once($links);
unlink($links);
}
?>
<!-- /NAVBAR -->
  <div style="height: 1px; background-color:#000000; width: 910px;"></div>
  <div style="margin-bottom: -2000px; padding-bottom: 2000px; overflow: hidden;">
  <div id="left"><? require_once($page); unlink($page); ?></div>
  <div id="right">
  <? if (!$_SESSION['username']) { ?>
<br/><form action="login.php" method="post"><table border="0" cellspacing="0" cellpadding="0" style="width: 200px;"><tr><td colspan="3"><img src="/images/login.jpg" /></td></tr><tr style="height: 50px;"><td style="width:2px; background-color: #5db4d2;"><img src="/images/dot.gif"/></td><td>CID: <input type="text" name="CID" size="9" /><br/>Password: <input type="password" name="pass" size="7" /></td><td style="width: 2px; background-color: #5db4d2;"><img src="/images/dot.gif"/></td></tr><tr><td colspan="3" style="background-color: #5db4d2; text-align: right;"><input type="submit" value="Login" /></td></tr></table></form>
  <? } else { ?>Howdy, <?= $_SESSION['name']?>!  You are logged in.<? } ?><br /><br /><table border="0" cellspacing="0" cellpadding="0" style="width: 230px;"><tr><td colspan="3"><img src="/images/teamspeak.jpg" /></td></tr><tr style="height: 200px;"><td style="width:2px; background-color: b6f24e;"><img src="/images/dot.gif"/></td><td><script type="text/javascript" charset="utf-8" src="http://www.tsviewer.com/ts3viewer.php?ID=926588&amp;text=000000&amp;text_size=12&amp;text_family=1&amp;js=1&amp;text_s_weight=bold&amp;text_s_style=normal&amp;text_s_variant=normal&amp;text_s_decoration=none&amp;text_s_color_h=525284&amp;text_s_weight_h=bold&amp;text_s_style_h=normal&amp;text_s_variant_h=normal&amp;text_s_decoration_h=underline&amp;text_i_weight=normal&amp;text_i_style=normal&amp;text_i_variant=normal&amp;text_i_decoration=none&amp;text_i_color_h=525284&amp;text_i_weight_h=normal&amp;text_i_style_h=normal&amp;text_i_variant_h=normal&amp;text_i_decoration_h=underline&amp;text_c_weight=normal&amp;text_c_style=normal&amp;text_c_variant=normal&amp;text_c_decoration=none&amp;text_c_color_h=525284&amp;text_c_weight_h=normal&amp;text_c_style_h=normal&amp;text_c_variant_h=normal&amp;text_c_decoration_h=underline&amp;text_u_weight=bold&amp;text_u_style=normal&amp;text_u_variant=normal&amp;text_u_decoration=none&amp;text_u_color_h=525284&amp;text_u_weight_h=bold&amp;text_u_style_h=normal&amp;text_u_variant_h=normal&amp;text_u_decoration_h=none"></script><noscript>Enable JavaScript or visit <a href="http://www.tsviewer.com/index.php?page=ts_viewer&amp;ID=926588">TeamSpeak Viewer</a> to display the TeamSpeak server.</noscript></td></tr></table>
 <a href="http://www.vatsim.net"><img src="http://www.zkcartcc.net/images/vatsim.png" border="0" alt="VATSIM" /></a></div><br /><br />

 
  <div id="footer"><?php if (has_level(4)) { $con = mysql_connect("localhost","fsprosho_zauartc","ifyoucrackthisyouarepro");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("fsprosho_postnuke", $con); 

$result7 = mysql_query("SELECT * FROM pages WHERE pagename = '$page2'"); 

while($row77 = mysql_fetch_array($result7))
{
	echo "<b>Modified By: " . $row77['modifiedby'] . "";
    echo "<br />Modified Date: " . $row77['modifieddate'] . "";
    echo "<br /><br /></b>";
    } }
	?>
<center>&copy; 2010 vZAU Chicago ARTCC. All rights reserved.</center><p><small>The information contained on all pages of this website are to be used for flight simulation purposes only on the VATSIM network.  It is not intended nor should it be used for real world navigation.  This site is not affiliated with the FAA, the actual Chicago ARTCC or any governing aviation body.  All content contained herein is approved only for use on the VATSIM network.</small></p><p><small>Design by Daniel A. Hawton.</small></p><small><p>Code Maintained by Rahul A. Parkar</p></small></div>
</div>
<div style="height: 1px; background-color: #000000;"></div>
</div>
<?php require_once("mysqlbackup/schedule_backup.php"); ?>
</body>
</html>