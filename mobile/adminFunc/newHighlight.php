<?php

/**
 * @author thrasher
 * @copyright 2009
 */
 	$dr=$_SERVER['DOCUMENT_ROOT'];
 	include($dr."/db/highlightsdb.php");
 	include($dr."/utils/http.php");

	session_start();
	if ($_SESSION["privileges"]!=ADMIN) exit;
    $high=new Highlight;

	$link=dbConnect(DBBLOG);
	$high->setHighlight($_REQUEST);
	insertHighlight($high,$link);
	//echo HOMEPAGE;
	redirect("../".HOMEPAGE);
?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37