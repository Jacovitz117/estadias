<?php 
session_start();
require_once("../modelos/usuarios.php");
require_once("../conexion_bd.php");

$usuarios = new Usuarios();

switch($_GET['op'])
{
	case "iniciosesion":
	$datos = $usuarios->get_iniciar_sesion($_POST['txtusuario'],$_POST['txtcontraseña']);			
	//$datos = $usuarios->get_iniciar_sesion("cpereda@utnc.edu.mx","123");	
	//$datos = $usuarios->get_iniciar_sesion("admin@admin.com","123");
	//$datos = $usuarios->get_iniciar_sesion("admin","admin");		
		if(isset($datos[0]['usuario']))
		{
			$_SESSION['id_usuario'] = $datos[0][0];
			$_SESSION['nombre_us'] = $datos[0]['usuario'];
			$_SESSION['privilegio_us'] = $datos[0]['privilegio'];
			$_SESSION['nombre'] = $datos[0]['nombre']." ".$datos[0]['apellidos'];
			$_SESSION['fotoperfil'] = $datos[0]['foto'];
		}		
		echo json_encode($datos[0]);
		break;
	case "cerrar_sesion":
		session_destroy();
	break;

	
	// case "mostrar":
		
		// $datos = $categoria->get_usuario_id($_GET['id']);
		/*if (count($datos)>0) 
		{
			foreach ($datos as $row) 
			{
				$output["txtid"] = $row["id_categoria"];
				$output["txtnombre"] = $row["Nombre_cat"];
			}
		}*/
		/*echo json_encode($datos[0]);	
		break;
	case "eliminar":	
		$datos = $categoria->delete_categoria($_POST['id']);
	break;*/
}


 ?>
 