<?php
require_once("core.php");

if (!$_REQUEST['CID'] || !$_REQUEST['pass'])
{
// To screw with them we're just going to give them a blank page...
}
else
{
	$rv = check_auth($_REQUEST['CID'], $_REQUEST['pass']);
	if ($rv == 1)
	{
		// Login successful.  Load their access.
		load_access();
		// Loaded.. now let's give them a success! page and redirect them
?>
<html>
<head>
<meta http-equiv="refresh" content="3;url=/?page=home">
</head>
<body style="background-color: #333333;">
<div style="width: 100%; text-align: center; color: #ffffff;"><p>You have been successfully logged in.  Welcome to Chicago ARTCC.  Enjoy your stay.</p><p>You should be redirected momentarily to the home page, if not, <a href="/?page=home">click here</a>.</p></div>
</body>
</html>
<?php
	}
	else if ($rv == -1)
	{
?>
<html>
<head>
<meta http-equiv="refresh" content="1;url=/?page=home&msg=Invalid%20Password%20Specified">
</head>
<body style="background-color: #333333;">
<div style="width: 100%; text-align: center; color: #ffffff;"><p>There was an error processing your request, as your CID and password did not match.</p><p>You should be redirected momentarily to the home page, if not, <a href="/?page=home">click here</a>.</p></div>
</body>
</html>
<?php
	}
	else if ($rv == -2)
	{
?>
<html>
<head>
<meta http-equiv="refresh" content="1;url=/?page=home&msg=Your%20Account%20is%20marked%20Inactive">
</head>
<body style="background-color: #333333;">
<div style="width: 100%; text-align: center; color: #ffffff;"><p>There was an error processing your request, your account has been marked inactive.</p><p>You should be redirected momentarily to the home page, if not, <a href="/?page=home">click here</a>.</p></div>
</body>
</html>
<?php
	}
	else
	{
?>
<html>
<head>
<meta http-equiv="refresh" content="3;url=/?page=home&msg=Unknown%20Database%20Error">
</head>
<body style="background-color: #333333;">
<div style="width: 100%; text-align: center; color: #ffffff;"><p>There was an error processing your request, an invalid response from the database has been received.</p><p>You should be redirected momentarily to the home page, if not, <a href="/?page=home">click here</a>.</p></div>
</body>
</html>
<?php
	}
}
?>