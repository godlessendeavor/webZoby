<?php
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include("classes/HighlightClass.php");
	include("commonFunctions.php");
	include($dr."/utils/classes/GenericListClass.php");
	include($dr."/utils/cons.php");
	
	$highTypeArray=array("SENTENCE","VIDEO","WEB","MUSIC","MOVIE");
	
	$MONTH_NAMES=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	$tabhigh="highlights";


	//SEEKING THE LAST HIGHLIGHTS (BY TYPE)WHERE MAXNUM IS THE MAXIMUM NUMBER TO RETRIEVE
	function seekLastHighlights($link,$maxNum,$type){
		global $tabhigh;		
		date_default_timezone_set("Europe/Madrid");		
		$today=date("Y-m-d h:i:s");
		$query='select * from '.$tabhigh.' where '.$tabhigh.'.date<="'.$today.'" and type="'.$type.'"order by date desc limit '.$maxNum;
		$result=mysql_query($query,$link) or die(mysql_error());
		$highlightList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$high=new Highlight;
			$high->setHighlight($row);
			$highlightList->addItem($high);
			//print_r($high);
		}

		mysql_free_result($result);		
		return $highlightList;
	}
	
	
	//SELECT ALL HIGHLIGHTS
	function selectAllHighlights($link){
		global $tabhigh;
		$result=mysql_query("select * from ".$tabhigh,$link) or die(mysql_error());
		$highlightList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$high=new Highlight;
			$high->setHighlight($row);
			$highlightList->addItem($high);
			//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($result);
		return $highlightList;
	}	
	
	function insertHighlight($high,$link){
		global $tabhigh;		
		date_default_timezone_set("Europe/Madrid");
		$high->date=date("Y-m-d h:i:s");
		$high->comment=codeChars($high->comment);
        $high->name=codeChars($high->name);
		$values="(\"".$high->name."\","."\"".$high->url."\","."\"".$high->type."\",".
		"\"".$high->comment."\","."\"".$high->date."\")";
		$insert="insert into ".$tabhigh." (name,url,type,comment,date) values ".$values;
		$result=mysql_query($insert,$link);
	}
	
	function updateHighlight($high,$link,$id){
		global $tabhigh;	
		$high->comment=codeChars($high->comment);
        $high->name=codeChars($high->name);
		$update="update ".$tabhigh." set name=\"".$high->name."\",url=\"".$high->url."\",type=\"".$high->type."\",
			comment=\"".$high->comment."\" where id=\"".$id."\"";
		$result=mysql_query($update,$link);
	}

	function deleteHighlight($high,$link){
		global $tabhigh;
		$delete="delete from ".$tabhigh." where id=\"".$high->id."\"";
		mysql_query($delete,$link);		
	}

?>