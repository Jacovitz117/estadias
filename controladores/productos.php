<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/productos.php");

$producto = new Producto();

switch($_GET['op'])
{
	case "listar":
		$datos = $producto->get_producto();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_prod'];
			$sub_array[] = $renglon['nombre_prod'];
			$sub_array[] = $renglon['stock_minimo_prod'];
			$sub_array[] = $renglon['existencia_prod'];
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-info btn-raised" onClick="editarProducto('.$renglon['id_prod'].');"><i class="fas fa-edit"></i></button>
			<button class="btn btn-danger btn-raised" onClick="eliminarProducto('.$renglon['id_prod'].');"><i class="fas fa-trash-alt"></i></button>
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
		$datos = $producto->get_producto_id($_POST["txtIdProd"]);	
		if (empty($_POST["txtIdProd"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$producto->insertar_producto(
					$_POST["txtNombreProd"],
					$_POST["txtStockMinimoProd"] 
				);
			}
		}
		else
		{
			$producto->update_producto($_POST["txtIdProd"],
			$_POST["txtNombreProd"],
			$_POST["txtStockMinimoProd"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $producto->get_producto_id($_POST['id']);
			echo json_encode($datos[0]);	
	break;

	
	case "eliminar":
		$datos = $producto->delete_producto($_POST['id']);
	break;
}


 ?>
 