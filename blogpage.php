<?php
	session_start();
	include("db/postdb.php");
	include('blogMenuFunction.php');
	$cols=79;
	$link=dbConnect(DBBLOG);
    mysql_query("SET NAMES 'utf8'");
	$datePosts=seekDatePosts($link);
	include('utils/http.php');
	ifNotModifiedSince(setLastModified()); // send http header if-modified-since introduce date of last post
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="thrasher" />
 	<title>The fragile art of existence</title>
    <link rel="stylesheet" type="text/css" href="css/blogstyle.css" />    
    <link rel="alternate" type="application/rss+xml" title="RSS thrash.zobyhost.com" href="rss.php" />  
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"> </script>
    <script type="text/javascript" src="js/jquery.jstree.js"></script>
    <script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script>
    <script src="js/googleAnalytics.js" type="text/javascript"></script>
    
    <style type="text/css">
    <?php 
    	$noMenu=count($blogMenuArray);
    	for($mi=0;$mi<$noMenu;$mi++){
    		echo('#hidden-div'.$mi.'{
			  position: absolute;
			  width: 120%;
			  height: 20em;
			  margin: -1px -10% 0 -12%;
			  padding: 1.5em;
			  background: #873431;
			  display: none;
			  z-index: 100;
			  -webkit-border-radius: 1em; /*rounded borders Safari */
  			  -moz-border-radius: 1em; /*rounded borders  Firefox */
			}');
    	}
    ?>
    </style>
<script type="text/javascript">
<?php 
echo('$(document).ready(function() {');
for($mi=0;$mi<$noMenu;$mi++){
	echo('var hide'.$mi.' = false;');
	echo('$("#menu'.$mi.'").hover(function(){          
		   if (hide'.$mi.') clearTimeout(hide'.$mi.');
            $("#hidden-div'.$mi.'").fadeTo(500,1);            
			$(this).addClass("active");
        }, function() {            
			hide'.$mi.' = setTimeout(function() {$("#hidden-div'.$mi.'").fadeOut("fast");});
			$("#menu'.$mi.'").removeClass("active");
        });		
        $("#hidden-div'.$mi.'").hover(function(){
            if (hide'.$mi.') clearTimeout(hide'.$mi.');
            $("#menu'.$mi.'").addClass("active");
        }, function() {
			hide'.$mi.' = setTimeout(function() {$("#hidden-div'.$mi.'").fadeOut("fast");});
			$("#hidden-div'.$mi.'").stop().fadeTo(500,1);
			$("#menu'.$mi.'").removeClass("active");
        });');
}
echo('});');
?>
</script>

<script type="text/javascript">
$(document).ready(function(){	
	$(function () {
			$("#datePosts").jstree({
				"core" : { "initially_open" : [ "root" ] },
				"html_data" : {
					"data" : "<?php echo $datePosts;?>"
				},
				"themes" : {
					"theme" : "default",
					"dots" : false,
					"icons" : false
				},
				"plugins" : [ "themes", "html_data" ]
			});
		});		
	//switcher for brief views of posts when mouse is over titles (needed to be after the previous code)
    switches = $('.submenu > li');
    slides = $('#hidden-div-left > div');
    switches.each(function(idx) {
            $(this).data('slide', slides.eq(idx));
        }).hover(
        function() {
            switches.removeClass('showing');
            slides.removeClass('showing');             
            $(this).addClass('showing');  
            $(this).data('slide').addClass('showing');
        });   
});
</script>


</head>
    
<body>
    <div id="content">
        <!-- start of content -->
    	<h1>Blog</h1>
        <div id="RSSFeed">
        	<a href="rss.php"><img src="graphix/rssIcon.jpg" width="20px"></a>
            <a href="rss.php">Subscr&iacute;bete!!</a>
        </div>
 <!-- ***********************************************MENU************************************************** -->	
        <div id="menu">
			<ul>
				<?php 
					//creamos menu
					for($mi=0;$mi<$noMenu;$mi++){
						echo('<li><a href="#" id="menu'.$mi.'">'.$blogMenuArray[$mi].'</a></li>');
					}
				?>
			</ul>
		</div>
		<!-- BEGIN HIDDEN DIV -->
		<?php 
			//creamos menu
			for($mi=0;$mi<$noMenu;$mi++){
		?> 
			<div id="hidden-div<?php echo $mi;?>">            
				<div id="hidden-div-left">
				    <?php echo(menuFunction($mi,'left',$link));?> <!-- Funcion incluida en blogMenuFunction.php -->
				</div>
				<div id="hidden-div-right">
				    <?php echo(menuFunction($mi,'right',$link));?>
				</div>                
			</div>
		<?php }?>
		<!-- END HIDDEN DIV -->
		
<!-- ***********************************************POST************************************************** -->		

        <br>
        <br>
    	<?php   
    	$datePosts=seekDatePosts($link);
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
            <fb:like ref="<?php echo $postList->list[$count]->title;?>" href="http://thrash.zobyhost.com/blogpage.php" layout="button_count" width="300" font="arial"></fb:like> <!-- facebook like widget-->
            
        </div>
        <br>   
        
        <?php
        	$post=new Post;
        	$post=$postList->list[$count];
        	if(isset($_SESSION["privileges"])){
            	if ($_SESSION["privileges"]==ADMIN){
			?>	
				
				<form action="adminFunc/manageBlog.php" method="post">
                <input type="hidden" name="id" value="<?php echo $post->id;?>">
				<input type="submit" name="action" value="Update">
				</form>
				<form action="adminFunc/manageBlog.php" method="post">
                <input type="hidden" name="id" value="<?php echo $post->id;?>">
				<input type="submit" name="action" value="Delete">
				</form>
			
		<?php 
				}
			}
			
			    //echo $post->title;
            $count++;
            }
		?>

            <!-- End post -->

            <!-- end of content-->
			<div class="forendPost">
				<span id="previousPost">post previo: 
				<?php 
                    $postList=seekPrevPost($link,$post->date);
                    $postTitle="";
                    if ($postList->cant>0) $postTitle=$postList->list[1]->title;
                ?>
                <a href="blogpage.php?postTitle=<?php echo $postTitle;?>">
                     <?php echo $postTitle;?></a>
                </span>
                <span id="nextPost">post siguiente:
                <?php 
                    $postList=seekNextPost($link,$post->date);
                    if ($postList->cant>0) $postTitle=$postList->list[1]->title;
                ?>
                <a href="blogpage.php?postTitle=<?php echo $postTitle;?>">
                     <?php echo $postTitle;?></a>
                </span>
            </div>
        </div>


</body>
</html>
