<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
?>

<!DOCTYPE HTML>
<HTML>
<HEAD>
	<TITLE>Reset your life</TITLE>
	<meta charset="UTF-8">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="description" content="Restarting your life after gambling">
	<meta name="keywords" content="gamblers anonymous, gambling">
	
<style>
h3 {
	text-align:center;
	font-family: arial, sans-serif;
	font-size: 20px;
}

h2 {
	text-align:center;
	font-family: arial, sans-serif;
	font-size: 16px;
}
</style>

</HEAD>
<BODY>

<h3>OK, your life has been reset</h3>

<h2><a href="gamble_start.htm">Restart</a></h2>

<h2>
<a href='http://www.gamblersanonymous.org.uk' target='_blank'>Please take me to Gamblers Anonymous (UK)</a><BR>
</h2>


</BODY>
</HTML>

