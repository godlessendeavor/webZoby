<?php
	include("classes/DocClass.php");
	include("commonFunctions.php");
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include($dr."/utils/classes/GenericListClass.php");
	include($dr."/utils/cons.php");

	$tabdocs=TABDOCS;
	
	//SELECT ALL docS
	function selectAllDocs($link){
		global $tabdocs;
		$result=mysql_query("select * from ".$tabdocs." order by title",$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$doc=new doc;
			$doc->setDoc($row);
			$genericList->addItem($doc);
			//for($index=1;$index<6;$index++)
			//{
			//printf("<br>%s<br>%s",$row[$index],$disc->title);
			//}
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	//SELECT N docS (ORDERING BY TITLE)
	function selectnDocs($link,$from,$quant){
		global $tabdocs;
		$result=mysql_query("select * from ".$tabdocs." order by title limit ".$from.",".$quant,$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$doc=new doc;
			$doc->setDoc($row);
			$genericList->addItem($doc);
			//printf("%s<br>",$doc->title);
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	
		//SELECTING DISCS BY FIELD, LIMITING TO N DISCS (ORDERING BY TITLE)
	function searchDocsByField($link,$word,$field,$from,$quant){
		global $tabdocs;
		$result=mysql_query("select * from ".$tabdocs." where ".$field."=\"".$word."\" order by title limit ".$from.",".$quant,$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$doc=new doc;
			$doc->setDoc($row);
			$genericList->addItem($doc);
			//printf("%s<br>",$doc->title);
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	
	//COUNTING DISCS BY FIELD, LIMITING TO N DISCS (ORDERING BY GROUP)
	function countDocsByField($link,$word,$field){
		global $tabdocs;
		$result=mysql_query("select count(*) from ".$tabdocs." where ".$field."=\"".$word."\"",$link) or die(mysql_error());
		$itemCount=mysql_fetch_array($result);
		mysql_free_result($result);
		return $itemCount[0];
	}

	function insertDoc($link,$data){
		global $tabdocs;
	    $doc=new doc;
		$doc->setDocWithoutNames($data);
		$values='("'.$doc->title.'","'.$doc->loc.'","'.$doc->theme.'","'.$doc->comments.'")';
		$insert="insert into ".$tabdocs." (title,loc,theme,comments) values ".$values;
		$result=mysql_query($insert,$link) or die(mysql_error());
	}
	
	
	function eraseDocsDB($link){
		global $tabdocs;
		mysql_query('truncate '.$tabdocs) or die(mysql_error());
	}
	

?>
 [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37