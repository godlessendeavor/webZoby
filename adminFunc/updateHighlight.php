<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta name="author" content="thrasher">

	<title>Update Highlight</title>
</head>

<body>
<?php 
$dr=$_SERVER['DOCUMENT_ROOT'];

include($dr."/db/classes/HighlightClass.php");
include($dr."/utils/cons.php");
session_start();
if ($_SESSION["privileges"]!=ADMIN) exit;
$high = new Highlight;
$high=$_SESSION['high'];
$high->comment=str_ireplace("<br>","",$high->comment);
//$high->comment=html_entity_decode($high->comment);
?>
<form action="manageHighlights.php" method="post">
name<input type="text" name="name" size="100" value="<?php echo $high->name?>"><br>
url<input type="text" name="url" size="200" value="<?php echo $high->url?>"><br>

comment<textarea name="comment" rows="20" cols="100"><?php echo $high->comment?></textarea><br>
type<input type="text" name="type" size="20" value="<?php echo $high->type?>"><br>
<input type="submit" value="confirm update" name="action">
</form>
<a href=<?php echo HOMEPAGE?>> Home</a>

</body>
</html>