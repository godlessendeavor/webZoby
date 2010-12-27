<?php

/**
 * @author thrasher
 * @copyright 2009
 */
 	
	$dr=$_SERVER['DOCUMENT_ROOT'];
	include($dr."/db/postdb.php");
 	include($dr."/utils/http.php");

	session_start();
	if ($_SESSION["privileges"]!=ADMIN) exit;
    $post=new Post;

	$link=dbConnect(DBBLOG);

	switch($_REQUEST["action"]){
		case "show":
			$postList=seekLastPosts($link,MAX_POSTS);
		break;
		case "insert":
			$post = new Post;
			$post->setPost($_REQUEST);
			insertPost($post,$link);
			redirect("../".BLOGPAGE);
		break;
		case "update":
			$post = new Post;
			$post->setPost($_REQUEST);
			$_SESSION['post']=$post;			
			redirect("updatePost.php");
		break;
		case "confirm update":
			$post = new Post;
			$post->setPost($_REQUEST);
			$id=$_SESSION['post']->title;
			updatePost($post,$link,$id);
			redirect("../".BLOGPAGE);
		break;
	}

?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37