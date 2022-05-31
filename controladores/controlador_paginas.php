<?php  

$peticion;

$inicio="inicio";
$error="error";
$perfiles="perfiles";
$categorias="categorias";
$departamentos="departamentos";



class ControladorPaginas{
    public function inicio(){
        include_once("vistas/paginas/inicio.php");
    }

    public function error(){
        include_once("vistas/paginas/error.php");
    }

    public function perfiles(){
        include_once ("vistas/perfiles/perfiles.php");
    }

    public function departamentos(){
        include_once ("vistas/departamentos/departamentos.php");
    }

    public function miperfil(){
        include_once ("vistas/usuario/usuario.php");
    }

    public function unidades(){
        include_once ("vistas/unidades/unidades.php");
    }

    public function proveedores(){
        include_once ("vistas/proveedores/proveedores.php");
    }

    public function cuentas(){
        include_once("vistas/cuentas/cuentas.php");
    }

    public function subcuentas(){
        include_once ("vistas/subcuentas/subcuentas.php");
    }

    public function productos(){
        include_once ("vistas/productos/productos.php");
    }

    public function ordenes(){
        include_once ("vistas/ordenes/ordenes.php");
    }
    
    public function pdforden(){
        include_once ("pdforden.php");
    }

    public function entradas(){
        include_once ("vistas/entradas/entradas.php");
    }

    public function salidas(){
        include_once ("vistas/salidas/salidas.php");
    }

}

?>