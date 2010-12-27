<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="author" content="thrasher">
 	<title>My Music</title>
    <LINK rel="stylesheet" type="text/css" href="css/musicliststyle.css">
	<?php
		include("db/musicdb.php");
	?>
</head>

<body>
    <div class="content">
        <!-- start of content -->
	<table>
    <tr><th>#</th><th>Group</th><th>Title</th><th>Year</th><th>Style</th><th>Location</th><th>Type</th></tr><tr>
    	<?php
    	    session_start();
			$names=array("group","title","year","style","loc","type");
    	    $link=dbConnect(DBMUSIC);
			$count=1;
			if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]<NOBODY){
					$link=dbConnect(DBMUSIC);
					if(isset($_SESSION["field"])&&isset($_SESSION["word"])){
						$totalDiscs=countDiscsByField($link,$_SESSION["word"],$_SESSION["field"]);
						$numOfPages=ceil($totalDiscs/DISCSPERPAGE);
						if (isset($_GET["pageNum"])){
							$pageNum=$_GET["pageNum"];						
						} else $pageNum=1;
						$count=1+($pageNum-1)*DISCSPERPAGE;
						$discList=searchDiscsByField($link,$_SESSION["word"],$_SESSION["field"],$count-1,DISCSPERPAGE);	
					}else{
						$totalDiscs=countItems($link,TABMUSIC);
						$numOfPages=ceil($totalDiscs/DISCSPERPAGE);
						if (isset($_GET["pageNum"])){
							$pageNum=$_GET["pageNum"];						
						} else $pageNum=1;
						$count=1+($pageNum-1)*DISCSPERPAGE;
						$discList=selectnDiscs($link,$count-1,DISCSPERPAGE);	
					//echo $movieList->cant;
					}
					unset( $_SESSION['word']);		
					unset( $_SESSION['field']);	
					while($count<=($discList->cant+($pageNum-1)*DISCSPERPAGE)) {
		?>
        <tr><td>
        <?php 	echo $count;  ?>
        </td>
        <?php		for($index=0;$index<6;$index++){		?>
		<td>
		<?php 			if ($count%DISCSPERPAGE==0){
							$discInd=DISCSPERPAGE;
						} else $discInd=$count%DISCSPERPAGE;
							echo '<a href="#" title="'.$discList->list[$discInd]->mark.': '.$discList->list[$discInd]->review.'">'.$discList->list[$discInd]->$names[$index].'</a>';?>
        </td> 		
		<?php 
					}
            		$count++;
		?>
        </tr>
        <?php			
					}
				}
            }
		?>
	</table>
	<br>
        <span id="pages"> 
    		<a href="showMusicList.php?pageNum=1">1</a>..
    		<?php 
				for($numLinks=MAXNUMOFLINKS;$numLinks>=0;$numLinks--){
					if($pageNum-$numLinks>1){			
			?>
			<a href="showMusicList.php?pageNum=<?php echo ($pageNum-$numLinks)?>"><?php echo $pageNum-$numLinks?></a>
			<?php 
					}
				}
				for($numLinks=1;$numLinks<=MAXNUMOFLINKS;$numLinks++){
					if(($numLinks+$pageNum)<$numOfPages){			
			?>
			<a href="showMusicList.php?pageNum=<?php echo ($pageNum+$numLinks)?>"><?php echo $pageNum+$numLinks?></a>
            <?php 
					}
				}
			if ($pageNum!=$numOfPages){
			?>   
            ..<a href="showMusicList.php?pageNum=<?php echo ($numOfPages)?>"><?php echo $numOfPages?></a>
            <?php }
				closeDB($link);
			?>
		</span>
        
        <br>
        <form action="selectingDiscs.php" method="post">
        <select name="field">
			<option value="groupName">group</option>
            <option value="title">title</option>
            <option value="style">style</option>
            <option value="year">year</option>
		</select>
        <input type="text" name="word" size="20">
        <input type="submit" value="Search!">
		</form>
    <br>
    <h2><a href=<?php echo HOMEPAGE?>><< Home</a></h2>   

    </div>

</body>
</html>

 [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37