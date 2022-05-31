<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/departamentos.php");

$departamento = new Departamento();

switch($_GET['op'])
{
	case "listar":
		$datos = $departamento->get_departamento();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_dep'];
			$sub_array[] = $renglon['nombre_dep'];
			$sub_array[] = $renglon['encargado_dep'];
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-info btn-raised" onClick="editarDepartamento('.$renglon['id_dep'].');"><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger btn-raised" onClick="eliminarDepartamento('.$renglon['id_dep'].');"><i class="fas fa-trash-alt"></i></button>
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
		$datos = $departamento->get_departamento_id($_POST["txtIdDep"]);	
		if (empty($_POST["txtIdDep"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$departamento->insertar_departamento(
					$_POST["txtNombreDep"],
					$_POST["txtEncargadoDep"]
				);
			}
		}
		else
		{
			$departamento->update_departamento($_POST["txtIdDep"],
			$_POST["txtNombreDep"],
			$_POST["txtEncargadoDep"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $departamento->get_departamento_id($_POST['id']);
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
		$datos = $departamento->delete_departamento($_POST['id']);
	break;
}


 ?>
 