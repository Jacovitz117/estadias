<?php  
session_start();

$id = $_SESSION['id_usuario'];
require_once 'conexion_bd.php';
$sql = new BD_PDO;
$fotoPerfil = $sql->Ejecutar_Instruccion("SELECT * FROM usuarios WHERE id = '{$id}'");




if(isset($_SESSION['nombre_us']) AND $_SESSION['privilegio_us'] == 'Administrador' OR $_SESSION['privilegio_us'] == 'Finanzas' OR $_SESSION['privilegio_us'] == 'Almacen')
{ 

$accion="inicio";

$inicio="inicio";
$error="error";
$perfiles="perfiles";
$departamentos="departamentos";
$miperfil="miperfil";
$unidades="unidades";
$proveedores="proveedores";
$cuentas="cuentas";
$subcuentas="subcuentas";
$productos="productos";
$ordenes="ordenes";
$pdforden="pdforden";
$entradas="entradas";
$salidas="salidas";


if(isset($_GET['a'])  ){

    if  (($_GET['a']!="") ) {

        $accion=$_GET['a'];

    } 
    if ($_GET['a']!=$productos
    &&$_GET['a']!=$perfiles
    &&$_GET['a']!=$departamentos
    &&$_GET['a']!=$miperfil
    &&$_GET['a']!=$unidades
    &&$_GET['a']!=$proveedores
    &&$_GET['a']!=$cuentas
    &&$_GET['a']!=$subcuentas
    &&$_GET['a']!=$ordenes
    &&$_GET['a']!=$pdforden
    &&$_GET['a']!=$entradas
    &&$_GET['a']!=$salidas
    
    )
    {
        $accion=$error;
    }

}
require_once("vistas/template.php");    
}
else
{ 
    echo'<script type="text/javascript">window.location.href="./";</script>';

}
?>