<?php
	include("classes/MusicClass.php");
	include("commonFunctions.php");
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include($dr."/utils/classes/GenericListClass.php");
	include($dr."/utils/cons.php");
	
	$tabmusic=TABMUSIC;

	//SELECT ALL DISCS
	function selectAllMusic($link){
		global $tabmusic;
		$result=mysql_query("select * from ".$tabmusic." order by groupName",$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$disc=new Music;
			$disc->setMusic($row);
			$genericList->addItem($disc);
			/*for($index=1;$index<6;$index++)
			{
				printf("<br>%s<br>%s",$row[$index],$disc->title);
			}*/
		}
		mysql_free_result($result);
		return $genericList;
	}	
	
	//SELECT N DISCS (ORDERING BY GROUP)
	function selectnDiscs($link,$from,$quant){
		global $tabmusic;
		$result=mysql_query("select * from ".$tabmusic." order by groupName limit ".$from.",".$quant,$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$disc=new Music;
			$disc->setMusic($row);
			$genericList->addItem($disc);
			//printf("%s<br>",$movie->title);
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	
		//SELECTING DISCS BY FIELD, LIMITING TO N DISCS (ORDERING BY GROUP)
	function searchDiscsByField($link,$word,$field,$from,$quant){
		global $tabmusic;
		$result=mysql_query("select * from ".$tabmusic." where ".$field."=\"".$word."\" order by groupName limit ".$from.",".$quant,$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$disc=new Music;
			$disc->setMusic($row);
			$genericList->addItem($disc);
			//printf("%s<br>",$movie->title);
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	
	//COUNTING DISCS BY FIELD, LIMITING TO N DISCS (ORDERING BY GROUP)
	function countDiscsByField($link,$word,$field){
		global $tabmusic;
		$result=mysql_query("select count(*) from ".$tabmusic." where ".$field."=\"".$word."\"",$link) or die(mysql_error());
		$itemCount=mysql_fetch_array($result);
		mysql_free_result($result);
		return $itemCount[0];
	}
	
	
	function insertDisc($link,$data){
		global $tabmusic;
		$disc=new Music;
		$disc->setMusicWithoutNames($data);
		$values='("'.$disc->id.'","'.$disc->group.'","'.$disc->title.'","'.$disc->style.'","'.$disc->year.'","'.$disc->loc.'","'.$disc->copy.'","'.$disc->type.'","'.$disc->review.'","'.$disc->mark.'")';
		$insert="insert into ".$tabmusic." (Id,groupName,title,style,year,loc,copy,type,review,mark) values ".$values;
		//echo $insert;
		//exit;
		mysql_query($insert,$link) or die(mysql_error());
	}
	
	function updateDisc($disc,$link,$title){
		global $tabmusic;
		$update="update ".$tabmusic." set groupName=\"".$disc->group." set title=\"".$disc->title."\",
			style=\"".$disc->style."\",year=\"".$disc->year."\",
			loc=\"".$disc->loc."\",type=\"".$disc->type."\"";
			//echo $update;	
		mysql_query($update,$link);		
	}
	
	function eraseMusicDB($link){
		global $tabmusic;
		mysql_query('truncate '.$tabmusic) or die(mysql_error());
	}
	
	//ERASES DATABASE AND INSERTS DATA ESPECIFIED IN $ARRAYLIST
	function updateWholeDB($link,$arrayList){
		global $tabmusic;
		mysql_query('truncate '.$tabmusic) or die(mysql_error());
		$size=count($arrayList);
		for($it=0;$it<$size;$it++){
			$currentRow=$arrayList[$it];
			list($id, $group, $title, $style, $year, $loc, $copy, $type,$review) = $currentRow;
			$insert="insert into ".$tabmusic." (id,groupName,title,style,year,loc,copy,type,review,mark) values ('$id','$group','$title','$style','$year','$loc','$copy','$type','$review','$mark')";
			$result=mysql_query($insert,$link);
		}
		
	}


?>