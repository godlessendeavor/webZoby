<?php

if(isset($_SESSION["privileges"])){
 	if ($_SESSION["privileges"]>=NOBODY) die("Access Forbidden: not enough privileges");
} else die("Access Forbidden: no privileges defined");

	Class Form {
		
		public function simpleTextearea( $title, $input, $value ) {
			return $title.'<br/><textarea '.$input.'rows="20" cols="150">'.$value.'</textarea><br/>';
		}
		public function wysiwygTextarea( $text ) {
			$content = "<script type='text/javascript'>
			bkLib.onDomLoaded(function() {
				new nicEditor({fullPanel : true, maxHeight: 450, xhtml: true}).panelInstance('text');
			});
			</script>";
			$content .= 'Post <br/>';
			$content .= '<textarea  style="height:300px;width:100%;" id="text" name="text">'.$text.'</textarea>'."<br/>";
			return $content;
		}
	}
?>