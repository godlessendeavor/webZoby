<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta name="author" content="thrasher">
 	<title>My Docs</title>
    <LINK rel="stylesheet" type="text/css" href="css/moviesliststyle.css">
	<?php
		include("db/docsdb.php");
	?>

</head>

<body>
    <div class="content">
        <!-- start of content -->
	<table border="3px" bordercolor="#CC6600">
    <tr><th>#</th><th>Title</th><th>Loc</th><th>Type</th><th>Comments</th></tr><tr>
    	<?php
    	    session_start();
			$names=array("title","loc","type","comments");
			if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]<=NOBODY){
					$link=dbConnect(DBMOVIES);
					if(isset($_SESSION["field"])&&isset($_SESSION["word"])){
						$totalDocs=countDocsByField($link,$_SESSION["word"],$_SESSION["field"]);
						$numOfPages=ceil($totalDocs/DOCSPERPAGE);
						if (isset($_GET["pageNum"])){
							$pageNum=$_GET["pageNum"];						
						} else $pageNum=1;
						$count=1+($pageNum-1)*DOCSPERPAGE;
						$docsList=searchDocsByField($link,$_SESSION["word"],$_SESSION["field"],$count-1,DOCSPERPAGE);
						unset($_SESSION["word"]);
						unset($_SESSION["field"]);							
					}else{
						$totalDocs=countItems($link,TABDOCS);
						$numOfPages=ceil($totalDocs/DOCSPERPAGE);
						if (isset($_GET["pageNum"])){
							$pageNum=$_GET["pageNum"];						
						} else $pageNum=1;
						$count=1+($pageNum-1)*DOCSPERPAGE;
						$docsList=selectnDocs($link,$count-1,DOCSPERPAGE);	
					//echo $movieList->cant;		
					}
					unset( $_SESSION['word']);		
					unset( $_SESSION['field']);	
					while($count<=($docsList->cant+($pageNum-1)*DOCSPERPAGE)) {
		?>
        <tr><td>
        <?php 			echo $count;
		?>
        </td>
        <?php			for($index=0;$index<4;$index++){?>
        <td>
		<?php 			if ($count%DOCSPERPAGE==0){
							$docInd=DOCSPERPAGE;
						} else $docInd=$count%DOCSPERPAGE;
						echo $docsList->list[$docInd]->$names[$index];?>        </td> 			
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
    		<a href="showDocsList.php?pageNum=1">1</a>..
    		<?php 
				for($numLinks=MAXNUMOFLINKS;$numLinks>=0;$numLinks--){
					if($pageNum-$numLinks>1){			
			?>
			<a href="showDocsList.php?pageNum=<?php echo ($pageNum-$numLinks)?>"><?php echo $pageNum-$numLinks?></a>
			<?php 
					}
				}
				for($numLinks=1;$numLinks<=MAXNUMOFLINKS;$numLinks++){
					if(($numLinks+$pageNum)<$numOfPages){			
			?>
			<a href="showDocsList.php?pageNum=<?php echo ($pageNum+$numLinks)?>"><?php echo $pageNum+$numLinks?></a>
            <?php 
					}
				}
			if ($pageNum!=$numOfPages){
			?>   
            ..<a href="showDocsList.php?pageNum=<?php echo ($numOfPages)?>"><?php echo $numOfPages?></a>
            <?php }
				closeDB($link);
			?>
	</span>
    
    <br>
        <form action="selectingDocs.php" method="post">
        <select name="field">
			<option value="title">title</option>
            <option value="theme">type</option>
		</select>
        <input type="text" name="word" size="100">
        <input type="submit" value="Search!">
		</form>
    <br>
    <h2><a href=<?php echo HOMEPAGE?>><< Home</a></h2> 
    </div>
</body>
</html>

 [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37