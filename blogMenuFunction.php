<?php 
function menuFunction($menuIt,$menuSide,$link){
	$out='';
		switch($menuIt){
			case '0':				
				//recogemos por titulo
				$postList=selectAllPosts($link);
				$count=1;
				switch($menuSide){
					case 'right':
						
						$out.='<ul class="submenu">';
						for($count=1;$count<=$postList->cant;$count++) {
							$postTitle=$postList->list[$count]->title;
							$out.='<li';
							if ($count==1) $out.=' class="showing"'; 
							$out.='><a href="blogpage.php?postTitle='.$postTitle.'"> '.$postTitle.'</a></li>';
						 }
						$out.='</ul>';
						break;
					case 'left':
						for($count=1;$count<=$postList->cant;$count++) {
							$out.='<div';
							if ($count==1) $out.=' class="showing"'; 
							$out.='>'.substr($postList->list[$count]->text,0,1000).'</div>'; //catch a piece of the text
						
						 }	
						break;
					default :
						$out='Menu not found';
					break;
				}
				break;
			case '1':
				//por fecha
				switch($menuSide){
					case 'right':
						$out.='<div id="datePosts"></div>';
						break;
					case 'left':
						$postList=selectAllPosts($link);
						$count=1;
						for($count=1;$count<=$postList->cant;$count++) {
							$out.='<div';
							if ($count==1) $out.=' class="showing"'; 
							$out.='>'.substr($postList->list[$count]->text,0,2000).'</div>'; //catch a piece of the text
						}	
						break;
					default :
						$out='Menu not found';
					break;
				}
				break;
			case '2':
				//links
				switch($menuSide){
					case 'right':
						break;
					case 'left':
						$out='<a href="'.HOMEPAGE.'">Home</a><br><a href="adminAccess.htm">Admin</a><br>';	       	
						if(isset($_SESSION["privileges"])){
		            	if ($_SESSION["privileges"]==ADMIN){
							$out.='<a href="/adminFunc/manageBlog.php">NewPost</a><br>';
							}
						}
						break;
					default :
						$out='Menu not found';
					break;
				}
				break;
			default :
				$out='Menu not found';
				break;
		}
		return($out);
	}


?>