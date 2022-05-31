<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/cuentas.php");

$cuenta = new Cuenta();

switch($_GET['op'])
{
	case "listar":
		$datos = $cuenta->get_cuenta();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_cuen'];
			$sub_array[] = $renglon['numero_cuen'];
			$sub_array[] = $renglon['nombre_cuen'];
			$sub_array[] = $renglon['descripcion_cuen'];
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-info btn-raised" onClick="editarCuenta('.$renglon['id_cuen'].');"><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger btn-raised" onClick="eliminarCuenta('.$renglon['id_cuen'].');"><i class="fas fa-trash-alt"></i></button>
			</div>
			';
			// $sub_array[] = '<input type="button" class="btn btn-warning"  onClick="editar('.$renglon['id'].');" value="Editar">';
			$data[]=$sub_array;
		}

		$result = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($result);

		break;


	case "guardaryeditar":
		$datos = $cuenta->get_cuenta_id($_POST["txtIdCuen"]);	
		if (empty($_POST["txtIdCuen"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$cuenta->insertar_cuenta(
					$_POST["txtNumeroCuen"],
					$_POST["txtNombreCuen"],
					$_POST["txtDescripcionCuen"]
					
				);
			}
		}
		else
		{
			$cuenta->update_cuenta($_POST["txtIdCuen"],
			$_POST["txtNumeroCuen"],
			$_POST["txtNombreCuen"],
			$_POST["txtDescripcionCuen"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $cuenta->get_cuenta_id($_POST['id']);
		// if (is_array($datos)==true and count($datos)==0) 
		// {
			// foreach ($datos as $row) 
			// {
			// 	$output["txtIdPerfil"] = $row["id"];
			// 	$output["txtNombre"] = $row["nombre"];
			// 	$output["txtApellido"] = $row["apellidos"];
			// 	$output["txtUsuario"] = $row["usuario"];
			// 	$output["txtContrasena"] = $row["contrasena"];
			// 	$output["txtPrivilegio"] = $row["privilegio"];
			echo json_encode($datos[0]);	
	break;

	
	case "eliminar":
		$datos = $cuenta->delete_cuenta($_POST['id']);
	break;
}


 ?>
 