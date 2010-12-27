<?php
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include("classes/PostClass.php");
	include("commonFunctions.php");
	include($dr."/utils/classes/GenericListClass.php");
	include($dr."/utils/cons.php");
	define("MAX_POSTS",3);
	$MONTH_NAMES=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	$tabposts="entries";

	//SEEKING THE LAST POSTS WHERE MAXPOSTS IS THE MAXIMUm NUMBER TO RETRIEVE
	function seekLastPosts($link,$maxPosts){
		global $tabposts;
		$today=date("Y-m-d h:i:s");
		$query='select * from '.$tabposts.' where '.$tabposts.'.date<="'.$today.'" order by date desc limit '.$maxPosts;
		$result=mysql_query($query,$link) or die(mysql_error());
		$postList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$post=new Post;
			$post->setPost($row);
			$postList->addItem($post);
			//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($result);		
		return $postList;
	}
	
	function seekPrevPost($link,$date){
		global $tabposts;
		$query='select * from '.$tabposts.' where '.$tabposts.'.date<"'.$date.'" order by date desc limit 1';
		
		$result=mysql_query($query,$link) or die(mysql_error());
		$postList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$post=new Post;
			$post->setPost($row);
			$postList->addItem($post);
			//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($result);		
		return $postList;
	}
	
	function seekNextPost($link,$date){
		global $tabposts;
		$query='select * from '.$tabposts.' where '.$tabposts.'.date>"'.$date.'" order by date asc limit 1';

		$result=mysql_query($query,$link) or die(mysql_error());
		$postList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$post=new Post;
			$post->setPost($row);
			$postList->addItem($post);
			//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($result);		
		return $postList;
	}
	
	
	//SELECT ALL POSTS
	function selectAllPosts($link){
		global $tabposts;
		$result=mysql_query("select * from ".$tabposts,$link) or die(mysql_error());
		$postList = new GenericList;
		while($row = mysql_fetch_array($result)) {
			$post=new Post;
			$post->setPost($row);
			$postList->addItem($post);
			//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($result);
		return $postList;
	}	
	
	function searchPostByTitle($link,$title){
		global $tabposts;
		$postList = new GenericList;
		$query="select * from ".$tabposts." where title=\"".$title."\"";
		$result=mysql_query($query,$link) or die(mysql_error());
		while($row = mysql_fetch_array($result)) {
			$post=new Post;
			$post->setPost($row);
			$postList->addItem($post);
				//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($result);
		return $postList;
	}
	
	function searchPostsByMonth($link,$month){
		global $tabposts;
		$postList = new GenericList;
		$query="select * from ".$tabposts." where month(date)=\"".$month."\"";
		$result=mysql_query($query,$link) or die(mysql_error());
		while($row = mysql_fetch_array($result)) {
			$post=new Post;
			$post->setPost($row);
			$postList->addItem($post);
				//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($result);
		return $postList;
	}
	
	function insertPost($post,$link){
		global $tabposts;
		$post->date=date("Y-m-d h:i:s");
		$post->text=codeChars($post->text);
		$post->title=codeChars($post->title);

		$values="(\"".$post->title."\","."\"".$post->style."\","."\"".$post->topic."\",".
		"\"".$post->special."\","."\"".$post->date."\","."\"".$post->file."\","."\"".$post->text."\")";
		$insert="insert into ".$tabposts." (title,style,topic,special,date,file,text) values ".$values;
		$result=mysql_query($insert,$link);
	}
	
	function updatePost($post,$link,$title){
		global $tabposts;
		//$post->text=nl2br($post->text);
        $post->date=date("Y-m-d h:i:s");
		
		$post->text=codeChars($post->text);
		$post->title=codeChars($post->title);

		$update="update ".$tabposts." set title=\"".$post->title."\",style=\"".$post->style."\",topic=\"".$post->topic."\",
			special=\"".$post->special."\",date=\"".$post->date."\",file=\"".$post->file."\",text=\"".$post->text."\" 
			where id=\"".$post->id."\"";
			//echo $update;	
		mysql_query($update,$link);		
	}

?>
 [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37