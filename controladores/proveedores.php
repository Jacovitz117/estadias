<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/proveedores.php");

$proveedor = new Proveedor();

switch($_GET['op'])
{
	case "listar":
		$datos = $proveedor->get_proveedor();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_prov'];
			$sub_array[] = $renglon['nombre_prov'];
			$sub_array[] = $renglon['empresa_prov'];
			$sub_array[] = $renglon['correo_prov'];
			$sub_array[] = $renglon['telefono_prov'];
			$sub_array[] = $renglon['direccion_prov'];
			$sub_array[] = $renglon['iva_prov']." %";
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-info btn-raised" onClick="editarProveedor('.$renglon['id_prov'].');"><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger btn-raised" onClick="eliminarProveedor('.$renglon['id_prov'].');"><i class="fas fa-trash-alt"></i></button>
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
		$datos = $proveedor->get_proveedor_id($_POST["txtIdProv"]);	
		if (empty($_POST["txtIdProv"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$proveedor->insertar_proveedor(
					$_POST["txtNombreProv"],
					$_POST["txtEmpresaProv"],
					$_POST["txtCorreoProv"],
					$_POST["txtTelefonoProv"],
					$_POST["txtDireccionProv"],
					$_POST["txtIvaProv"]
				);
			}
		}
		else
		{
			$proveedor->update_proveedor($_POST["txtIdProv"],
			$_POST["txtNombreProv"],
			$_POST["txtEmpresaProv"],
			$_POST["txtCorreoProv"],
			$_POST["txtTelefonoProv"],
			$_POST["txtDireccionProv"],
			$_POST["txtIvaProv"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $proveedor->get_proveedor_id($_POST['id']);
			echo json_encode($datos[0]);	
	break;

	
	case "eliminar":
		$datos = $proveedor->delete_proveedor($_POST['id']);
	break;
}


 ?>
 