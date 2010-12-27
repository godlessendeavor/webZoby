<?php
	include("utils/http.php");
	include("utils/cons.php");
	session_start();
	unset($_SESSION["privileges"]);
	session_destroy(session_id());
	redirect(HOMEPAGE);
	
?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37