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
		redirect(HOMEPAGE);
	}
	else {
		session_start();
		session_destroy(session_id());
		redirect(HOMEPAGE);
	}
?>