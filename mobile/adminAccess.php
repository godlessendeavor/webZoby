<?php

	include("db/userdb.php");
	include("db/commonFunctions.php");
	include("utils/http.php");

	$link=dbConnect(DBBLOG);
	$user = new User;
	$user->nick=$_REQUEST["nick"];
	$user->pswd=$_REQUEST["pswd"];
		
	$user->privileges=NOBODY;
	$user=searchUsr($user,$link);
	if ($user->privileges<NOBODY) {
		session_start();
		$_SESSION['privileges']=$user->privileges;
		redirect("homepage.php");
	}
	else {
		session_start();
		session_destroy(session_id());
		redirect("homepage.php");
	}
?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37