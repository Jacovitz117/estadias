<?php  
// require_once("controladores/controlador_".$controlador.".php");
// $objControlador="Controlador".ucfirst($controlador);

//     $controlador= new $objControlador();
//     $controlador->$accion();

?>

<?php  
require_once("controladores/controlador_paginas.php");
$objControlador="ControladorPaginas";

    $controlador= new $objControlador();
    $controlador->$accion();

?>
