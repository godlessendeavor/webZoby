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


?> [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37