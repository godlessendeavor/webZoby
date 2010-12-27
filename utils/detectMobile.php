<?php
//Como detectar dispósitivos móviles con PHP
//
//Listado de user-agent(UA) de dispositivos móviles
$dm_usergent = array(
   'iPhone' => 'iPhone',
   'iPod' => 'iPod',
   'iPad' => 'iPad',
   'HTC' => 'HTC',
   'LG' => 'LG',
   'PIE4' => 'compatible; MSIE 4.01; Windows CE; PPC; 240x320',
   'PIE4_Smartphone' => 'compatible; MSIE 4.01; Windows CE; Smartphone;',
   'PIE6' => 'compatible; MSIE 6.0; Windows CE;',
   'Minimo' => 'Minimo',
   'OperaMini' => 'Minimo',
   'AvantGo' => 'AvantGo',
   'Plucker' => 'Plucker',
   'NetFront' => 'NetFront',
   'SonyEricsson' => 'SonyEricsson',
   'Nokia' => 'Nokia',
   'Motorola' => 'mot-',
   'BlackBerry' => 'BlackBerry',
   'WindowsMobile' => 'Windows CE',
   'PPC' => 'PPC',
   'PDA' => 'PDA',
   'Smartphone' => 'Smartphone',
   'Palm' => 'Palm',
   'Samsung' => 'Samsung'
);
function obtenerNavegador($useragents, $useragent){
   foreach($useragents as $nav=>$ua){
      if(stristr($useragent, $ua)!=false){
         return $nav;
      }
   }
   return 'Desconocido';
}
$navegador= obtenerNavegador($dm_usergent,$_SERVER['HTTP_USER_AGENT']);
if($navegador!='Desconocido'){
   header('Location: ../mobile/homepage.php');
}else{
   header('Location: ../homepage.php');
}
?>