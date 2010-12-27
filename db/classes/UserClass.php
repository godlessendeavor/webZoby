<?php

/**
 * @author thrasher
 * @copyright 2009
 */

	class User{
		var $nick;
		var $pswd;
		var $privileges;

		function setUser($array){
			$this->nick=$array["nick"];
			$this->pswd=$array["pswd"];
			$this->privileges=$array["privileges"];
		}
	}


?>