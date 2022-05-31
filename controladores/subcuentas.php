<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/subcuentas.php");

$obj = new BD_PDO();
$subcuenta = new SubCuenta();

switch($_GET['op'])
{
	case "listar":
		$datos = $subcuenta->get_subcuenta();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_sub'];
			$sub_array[] = $renglon['numero_sub'];
			$sub_array[] = $renglon['nombre_sub'];
			$sub_array[] = $renglon['descripcion_sub'];
			$sub_array[] = $renglon['numero_cuen'].", ".$renglon['nombre_cuen'];
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-info btn-raised" onClick="editarSubCuenta('.$renglon['id_sub'].');"><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger btn-raised" onClick="eliminarSubCuenta('.$renglon['id_sub'].');"><i class="fas fa-trash-alt"></i></button>
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
		$datos = $subcuenta->get_subcuenta_id($_POST["txtIdSubCuen"]);	
		if (empty($_POST["txtIdSubCuen"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$subcuenta->insertar_subcuenta(
					$_POST["txtNumeroSubCuen"],
					$_POST["txtNombreSubCuen"],
					$_POST["txtDescripcionSubCuen"],
					$_POST["txtIdCuenta"]
					
				);
			} 
		}
		else
		{
			$subcuenta->update_subcuenta($_POST["txtIdSubCuen"],
			$_POST["txtNumeroSubCuen"],
			$_POST["txtNombreSubCuen"],
			$_POST["txtDescripcionSubCuen"],
			$_POST["txtIdCuenta"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $subcuenta->get_subcuenta_id($_POST['id']);
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
		$datos = $subcuenta->delete_subcuenta($_POST['id']);
	break;

	case "traer_cuenta":
	
		$E=$obj->Ejecutar_Instruccion("SELECT * FROM cuentas WHERE est=1");
		
		$html="";
		foreach ($E as $value) {
			$html.='
			<option value="'.$value['id_cuen'].'">'.$value['numero_cuen'].", ".$value['nombre_cuen'].'</option>
			';
			
		}
		echo $html;
 
	break;
}


 ?> 
 