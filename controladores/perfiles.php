<?php 

require_once("../conexion_bd.php");
require_once("../modelos/perfiles.php");

$perfil = new Perfil();

switch($_GET['op'])
{
	case "listar":
		$datos = $perfil->get_perfiles();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id'];
			$sub_array[] = $renglon['nombre'];
			$sub_array[] = $renglon['apellidos'];
			$sub_array[] = $renglon['usuario'];
			$sub_array[] = $renglon['correo'];
			$sub_array[] = $renglon['privilegio'];
			$sub_array[] = '<img src='.$renglon['foto'].' width="100">';;
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-info btn-raised" onClick="editarPerfil('.$renglon['id'].');"><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger btn-raised" onClick="eliminarPerfil('.$renglon['id'].');"><i class="fas fa-trash-alt"></i></button>
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
		$datos = $perfil->get_perfil_id($_POST["txtIdPerfil"]);	
		if (empty($_POST["txtIdPerfil"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$perfil->insertar_perfil(
					$_POST["txtNombre"],
					$_POST['txtApellido'],
					$_POST['txtUsuario'],
					$_POST['txtCorreo'],
					$_POST['txtContrasena'],
					$_POST['txtPrivilegio']
				);
			}
		}
		else
		{
			$perfil->update_perfil($_POST["txtIdPerfil"],
			$_POST["txtNombre"],
			$_POST["txtApellido"],
			$_POST["txtUsuario"],
			$_POST['txtCorreo'],
			$_POST["txtContrasena"],
			$_POST["txtPrivilegio"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $perfil->get_perfil_id($_POST['id']);
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
		$datos = $perfil->delete_perfil($_POST['id']);
	break;

	case "actualizarfoto":

		$id = $_POST['txtIdPerfil'];
		$dir_subida = '../assets/images/users/';
		$nombre_archivo = basename($_FILES['txtImagen']['name']);
		$RutaFoto =  $dir_subida . $nombre_archivo;
		$RutaFinal = substr($dir_subida,3,22) . $nombre_archivo;
		move_uploaded_file($_FILES['txtImagen']['tmp_name'],$RutaFoto);
		
		$datos = $perfil->update_foto_perfil($id,$RutaFinal);	
	break;

	case "eliminarfoto":

		$id = $_POST['id'];
		$RutaFinal = 'assets/images/users/avatar-5.jpg';		
		$datos = $perfil->update_foto_perfil($id,$RutaFinal);	
	break;
}


 ?>
 