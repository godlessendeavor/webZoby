<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta name="author" content="thrasher">

	<title>Update Post</title>
</head>

<body>
<?php
$dr=$_SERVER['DOCUMENT_ROOT'];
 
include($dr."/db/classes/PostClass.php");
include($dr."/utils/cons.php");
session_start();
if ($_SESSION["privileges"]!=ADMIN) exit;
$post = new Post;
$post=$_SESSION['post'];
$post->text=str_ireplace("<br>","",$post->text);

?>
<form action="manageBlog.php" method="post">
<input type="hidden" name="id" value="<?php echo $post->id?>">
title<input type="text" name="title" size="20" value="<?php echo $post->title?>"><br>
style<input type="text" name="style" size="20" value="<?php echo $post->style?>"><br>
special<input type="text" name="special" size="20" value="<?php echo $post->special?>"><br>
topic<input type="text" name="topic" size="20" value="<?php echo $post->topic?>"><br>
file<input type="text" name="file" size="20" value="<?php echo $post->file?>"><br>
<input type="hidden" name="date" value="<?php echo $post->date?>">
text<textarea name="text" rows="20" cols="100">
<?php echo $post->text?>
</textarea><br>
<input type="submit" value="confirm update" name="action">
</form>
<a href=<?php echo BLOGPAGE?>> Home</a>

</body>
</html>