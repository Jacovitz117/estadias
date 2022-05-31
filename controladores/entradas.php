<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/entradas.php");

$obj = new BD_PDO;
$entrada = new Entrada();

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
		$datos = $entrada->get_entrada_id($_POST['id']);

			echo json_encode($datos[0]);	
	break;

	case "datos_entrada":
		$datos = $entrada->get_datos_entrada($_POST['id']);

		echo json_encode($datos);	
	break;

	
	case "eliminar":
		$datos = $departamento->delete_departamento($_POST['id']);
	break;

	case "buscar_orden":
		$id = $_GET['id'];
		$idOrden = $entrada->get_id_Orden($id);
		echo json_encode($idOrden[0]);
	break;

	case "crear_entrada":


		$idOrden = $_POST['id'];
		$busqueda = $entrada->Ejecutar_Instruccion("SELECT id_ent FROM entradas WHERE id_orden_ent = '{$idOrden}'");


		if (empty($busqueda)) 
		{
			$fecha = date('Y-m-d');
			$datos = $entrada->Ejecutar_Instruccion("INSERT INTO entradas (id_orden_ent, fecha_crea) VALUES ('{$idOrden}','$fecha')");
			$bEnt = $entrada->Ejecutar_Instruccion("SELECT id_ent FROM entradas ORDER BY id_ent DESC LIMIT 1");

			echo json_encode($bEnt);
		}
		else
		{
			echo json_encode($busqueda[0]);
		}

	break;

	case "insertar_stock":

		$prod = $_POST['txtIdProd'];
		$cant = $_POST['txtCant'];
		$est  = $_POST['txtEstado'];
		$idOrden = $_POST['txtIdOrden'];
		$unidad = $_POST['txtUnidad'];
		$Entrada = $_POST['txtEntrada'];
		$fecha = date('Y-m-d');

		// $idEntrada = intval($Entrada);

		// $idOrden = $_GET['idO'];

		$busqueda = $entrada->Ejecutar_Instruccion("SELECT id_ent FROM entradas WHERE id_orden_ent = '{$idOrden}'");
		$IDO = intval($busqueda);


		if ($IDO <> 0){


			$detalleEntrada = $entrada->Ejecutar_Instruccion("INSERT INTO detalleentrada (id_entrada_dent, id_producto_dent, cantidad_dent, id_unidad_dent) 
			VALUES ('{$IDO}','{$prod}','{$cant}','$unidad')");		
		}
		else{
			$datos = $entrada->Ejecutar_Instruccion("INSERT INTO entradas (id_orden_ent, fecha_crea) VALUES ('{$idOrden}','$fecha')");
			$bEnt = $entrada->Ejecutar_Instruccion("SELECT id_ent FROM entradas ORDER BY id_ent DESC LIMIT 1"); $idEnt = intval($bEnt);
			$detalleEntrada = $entrada->Ejecutar_Instruccion("INSERT INTO detalleentrada (id_entrada_dent, id_producto_dent, cantidad_dent, id_unidad_dent) 
			VALUES ('{$idEnt}','{$prod}','{$cant}','$unidad')");		
		}

		// $fecha = date('Y-m-d');
		// $datos = $entrada->Ejecutar_Instruccion("INSERT INTO entradas (id_orden_ent, fecha_crea) VALUES ('{$idOrden}','$fecha')");

		// $bEnt = $entrada->Ejecutar_Instruccion("SELECT id_ent FROM entradas ORDER BY id_ent DESC LIMIT 1");


		// $comentarios = $entrada->Ejecutar_Instruccion("UPDATE detalleorden SET estado_det = '{$est}' WHERE id_orden_det = '{$idOrden}'");
		
	break;


}


 ?>
 