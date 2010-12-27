<?php
	session_start();
	include("db/highlightsdb.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>P&aacute;gina personal de Jos&eacute; Luis Villar Bardanca</title>
<meta name="Keywords" content="thrash F1" http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="css/homemobile.css" rel="stylesheet" type="text/css"/>
</head>

<body class="thrColHybHdr">

<div id="container">
  <div id="mainContent">
	
    <h1><center>WELCOME!</center></h1>
    Bienvenidos a esta web. Algunos contenidos est&aacute;n todav&iacute;a en desarrollo, pero otros como el blog y el CV en l&iacute;nea ya est&aacute;n disponibles. <br />
    &iexcl;Espero que los disfruteis!<br />
    NOVEDAD: Ahora ya est&aacute; disponible el acceso mediante m&oacute;vil con otra fisonom&iacute;a un poco m&aacute;s adecuada. &iexcl;Saludos!

	<!-- end #mainContent --></div>

  <div id="sidebar1">
    <h3>Menu</h3>

    <table class="Menu">
    <tr><td><a href="./blogpage.php"> Blog </a></td></tr>
    <tr><td><a href="./CV/index.htm">CV online</a></td></tr>
    <tr><td><a href="./adminAccess.htm">Log in</a></td></tr>
    <?php if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]<NOBODY){
	?>
    <tr><td><a href="./showMusicList.php"> Music List </a></td></tr>
    <tr><td><a href="./showMoviesList.php"> Movies List </a></td></tr>
    <tr><td><a href="./showDocsList.php"> Docs List </a></td></tr>
    <tr><td><a href="./logout.php"> Log out </a></td></tr>
    <?php }}?>
    </table>

  <!-- end #sidebar1 --></div>
  <div id="sidebar2">
    <h3>Destacados</h3>
    <?php 
		$link=dbConnect(DBBLOG);
		$highTypeArray=array("SENTENCE","VIDEO","WEB","MUSIC","MOVIE");
		$highNameArray=array("Sentencia","V&iacute;deo","Web","M&uacute;sica","Pel&iacute;cula");
		for($contHigh=0;$contHigh<count($highTypeArray);$contHigh++){
			$highlightList=seekLastHighlights($link,1,$highTypeArray[$contHigh]);
			if ($highlightList->cant>0){
				echo '<span class="subHeader">'.$highNameArray[$contHigh].':</span><br/>';
				echo '<div class="smallText">'.$highlightList->list[1]->name;
				echo '<br>';
				if ($highlightList->list[1]->url!=''){
					echo '<span class="subSubHeader">url: </span><a id="urlLink" target="_blank" href="'.$highlightList->list[1]->url.'">'.$highlightList->list[1]->url.'</a>';
					echo '<br>';
				}
				echo '<span class="subSubHeader">comentario: </span>'.$highlightList->list[1]->comment;
				echo '<br><br></div>';
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
			}
		}
		if(isset($_SESSION["privileges"])){
   		 	if ($_SESSION["privileges"]==ADMIN){
                 $dr=$_SERVER['DOCUMENT_ROOT'];
                 echo "<a href=\"/adminFunc/newHighlight.htm\">New Highlight</a><br>";
             }
		}
	?>

  <!-- end #sidebar2 --></div>

	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
   <div id="footer">
    <a href="mailto:dreaminneon@hotmail.com">Webmaster</a>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>