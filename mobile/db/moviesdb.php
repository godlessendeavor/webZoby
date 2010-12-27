<?php
	include("classes/MovieClass.php");
	include("commonFunctions.php");
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include($dr."/utils/classes/GenericListClass.php");
	include($dr."/utils/cons.php");

	$tabmovies=TABMOVIES;
	
	//SELECT ALL MOVIES
	function selectAllMovies($link){
		global $tabmovies;
		$result=mysql_query("select * from ".$tabmovies." order by title",$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$movie=new Movie;
			$movie->setMovie($row);
			$genericList->addItem($movie);
			//for($index=1;$index<6;$index++)
			//{
			//printf("<br>%s<br>%s",$row[$index],$disc->title);
			//}
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	//SELECT N MOVIES (ORDERING BY TITLE)
	function selectnMovies($link,$from,$quant){
		global $tabmovies;
		$result=mysql_query("select * from ".$tabmovies." order by title limit ".$from.",".$quant,$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$movie=new Movie;
			$movie->setMovie($row);
			$genericList->addItem($movie);
			//printf("%s<br>",$movie->title);
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	
		//SELECTING DISCS BY FIELD, LIMITING TO N DISCS (ORDERING BY GROUP)
	function searchMoviesByField($link,$word,$field,$from,$quant){
		global $tabmovies;
		$result=mysql_query("select * from ".$tabmovies." where ".$field."=\"".$word."\" order by title limit ".$from.",".$quant,$link) or die(mysql_error());
		$genericList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$movie=new Movie;
			$movie->setMovie($row);
			$genericList->addItem($movie);
			//printf("%s<br>",$movie->title);
		}
		mysql_free_result($result);
		return $genericList;
	}
	
	
	//COUNTING DISCS BY FIELD, LIMITING TO N DISCS (ORDERING BY GROUP)
	function countMoviesByField($link,$word,$field){
		global $tabmovies;
		$result=mysql_query("select count(*) from ".$tabmovies." where ".$field."=\"".$word."\"",$link) or die(mysql_error());
		$itemCount=mysql_fetch_array($result);
		mysql_free_result($result);
		return $itemCount[0];
	}

	function insertMovie($link,$data){
		global $tabmovies;
	    $movie=new Movie;
		$movie->setMovieWithoutNames($data);
		$values='("'.$movie->director.'","'.$movie->title.'","'.$movie->other.'","'.$movie->year.'","'.$movie->loc.'")';
		$insert="insert into ".$tabmovies." (director,title,other,year,loc) values ".$values;
		$result=mysql_query($insert,$link) or die(mysql_error());
	}
	
	
	function eraseMoviesDB($link){
		global $tabmovies;
		mysql_query('truncate '.$tabmovies) or die(mysql_error());
	}
	
	function updateMovie($movie,$link,$title){
		global $tabmovies;
		$update="update ".$tabmovies." set director=\"".$movie->group." set title=\"".$movie->title."\",
			other=\"".$movie->other."\",year=\"".$disc->year."\",
			loc=\"".$movie->loc."\"";
			//echo $update;	
		mysql_query($update,$link);		
	}

?>
 [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37