<?php
@session_cache_expire( EXPIRE_SESSIONS );
@session_start();
if(isset($_SESSION["privileges"])){
 	if ($_SESSION["privileges"]>=NOBODY) die("Access Forbidden: not enough privileges");
} else die("Access Forbidden: no privileges defined");


define('PATH', dirname(__FILE__).'/');
define('EXPIRE_SESSIONS', 30 );
define('FREE_FR', false);
define('DISPLAY_ERRORS', false);

$IP_ADMIN = array(); //admin IP for direct access

if ( is_file(PATH.'wysiwygEditor.php') ) include_once( PATH.'wysiwygEditor.php');
include($_SERVER['DOCUMENT_ROOT'].'/db/postdb.php');
include($_SERVER['DOCUMENT_ROOT'].'/utils/http.php');

$link=dbConnect(DBBLOG);
$post = new Post;
if (!isset($_SESSION['editorType'])) $_SESSION['editorType']='wysiwyg'; //initializing editor type

$submit='Insert';
if (isset($_REQUEST['action'])){       //si hemos recibido insert/update/cambiar editor
	$post->setPost($_REQUEST);
	$coding=true;
	switch($_REQUEST["action"]){
	case 'Change editor type':
		if ($_SESSION['editorType']=='wysiwyg') $_SESSION['editorType']='simpledit';
		else $_SESSION['editorType']='wysiwyg';
		if (isset($_REQUEST['id'])){	 //si hemos recibido un update de la página del blog buscamos el post en la base de datos
			if ($_REQUEST['id']>0) {
				$submit='Confirm update';
			}
		}
	break;
	case 'Insert':
		insertPost($post,$link,$coding);
		redirect(BLOGPAGE);
	break;
	case 'Confirm update':
		updatePost($post,$link,$coding);
		redirect(BLOGPAGE);
	break;
	case 'Update':
		if (isset($_REQUEST['id'])){	 //si hemos recibido un update de la página del blog buscamos el post en la base de datos
			if ($_REQUEST['id']>0) {
				$post=searchPostById($link,$_REQUEST['id']);
				$submit='Confirm update';
			}
		}
	break;
	case "Delete":		
		if (isset($_REQUEST['id'])) deletePost($_REQUEST['id'],$link);
		redirect(BLOGPAGE);
	break;
	default: 
		redirect(BLOGPAGE);
	break;
	}
}

$tpl->content = '';



// end configuration 

/*	if ( count( $IP_ADMIN ) > 0 ) {
		if ( ! in_array( $_SERVER['REMOTE_ADDR'], $IP_ADMIN ) ) {
			header('location: '.INDEX.'.php');die();
		}
	}
	*/

// Error reporting, to be set in config.php 

if ( DISPLAY_ERRORS === true  ) {
	@ini_set('display_errors', 1);
	@ini_set('html_errors', 1);
	@error_reporting(E_ALL);
} else {
	@ini_set('display_errors', 0);
	@ini_set('html_errors', 0);
	@error_reporting(0);
}

if ( ! REGISTER_GLOBALS ) @import_request_variables('GPC', '');
if (@extension_loaded('zlib')) { if(!@ob_start('ob_gzhandler')) @ob_start(); }


// initialisation 


$ip = !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
define('SECU_SESSION', $ip.''.PATH.''.$_SERVER['HTTP_USER_AGENT']);
if( isset( $_SESSION ) ) {
	@$_SESSION['secu'] = SECU_SESSION;
} elseif( @$_SESSION['secu'] !== SECU_SESSION ) {
	@session_regenerate_id();
	$_SESSION = array();
}
/////////////////////////////////////////////creamos HTML///////////////////////////////////////////////

echo('<html><head><title>	New Post </title></head> <body>');
$post->decodeChars('UTF-8');
echo menu($post,$submit);
echo('<br /><a href="../blogpage.php"> Blog</a></body></html>');

	

/////////////////////////////////////////////funcion para crear los formularios///////////////////////////////////
	
function menu($post,$submit) {
		
	$tpl->content .= '<script type="text/javascript" src="../js/controlEditor.js"></script>';
	$tpl->content .= "<form action=\"manageBlog.php\" method=\"post\" name='InputLimiter'>";
	$tpl->content .= "Title<br /><input type=\"text\" name='title' id='LettersOnly' onkeypress='return inputLimiter(event,\"Letters\")' value='".$post->title."' size=\"100\" /></input><br/>";
	$tpl->content .= "Style<br/><input type=\"text\" name='style' id='LettersOnly' onkeypress='return inputLimiter(event,\"Letters\")' value='".$post->style."' size=\"100\" /></input><br/>";
	$tpl->content .= "Special<br/><input type=\"text\" name='special' id='LettersOnly' onkeypress='return inputLimiter(event,\"Letters\")' value='".$post->special."' size=\"100\" /></input><br/>";
	$tpl->content .= "Topic<br/><input type=\"text\" name='topic' id='LettersOnly' onkeypress='return inputLimiter(event,\"Letters\")' value='".$post->topic."' size=\"100\" /></input><br/>";
	$tpl->content .= "File<br/><input type=\"text\" name='file' id='LettersOnly' onkeypress='return inputLimiter(event,\"Letters\")' value='".$post->file."' size=\"100\" /></input><br/>";

	$form = new Form();

	if ( $_SESSION['editorType'] == 'simpledit' ) {
		$tpl->content .= $form->simpleTextearea( "Post", 'name="text" id="textarea"', $post->text);
	} elseif ( $_SESSION['editorType'] == 'wysiwyg' ) {
		$tpl->content .= '<script type="text/javascript" src="../js/wysiwygEditor.js"></script>'."\n";
		$tpl->content .= $form->wysiwygTextarea( $post->text );
	} 
	//echo($post->id);
	$tpl->content .= '<input type="hidden" name="id" value="'.$post->id.'"></input>';
	$tpl->content .= "<center><input type=\"submit\" value=\"".$submit."\" name=\"action\"/></input>
							<input type=\"submit\" value=\"Change editor type\" name=\"action\"></input>
							</center></form><br /><br />";
	return $tpl->content;
}
?>