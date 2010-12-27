<?php
// Función que elimina caracteres extraños que me pueden molestar en las cadenas que meto en los item de los RSS
function clrAll($str) {
   $str=str_replace("&","&amp;",$str);
   $str=str_replace("\"","&quot;",$str);
   $str=str_replace("'","&#39",$str);
   $str=str_replace(">","&gt;",$str);
   $str=str_replace("<","&lt;",$str);
   return $str;
}
include("db/postdb.php");
$link=dbConnect(DBBLOG);
$nposts=5; //number of posts to show on feed
$postList=seekLastPosts($link,$nposts);

///FEED RSS
header('Content-Type: text/xml'); //Indicamos al navegador que es un documento en XML
//Versión y juego de carácteres de nuestro documento
echo '<?xml version="1.0" encoding="iso-88859-1"?>';
//generamos nuestro documento
echo '<rss version="2.0">
<channel>
	<title>Thrasher Web</title>
    <link>http://thrash.zobyhost.com/</link>
    <language>es-CL</language>
    <description>Blog de José Luis Villar Bardanca</description>
    <generator>Autor del RSS</generator>';
for ($i=1;$i<=$nposts;$i++) {
	$post=$postList->list[$i];
	//"Cortamos" el artículo en 300 caracteres para la descripción
	$descripcion=substr($post->text,0,300)."...";
	$title=clrAll($post->title);         
    $descripcion=clrAll($descripcion);
	echo'<item>
		<title>'.$title.'</title>
		<link>http://thrash.zobyhost.com/blogpage.php?postTitle='.$title.'</link>
		<pubDate>'.$post->date.'</pubDate>
		<category></category>
		<guid isPermaLink="true"><![CDATA[http://thrash.zobyhost.com]]></guid>
		<author><![CDATA[dreaminneon@hotmail.com]]></author
		<description><![CDATA['.$descripcion.']]></description>
		<content:encoded><![CDATA['.$title.']]></content:encoded>
	</item>';
}
echo'</channel></rss>';
?>