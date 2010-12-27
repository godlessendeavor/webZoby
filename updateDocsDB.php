<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
		include("db/docsdb.php");
		include("db/userdb.php");
	?>

<title>Update DB</title>
</head>
<body>
	<?php
		$link=dbConnect(DBBLOG);
		$user = new User;
		if (isset($_GET["nick"])&isset($_GET["pswd"])){
			$user->nick=$_GET["nick"];
			$user->pswd=md5($_GET["pswd"]);		
			$user->privileges=NOBODY;
			$user=searchUsr($user,$link);
			closeDB($link);	
			if ($user->privileges<NOBODY) {
				$mlink=dbConnect(DBMOVIES);
				if (isset($_GET["fileName"])){
					$fileName=$_GET["fileName"];
					$arrResult = array();
					$path=getcwd();
					if(!ini_get('allow_url_fopen')){
						echo "Error: Es necesario activar la directiva allow_url_fopen del php.ini";
						exit;
					}
					
					$handle=fopen($path."/".$fileName,'r');	
					eraseDocsDB($mlink);
					while(($row=fgetcsv($handle,4000,',','"'))!==FALSE){
						insertDoc($mlink,$row);
					}
					fclose($handle);
					echo "Data succesfully inserted";					
				}
				closeDB($mlink);	
				
			}else{
				echo "Error: user or password doesn't match";
			}
		}else{
			echo "Error: user or password doesn't match";
		}									
		?>

</body>
</html>