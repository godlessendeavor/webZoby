<?php

/**
 * @author thrasher
 * @copyright 2009
 */	
 	$dr=$_SERVER['DOCUMENT_ROOT'];

 	include($dr."/db/highlightsdb.php");
 	include($dr."/utils/http.php");
        include($dr.'/utils/cons.php');


	session_start();
	if ($_SESSION["privileges"]!=ADMIN) exit;
        $high=new Highlight;
	$high->setHighlight($_REQUEST);

	$link=dbConnect(DBBLOG);

	switch($_REQUEST["action"]){
		case "delete":
			deleteHighlight($high,$link);
			redirect("../".HOMEPAGE);
		break;
		case "update":
			$_SESSION['high']=$high;			
			redirect("updateHighlight.php");
		break;
		case "confirm update":
			$id=$_SESSION['high']->id;
			updateHighlight($high,$link,$id);
			redirect("../".HOMEPAGE);
		break;
	}

?>