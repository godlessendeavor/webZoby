<?php
	session_start();
	include("db/postdb.php");
	$cols=79;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="author" content="thrasher">
 	<title>Blog</title>
    <link rel="stylesheet" type="text/css" href="css/blogstyle.css">
    <link rel="alternate" type="application/rss+xml" title="RSS thrash.zobyhost.com" href="rss.php"/>    	
    <script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="content">
        <!-- start of content -->
    	<h1>Blog</h1>
    	<?php    	    
    	    $link=dbConnect(DBBLOG);
    	    if (isset($_GET["postTitle"])){
				$postList=searchPostByTitle($link,$_GET["postTitle"]);
			}else{
				$postList=seekLastPosts($link,3);
			}
				$count=1;
				while($count<=$postList->cant) {
				$rows=ceil(strlen($postList->list[$count]->text)/$cols)+7;			
		?>
		<div class="post-title">
			<?php echo $postList->list[$count]->title;?>
		</div>
        <div class="post">
			<?php print($postList->list[$count]->text);?>				 	
            <div class="postinfo">
                posted at 
				<?php  echo $postList->list[$count]->date;?> 
            </div>
        </div>
        <br>   
        
        <?php
        	$post=new Post;
        	$post=$postList->list[$count];
        	if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]==ADMIN){
			?>
				<form action="adminFunc/manageBlog.php" method="post">
                <input type="hidden" name="id" value="<?php echo $post->id?>">
				<input type="hidden" name="title" value="<?php echo $post->title?>">
				<input type="hidden" name="style" value="<?php echo $post->style?>">
				<input type="hidden" name="special" value="<?php echo $post->special?>">
				<input type="hidden" name="topic" value="<?php echo $post->topic?>">
				<input type="hidden" name="file" value="<?php echo $post->file?>">
				<input type="hidden" name="text" value="<?php echo $post->text?>">
                <input type="hidden" name="date" value="<?php echo $post->date?>">
				<input type="submit" name="action" value="update">
				</form>
			
		<?php 
				}
			}
			    //echo $post->title;
            $count++;
            }
		?>

            <!-- End .post -->

                <!-- Begin #comments -->
<!--
            <div id="comments">
                <a name="comments"></a>
                <h3> Comments:</h3>
                <dl id="comments-block">

                    <dt class="postinfo" id="c<$BlogCommentNumber$>"><a name="c<$BlogCommentNumber$>"></a>
                        <$BlogCommentAuthor$> said...
                    </dt>
                    <dd class="comment-body">

                        <p><$BlogCommentBody$></p>
                    </dd>
                    <dd class="comment-timestamp"><a href="#<$BlogCommentNumber$>" title="comment permalink"><$BlogCommentDateTime$></a>
                        <$BlogCommentDeleteIcon$>
                    </dd>

                </dl>
                <p class="comment-timestamp">

                    <$BlogItemCreate$>
                </p>

                <a name="links"></a><h4>Links to this post:</h4>
                <dl id="comments-block">

                    <dt class="comment-title">
                        <$BlogBacklinkControl$>
                        <a href="<$BlogBacklinkURL$>" rel="nofollow"><$BlogBacklinkTitle$></a> <$BlogBacklinkDeleteIcon$>
                    </dt>
                    <dd class="comment-body"><$BlogBacklinkSnippet$>
                        <br />
                        <span class="comment-poster">
                            <em>posted by <$BlogBacklinkAuthor$> @ <$BlogBacklinkDateTime$></em>
                        </span>
                    </dd>

                </dl>
                <p class="comment-timestamp"><$BlogItemBacklinkCreate$></p>


            </div>

-->
            <!-- End #comments -->

            <!-- end of content-->
			
			<span id="previousPost">previous post: 
			<?php 
				$postList=seekPrevPost($link,$post->date);
				$postTitle="";
				if ($postList->cant>0) $postTitle=$postList->list[1]->title;
			?>
			<a href="blogpage.php?postTitle=<?php echo $postTitle?>">
				 <?php echo $postTitle?></a>
			</span>
			<span id="nextPost">next post:
			<?php 
				$postList=seekNextPost($link,$post->date);
				if ($postList->cant>0) $postTitle=$postList->list[1]->title;
			?>
			<a href="blogpage.php?postTitle=<?php echo $postTitle?>">
				 <?php echo $postTitle?></a>
			</span>
        </div>

        <div id="links"><br>
        
        <h2>Posts Previos</h2><br>
        <ul id="ArchivoPosts" class="MenuBarVertical">
          <li><a class="MenuBarItemSubmenu" href="#">Por mes</a>
        	<ul>
          		<?php 
          			$month=1;
		  			for($month;$month<13;$month++){
						$postList=searchPostsByMonth($link,$month);
						if ($postList->cant>0){
							$count=1;
							echo '<li><a class="MenuBarItemSubmenu" href="#">'.$MONTH_NAMES[$month-1].'</a><ul class="MenuItem">';					
							while($count<=$postList->cant) {
								$postTitle=$postList->list[$count]->title;
								echo '<li><a href="blogpage.php?postTitle='.$postTitle.'">'.$postTitle.'</a></li>';
								$count++;
							}
							echo '</ul></li>';
						}
					}
				?>
            </ul>
          </li>
          <li><a href="#">Por tema</a></li>
          <li><a class="MenuBarItemSubmenu" href="#">Por titulo</a>
          	<ul class="MenuItem">
          		<?php
    				$postList=selectAllPosts($link);
					$count=1;
					while($count<=$postList->cant) {
						$postTitle=$postList->list[$count]->title;
				?>
			     <li><a href="blogpage.php?postTitle=<?php echo $postTitle?>">
				 <?php echo $postTitle?></a></li>
			     <?php 
			     	$count++;
				 }
				closeDB($link);
				 ?>
            </ul>
          </li>
         
        </ul>

        <p><br>
        </p>
    <h2>Links</h2><br>

            <h2><a href=<?php echo HOMEPAGE?>>Home</a></h2>          
            <a href="adminAccess.htm">Admin</a><br>
            <?php         	
				if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]==ADMIN){
					echo "<a href=\"/adminFunc/newPost.htm\">NewPost</a><br>";
					}
				}
			?>
            

        </div>

<script type="text/javascript">
<!--
var ArchivoPosts = new Spry.Widget.MenuBar("ArchivoPosts", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>