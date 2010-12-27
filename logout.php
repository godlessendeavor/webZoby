<?php
	include("utils/http.php");
	include("utils/cons.php");
	session_start();
	unset($_SESSION["privileges"]);
	session_destroy(session_id());
	redirect(HOMEPAGE);
?>