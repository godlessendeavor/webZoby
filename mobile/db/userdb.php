<?php

	include("classes/UserClass.php");
	$dr=$_SERVER['DOCUMENT_ROOT'];
	$dr=$dr."/utils/cons.php";
	include($dr);
        

	$tabusers=TABUSERS;

	//SELECT ALL USERS
	function selectAll($link){
		global $tabusers;
		$result=mysql_query("select * from ".$tabusers,$link);
		return $result;
	}	
	
	//SEARCH USER PRIVILEGES
	function searchUsr($user,$link){
		global $tabusers;
		$query="select * from ".$tabusers." where nick=\"".$user->nick."\"";
		$result=mysql_query($query,$link);
		$row=mysql_fetch_array($result);
		$userFound = new User;
		$userFound->setUser($row);
		//echo $userFound->pswd." -> ".md5($userFound->pswd)."<br>".$user->pswd;
		if (md5($userFound->pswd)==$user->pswd) $user->privileges=$userFound->privileges;
			else $user->privileges=NOBODY;
		return $user;	
	}
	
	//CREATE NEW USER
	function newUsr($user,$link){
		global $tabusers;
		$values="(\"".$user->nick."\","."\"".$usr->pswd."\","."\"".$usr->privileges."\")";
		$insert="insert into ".$tabusers." (nick,pswd,privileges) values ".$values;
		$result=mysql_query($insert,$link);
	}
	
	//UPDATE USER
	function updateUsr($user,$link){
		global $tabusers;
		$update="update ".$tabusers." set nick=\"".$user->nick."\",pswd=\"".$user->pswd."\",privileges=\"".$user->privileges."\" 
			where nick=\"".$user->nick."\"";
		mysql_query($update,$link);		
	}
	

?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37