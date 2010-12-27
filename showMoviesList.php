<?php
		if(isset($_SESSION["privileges"])){
 			if ($_SESSION["privileges"]>=NOBODY) die("Access Forbidden: not enough privileges");
		} else die("Access Forbidden: no privileges defined");
		include("db/moviesdb.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="author" content="thrasher">
 	<title>My Movies</title>
    <LINK rel="stylesheet" type="text/css" href="css/moviesliststyle.css">

</head>

<body>
    <div class="content">
        <!-- start of content -->
	<table border="3px" bordercolor="#CC6600">
    <tr><th>#</th><th>Title</th><th>Director</th><th>Year</th><th>Other</th></tr><tr>
    	<?php
    	    session_start();
			$names=array("title","director","year","other");
			if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]<=NOBODY){
					$link=dbConnect(DBMOVIES);
					if(isset($_SESSION["field"])&&isset($_SESSION["word"])){
						$totalMovies=countMoviesByField($link,$_SESSION["word"],$_SESSION["field"]);
						$numOfPages=ceil($totalMovies/MOVIESPERPAGE);
						if (isset($_GET["pageNum"])){
							$pageNum=$_GET["pageNum"];						
						} else $pageNum=1;
						$count=1+($pageNum-1)*MOVIESPERPAGE;
						$movieList=searchMoviesByField($link,$_SESSION["word"],$_SESSION["field"],$count-1,MOVIESPERPAGE);
						unset($_SESSION["word"]);
						unset($_SESSION["field"]);							
					}else{
						$totalMovies=countItems($link,TABMOVIES);
						$numOfPages=ceil($totalMovies/MOVIESPERPAGE);
						if (isset($_GET["pageNum"])){
							$pageNum=$_GET["pageNum"];						
						} else $pageNum=1;
						$count=1+($pageNum-1)*MOVIESPERPAGE;
						$movieList=selectnMovies($link,$count-1,MOVIESPERPAGE);	
					//echo $movieList->cant;		
					}
					unset( $_SESSION['word']);		
					unset( $_SESSION['field']);	
					while($count<=($movieList->cant+($pageNum-1)*MOVIESPERPAGE)) {
		?>
        <tr><td>
        <?php 			echo $count;
		?>
        </td>
        <?php			for($index=0;$index<4;$index++){?>
        <td>
		<?php 			if ($count%MOVIESPERPAGE==0){
							$movInd=MOVIESPERPAGE;
						} else $movInd=$count%MOVIESPERPAGE;
						echo $movieList->list[$movInd]->$names[$index];?>        </td> 			
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
    		<a href="showMoviesList.php?pageNum=1">1</a>..
    		<?php 
				for($numLinks=MAXNUMOFLINKS;$numLinks>=0;$numLinks--){
					if($pageNum-$numLinks>1){			
			?>
			<a href="showMoviesList.php?pageNum=<?php echo ($pageNum-$numLinks)?>"><?php echo $pageNum-$numLinks?></a>
			<?php 
					}
				}
				for($numLinks=1;$numLinks<=MAXNUMOFLINKS;$numLinks++){
					if(($numLinks+$pageNum)<$numOfPages){			
			?>
			<a href="showMoviesList.php?pageNum=<?php echo ($pageNum+$numLinks)?>"><?php echo $pageNum+$numLinks?></a>
            <?php 
					}
				}
			if ($pageNum!=$numOfPages){
			?>   
            ..<a href="showMoviesList.php?pageNum=<?php echo ($numOfPages)?>"><?php echo $numOfPages?></a>
            <?php }
				closeDB($link);
			?>
	</span>
    
    <br>
        <form action="selectingMovies.php" method="post">
        <select name="field">
			<option value="director">director</option>
            <option value="year">year</option>
		</select>
        <input type="text" name="word" size="20">
        <input type="submit" value="Search!">
		</form>
    <br>
    <h2><a href=<?php echo HOMEPAGE?>> Home</a></h2> 
    </div>
</body>
</html>