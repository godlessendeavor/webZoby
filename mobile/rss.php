<?php
include("db/postdb.php");
$link=dbConnect(DBBLOG);
$postList=seekLastPosts($link,1);
$post=$postList->list[1];
//"Cortaremos" el artículo en 300 caracteres para nuestra descripción
$descripcion=substr($post->text,0,300)."...";
///FEED RSS
header('Content-Type: text/xml'); //Indicamos al navegador que es un documento en XML
//Versión y juego de carácteres de nuestro documento
echo '<?xml version="1.0" encoding="iso-88859-1"?>';
//generamos nuestro documento
echo '<rss version="2.0">
<channel>
    <title>Thrasher Web</title>
    <link>http://www.thrash.zobyhost.com/</link>
    <language>es-CL</language>
    <description>Blog de thrasher</description>
    <generator>Autor del RSS</generator>
    <item>
<title>'.$post->title.'</title>
<link>http://www.thrash.zobyhost.com/blogpage.php?postTitle='.$post->title.'</link>
<pubDate>'.$post->date.'</pubDate>
<category></category>
<guid isPermaLink="true"><![CDATA[http://www.thrash.zobyhost.com]]></guid>
<author><![CDATA[dreaminneon@hotmail.com]]></author
<description><![CDATA['.$descripcion.']]></description>
<content:encoded><![CDATA['.$post->title.']]></content:encoded>
</item></channel></rss>';
?>  [Unregister Version] Left 30 Times, please order it from http://www.regnow.com/softsell/nph-softsell.cgi?item=8539-37