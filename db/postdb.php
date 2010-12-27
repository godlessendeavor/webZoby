<?php

	$dr=$_SERVER['DOCUMENT_ROOT'];
	include("classes/PostClass.php");
	include("commonFunctions.php");
	include($dr."/utils/classes/GenericListClass.php");
	include($dr."/utils/cons.php");
	define("MAX_POSTS",3);

	//SEEKING THE LAST POSTS WHERE MAXPOSTS IS THE MAXIMUM NUMBER TO RETRIEVE
	function seekLastPosts($link,$maxPosts){
		$today=date("Y-m-d h:i:s");
		$query='select * from '.TABPOSTS.' where '.TABPOSTS.'.date<="'.$today.'" order by date desc limit '.$maxPosts;
		$result=mysql_query($query,$link) or die(mysql_error());
		$postList=result2PostList($result);
		return $postList;
	}
	
	function seekPrevPost($link,$date){
		$query='select * from '.TABPOSTS.' where '.TABPOSTS.'.date<"'.$date.'" order by date desc limit 1';
		
		$result=mysql_query($query,$link) or die(mysql_error());
		$postList=result2PostList($result);
		return $postList;
	}
	
	function seekNextPost($link,$date){
		$query='select * from '.TABPOSTS.' where '.TABPOSTS.'.date>"'.$date.'" order by date asc limit 1';

		$result=mysql_query($query,$link) or die(mysql_error());
		$postList=result2PostList($result);
		return $postList;
	}
	
	
	//SELECT ALL POSTS
	function selectAllPosts($link){
		$result=mysql_query("select * from ".TABPOSTS,$link) or die(mysql_error());
		$postList=result2PostList($result);
		return $postList;
	}	
	
	function searchPostByTitle($link,$title){
		$query="select * from ".TABPOSTS." where title=\"".$title."\"";
		$result=mysql_query($query,$link) or die(mysql_error());
		$postList=result2PostList($result);
		return $postList;
	}
	
	function searchPostById($link,$id){
		$query="select * from ".TABPOSTS." where id=\"".$id."\"";
		$result=mysql_query($query,$link) or die(mysql_error());
		$postList=result2PostList($result);
		return $postList->list[1];
	}
	
	function searchPostsByMonthAndYear($link,$month,$year){
		$query='select * from '.TABPOSTS.' where month(date)="'.$month.'" and year(date)="'.$year.'"';
		$result=mysql_query($query,$link) or die(mysql_error());
		$postList=result2PostList($result);
		mysql_free_result($result);
		return $postList;
	}
	function seekDatePosts($link){
		global $MONTH_NAMES;
		$out='';
		$startYear=2009;
		$endYear=2011;
		for ($year=$startYear;$year<=$endYear;$year++){   //buscamos posts por cada año
			$query="select * from ".TABPOSTS." where year(date)=\"".$year."\"";
			$result=mysql_query($query,$link) or die(mysql_error());
			$postList=result2PostList($result);
			if ($postList->cant>0){             //si en este año hay posts
				$out.= "<li id='root'>".$year."<ul>";
				for($month=1;$month<=12;$month++){          //entonces buscamos en que meses hay
					$postList2=searchPostsByMonthAndYear($link,$month,$year);
						if ($postList2->cant>0){							
							$out.="<li>".$MONTH_NAMES[$month-1]."<ul class='submenu'>";
							for($postItem=1;$postItem<=$postList2->cant;$postItem++){
								$postTitle=$postList2->list[$postItem]->title;
								$out.="<li";
								if ($postItem==1) $out.=" class='showing'"; 
								$out.="><a href='blogpage.php?postTitle=".$postTitle."'>".$postTitle."</a></li>";
							}
							$out.="</ul></li>";
						}
					
				}
				$out.='</ul></li>';				
			}
			mysql_free_result($result);
		}
		return($out);
	}
	
	function insertPost($post,$link,$coding){
		$post->date=date("Y-m-d h:i:s");
		if($coding) $post->codeChars(CODING);
		
		$values='("'.$post->title.'","'.$post->style.'","'.$post->topic.'","'.$post->special.'","'.$post->date.'","'.$post->file.'","'.$post->text.'")';
		$insert="insert into ".TABPOSTS." (title,style,topic,special,date,file,text) values ".$values;
		$result=mysql_query($insert,$link) or die (mysql_error());
	}
	
	function updatePost($post,$link,$coding){
        if($coding) $post->codeChars(CODING);

		$update="update ".TABPOSTS." set title=\"".$post->title."\",style=\"".$post->style."\",topic=\"".$post->topic."\",
			special=\"".$post->special."\",file=\"".$post->file."\",text=\"".$post->text."\" 
			where id=\"".$post->id."\"";
		mysql_query($update,$link) or die (mysql_error());		
	}
	
	function deletePost($id,$link){
		$delete='delete from '.TABPOSTS.' where id='.$id;
		mysql_query($delete,$link) or die (mysql_error());		
	}
	
	
	function result2PostList($array){
		$postList = new GenericList;
		while($row = mysql_fetch_array($array)) {
			$post=new Post;
			$post->setPost($row);
			$post->decodeChars(CODING);
			$postList->addItem($post);
			//printf("<br>%s<br>%s<br>",$row["title"],$row["date"]);
		}
		mysql_free_result($array);	
		return $postList;
	}

?>