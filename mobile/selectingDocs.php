<?php 
include("utils/http.php");
if (isset($_GET["pageNum"])) $_GET["pageNum"]=1;
session_start();
$_SESSION["field"]=$_REQUEST["field"];
$_SESSION["word"]=$_REQUEST["word"];
redirect("showDocsList.php");
?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37