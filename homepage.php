<?php
	session_start();
	include("db/highlightsdb.php");
	include("utils/lang.php"); //detecting language
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include($dr.'/languages/texts_'.$_SESSION["idioma"].'.php'); //including template needed for language
	unset( $_SESSION['word']);	 //unsetting session vars for media lists	
	unset( $_SESSION['field']);
	include('utils/http.php');
	ifNotModifiedSince(setLastModified()); // send http header if-modified-since
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $home_title;?></title>
<meta name="Keywords" content="thrash F1" http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="css/homestyle.css" rel="stylesheet" type="text/css" media="screen"/>
<link type="text/css" href="css/jquery.css" rel="stylesheet" />	
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.innerfade.js"></script>
<script type="text/javascript">
$(function(){
	//jquery-ui widgets
	// Accordion
	$("#accordion").accordion({ header: "h3" });

	// Tabs
	var noHighTypes=<?php echo(count($highTypeArray));?>;
	for (var i=1;i<=noHighTypes;i++){
		$('#tabs'+i).tabs();
		}
  
	//hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
});

$(document).ready(
function(){
	$('ul#portfolio').innerfade({
		speed: 1000,
		timeout: 5000,
		type: 'sequence',
		containerheight: '160px' //20px more than the pictures
	});
});
</script>
</head>
<!--  .............................................body.......................................................... -->
<body class="mainCl">

<div id="container">

  <div id="header">
  <ul id="portfolio"> 
  	<li style="width: 100%;"> 
  		<img id="imgheader" src="graphix/NY.jpg" alt="New York" />
  	</li>
  	<li style="width: 100%;"> 
  		<img id="imgheader" src="graphix/lon.jpg" alt="London"/>
  	</li>
  	<li style="width: 100%;"> 
  		<img id="imgheader" src="graphix/tor.jpg" alt="Toronto" />
  	</li>
  </ul>
  </div>  <!-- end #header -->
  
  <div id="sidebar1">
    <h3>Menu</h3>

    <table class="Menu">
    <tr><td><a href=<?php echo BLOGPAGE;?>> Blog </a></td></tr>
    <tr><td><a href="cv.php">CV online</a></td></tr>
    <tr><td><a href="adminAccess.htm">Log in</a></td></tr>
    <?php if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]<NOBODY){
	?>
    <tr><td><a href="showMusicList.php"> Music List </a></td></tr>
    <tr><td><a href="showMoviesList.php"> Movies List </a></td></tr>
    <tr><td><a href="showDocsList.php"> Docs List </a></td></tr>
    <tr><td><a href="logout.php"> Log out </a></td></tr>
    <?php }}
	?>
    </table>

  <!-- end #sidebar1 --></div>
  <div id="sidebar2">
    <h3>Destacados</h3>
    <?php 
    	//$highTypeArray se encuentra definida en highlightsdb y $highNameArray esta en los ficheros de idiomas
		$link=dbConnect(DBBLOG);
		echo ('<div id="accordion">');
		$conTabs=0; //contador para enumerar cantidad de tablas usadas en toda la pagina
		for($contHigh=1;$contHigh<=count($highTypeArray);$contHigh++){  //todas las highlights
			$highlightList=seekLastHighlights($link,1,$highTypeArray[$contHigh-1]);
			if ($highlightList->cant>0){
			
				if ($highlightList->list[1]->url!=''){ //observamos si esnecesaria url o no
					$urlpres=true;
				} else {
					$urlpres=false;
				}
				
				echo ('<div><h3><a href="#">'.$highNameArray[$contHigh-1].'</a></h3>'); //nombre de tipo de highlight
				echo '<div id="tabs'.$contHigh.'">';   //comienzo de tablas
				echo '<ul><li><a href="#tabs'.$contHigh.'-'.($conTabs+1).'">'.$highKind[0].'</a></li>
						  <li><a href="#tabs'.$contHigh.'-'.($conTabs+2).'">'.$highKind[1].'</a></li>';
				if ($urlpres) echo '<li><a href="#tabs'.$contHigh.'-'.($conTabs+3).'">'.$highKind[2].'</a></li>'; //si hay url la ponemos
				echo '</ul>';
				
				echo '<div id="tabs'.$contHigh.'-'.($conTabs+1).'">'.$highlightList->list[1]->name.'</div>';
				echo '<div id="tabs'.$contHigh.'-'.($conTabs+2).'">'.$highlightList->list[1]->comment.'</div>';
				if ($urlpres){					
					echo '<div id="tabs'.$contHigh.'-'.($conTabs+3).'"><a id="urlLink" target="_blank" href="'.$highlightList->list[1]->url.'">'.$highlightList->list[1]->url.'</a></div>';
				    $conTabs=$conTabs+3;
				}else $conTabs=$conTabs+2;
				if(isset($_SESSION["privileges"])){
   		 			if ($_SESSION["privileges"]==ADMIN){
	?>
    			<form action="adminFunc/manageHighlights.php" method="post">
                <input type="hidden" name="id" value="<?php echo $highlightList->list[1]->id?>" />
				<input type="hidden" name="name" value="<?php echo $highlightList->list[1]->name?>" />
				<input type="hidden" name="url" value="<?php echo $highlightList->list[1]->url?>" />
				<input type="hidden" name="comment" value="<?php echo $highlightList->list[1]->comment?>" />
                <input type="hidden" name="type" value="<?php echo $highlightList->list[1]->type?>" />
                <input type="hidden" name="date" value="<?php echo $highlightList->list[1]->date?>" />
				<input type="submit" name="action" value="update" />
                <input type="submit" name="action" value="delete" />
				</form>
                <br />

    <?php			
				}}
				echo ('</div>'); //end of tabs
				echo ('</div>'); //end of accordion cell				
			}
		}
		echo ('</div>'); //end of accordion class
		if(isset($_SESSION["privileges"])){
   		 	if ($_SESSION["privileges"]==ADMIN){
                 $dr=$_SERVER['DOCUMENT_ROOT'];
                 echo '<a href="/adminFunc/newHighlight.htm">New Highlight</a><br>';
             }
		}
	?>

  <!-- end #sidebar2 --></div>
  <div id="mainContent">
  	<div id="langFlags">
    	<a title="Cambia a galego" href="homepage.php?idioma=gl"><img src="graphix/gflag.jpg" alt="galego" /></a>
    	<a title="Change to English" href="homepage.php?idioma=en"><img src="graphix/ukflag.jpg" alt="english" /></a>
    	<a title="Cambia a Espa&ntilde;ol" href="homepage.php?idioma=es"><img src="graphix/sflag.jpg" alt="espanhol" /></a>
    </div>
    <?php echo $home_main;?>
	
  </div><!-- end #mainContent -->
	<br class="clearfloat" />
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
   <div id="footer">
    <a href="mailto:dreaminneon@hotmail.com">Webmaster</a>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>