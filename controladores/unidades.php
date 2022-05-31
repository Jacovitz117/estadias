<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/unidades.php");

$unidad = new Unidad();

switch($_GET['op'])
{
	case "listar":
		$datos = $unidad->get_unidad();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_unid'];
			$sub_array[] = $renglon['nombre_unid'];
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-info btn-raised" onClick="editarUnidad('.$renglon['id_unid'].');"><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger btn-raised" onClick="eliminarUnidad('.$renglon['id_unid'].');"><i class="fas fa-trash-alt"></i></button>
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
		$datos = $unidad->get_unidad_id($_POST["txtIdUnid"]);	
		if (empty($_POST["txtIdUnid"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$unidad->insertar_unidad(
					$_POST["txtNombreUnid"]
				);
			}
		}
		else
		{
			$unidad->update_unidad($_POST["txtIdUnid"],
			$_POST["txtNombreUnid"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $unidad->get_unidad_id($_POST['id']);
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
		$datos = $unidad->delete_unidad($_POST['id']);
	break;
}


 ?>
 