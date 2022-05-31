<?php 

require_once("../conexion_bd.php"); 
require_once("../modelos/ordenes.php");

$obj = new BD_PDO();
$orden = new Orden();

switch($_GET['op'])
{
	case "listar":
		$datos = $orden->get_orden();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_orden'];
			$sub_array[] = $renglon['numero_orden'];
			$sub_array[] = $renglon['numero_req_orden'];
			$sub_array[] = $renglon['nombre_prov'];
			$sub_array[] = $renglon['DEP'].", ".$renglon['ENDEP'];
			$sub_array[] = $renglon['estatus_orden'];
			$sub_array[] = $renglon['observaciones_orden'];
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-success btn-raised" onClick="LlenarDetalleOrden1('.$renglon['id_orden'].');"><i class="fas fa-books-medical"></i></button>
			<button class="btn btn-warning btn-raised" onClick="ListarPED('.$renglon['id_orden'].');"><i class="fas fa-box-check"></i></button>
			<a type="button" href="pdforden?id='.$renglon['id_orden'].'" class="btn btn-info btn-raised" target="_blank" onClick="ImprimirOrden('.$renglon['id_orden'].');"><i class="far fa-file-pdf"></i></a>
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
		$datos = $orden->get_orden_id($_POST["txtIdOr"]);	
		if (empty($_POST["txtIdOr"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$orden->insertar_orden(
					$_POST["txtNumOrdenOr"],
					$_POST["txtNumReqOr"],
					$_POST["txtProvOr"],
					$_POST["txtDepOr"]
				);
			}
		}
		else
		{
			$orden->update_orden($_POST["txtIdOr"],
			$_POST["txtNombreDep"],
			$_POST["txtEncargadoDep"],
			$_POST["txtNombreDep"],
			$_POST["txtEncargadoDep"]
			);
		}
		
	break;

	case "mostrar":
		$datos = $orden->get_orden_id($_POST['id']);
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
		$datos = $orden->delete_orden($_POST['id']);
	break;

	case "insertar_detalle":

		$OrdenCompra = $_POST["txtIdOrDet"];
		$Cuenta = $_POST["txtIdCuenDet"];
		$SubCuenta = $_POST["txtIdSubCuenDet"];
		$Cantidad = $_POST["txtCantDet"];
		$Unidad = $_POST["txtUniDet"];
		$Producto = $_POST["txtProdDet"];
		$PrecioUnitario = $_POST["txtPrecDet"];

		if (isset($_POST["txtIdOrDet"])) 
		{

			$orden->insertar_detalle_orden($OrdenCompra,$Cuenta,$SubCuenta,$Cantidad,$Unidad,$Producto,$PrecioUnitario);
			// for ($i=0; $i < count($Producto); $i++){
			// 	$orden->insertar_detalle_orden($OrdenCompra,$Cuenta,$SubCuenta,$Cantidad,$Unidad,$Producto,$PrecioUnitario);
			// };
		}

	break;


	case "traer_proveedor":
		$E=$obj->Ejecutar_Instruccion("SELECT * FROM proveedores WHERE est=1");
		$html="";
		foreach ($E as $value) {
			$html.='
			<option value="'.$value['id_prov'].'">'.$value['nombre_prov'].", ".$value['empresa_prov'].'</option>
			';
		}
		echo $html;
	break;


	case "traer_departamento":
	
		$E=$obj->Ejecutar_Instruccion("SELECT * FROM departamentos WHERE est=1");
		
		$html="";
		foreach ($E as $value) {
			$html.='
			<option value="'.$value['id_dep'].'">'.$value['nombre_dep'].", ".$value['encargado_dep'].'</option>
			';
			
		}
		echo $html;
 
	break;


	case "traer_orden":
	
		$E=$obj->Ejecutar_Instruccion("SELECT * FROM ordencompra");
		
		$html="";
		foreach ($E as $value) {
			$html.='
			<option value="'.$value['id_orden'].'">'.$value['numero_orden'].", ".$value['numero_req_orden'].'</option>
			';
			
		}
		echo $html;
 
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

		// echo json_encode($E);
 
	break;

	case "traer_subcuenta":
	
		$E=$obj->Ejecutar_Instruccion("SELECT * FROM subcuentas WHERE est=1");
		
		$html="";
		foreach ($E as $value) {
			$html.='
			<option value="'.$value['id_sub'].'">'.$value['numero_sub'].", ".$value['nombre_sub'].'</option>
			';
			
		}
		echo $html;
 
	break;

	case "traer_producto":
	
		$E=$obj->Ejecutar_Instruccion("SELECT * FROM productos WHERE est=1");
		
		$html="";
		foreach ($E as $value) {
			$html.='
			<option value="'.$value['id_prod'].'">'.$value['nombre_prod'].'</option>
			';
			
		}
		echo $html;
 
	break;

	case "traer_unidad":
	
		$E=$obj->Ejecutar_Instruccion("SELECT * FROM unidades WHERE est=1");
		
		$html="";
		foreach ($E as $value) {
			$html.='
			<option value="'.$value['id_unid'].'">'.$value['nombre_unid'].'</option>
			';
			
		}
		echo $html;
 
	break;


	case "listar_PED":
		$datos = $orden->get_ped_id($_GET['id']);	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			$sub_array[] = $renglon['id_det'];
			$sub_array[] = $renglon['numero_orden'];
			$sub_array[] = $renglon['numero_cuen'];
			$sub_array[] = $renglon['numero_sub'];
			$sub_array[] = $renglon['nombre_prod'];
			$sub_array[] = $renglon['nombre_unid'];
			$sub_array[] = $renglon['cantidad_pedida_det'];
			$sub_array[] = $renglon['precio_unitario_det'];
			$sub_array[] = $renglon['estado_det'];
			$sub_array[] = '
			<div class="text-center">   
			<button class="btn btn-warning btn-raised" onClick="eliminarDetalleOrden('.$renglon['id_det'].');"><i class="far fa-minus-square"></i> Quitar</button>
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

		case "eliminar_prod_detalle":
			$datos = $orden->delete_detalle_orden($_POST['id']);
		break;
}


 ?>
 