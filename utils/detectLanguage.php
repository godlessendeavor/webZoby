<?php
/* Este código detecta el idioma por defecto del visitante.
Sin embargo, si el visitante indica un idioma mediante la URL (siguiendo un enlace) toma preferencia */
session_start();
// Miramos si el usuario ha definido un idioma por defecto en su navegador
if ($HTTP_ACCEPT_LANGUAGE != ''){
 // Si es así, miramos que idiomas ha definido:
    $idiomas = explode(",", $HTTP_ACCEPT_LANGUAGE); # Convertimos HTTP_ACCEPT_LANGUAGE en array
   
 /* Recorremos el array hasta que encontramos un idioma del visitante que coincida con los idiomas en que está disponible nuestra web */
    for ($i=0; $i<count($idiomas); $i++){
  // Si aún no hemos definido la variable $idioma...
        if (!isset($_GET["idioma"])){
   /* Miramos si tiene algún idioma de los disponibles entre sus favoritos.
   Empezando por su primer favorito y acabando por su último favorito */
            if (substr($idiomas[$i], 0, 2) == "es"){$_SESSION["idioma"] = "es";}
            if (substr($idiomas[$i], 0, 2) == "en"){$_SESSION["idioma"] = "en";}
            if (substr($idiomas[$i], 0, 2) == "gl"){$_SESSION["idioma"] = "gl";}
        }
    }
}
?>