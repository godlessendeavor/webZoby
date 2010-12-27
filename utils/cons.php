<?php
//FICHERO DE CONSTANTES
	//DATABASE CONSTRAINTS
	define("HOST","localhost:3306");
	define("USR","root");
	define("PSWD","nevermore");
	//DATABASE NAMES
	define("DBBLOG","blog");
	define("DBMOVIES","movies");
	define("DBMUSIC","movedb");
	//DATABAES TABLE NAMES
	define("TABMOVIES","movies");
	define("TABMUSIC","music");
	define("TABUSERS","users");
	define("TABDOCS","docs");
	define("TABPOSTS","entries");
	//ROUTING
	define("HOMEPAGE","/homepage.php");
	define("BLOGPAGE","/blogpage.php");
	//USER PRIVILEGES
	define("GUEST",2);
	define("ADMIN",1);
	define("NOBODY",3);
	//OTHER CONSTRAINTS
	define("MOVIESPERPAGE",40);
	define("DOCSSPERPAGE",40);
	define("DISCSPERPAGE",40);
	define("MAXNUMOFLINKS",3);
	define("CODING","UTF-8");
	//arrays
	$MONTH_NAMES=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$blogMenuArray=array("Posts por titulo","Posts por fecha","Links");
?>