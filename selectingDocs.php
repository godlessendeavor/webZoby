<?php 
include("utils/http.php");
if (isset($_GET["pageNum"])) $_GET["pageNum"]=1;
session_start();
$_SESSION["field"]=$_REQUEST["field"];
$_SESSION["word"]=$_REQUEST["word"];
redirect("showDocsList.php");?>