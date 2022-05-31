<?php

function getConnexion()
{
  $mysqli = new Mysqli('localhost', 'root', '', 'estadias');
  if($mysqli->connect_errno) exit('Error en la conexión: ' . $mysqli->connect_errno);
  $mysqli->set_charset('utf8');
  return $mysqli;
}


if(!isset($_GET['busqueda'])) exit('No se recibió el valor a buscar');


function search()
{
  $mysqli = getConnexion();
  $busqueda = $mysqli->real_escape_string($_GET['busqueda']);

  $query = "SELECT ordencompra.numero_orden AS N_Orden, 
  ordencompra.estatus_orden AS E_Orden,
  productos.id_prod AS id_Producto, 
  productos.nombre_prod AS Producto, 
  detalleorden.cantidad_pedida_det AS Cantidad, 
  detalleorden.estado_det AS Estado, 
  detalleorden.id_unidad_det AS Unidad
  FROM detalleorden
  INNER JOIN ordencompra ON detalleorden.id_orden_det = ordencompra.id_orden
  INNER JOIN productos ON detalleorden.id_prod = productos.id_prod
  WHERE ordencompra.numero_orden ='$busqueda' ";

  $res = $mysqli->query($query);

  for ($i=0; $i <=count($row = $res->fetch_array(MYSQLI_ASSOC)) ; $i++) { 
	echo "
  
	<form id='FormProd$i'>
		<h6>Producto</h6>
		<div class='row'>

			<div class='col-lg-1 form-group' >
				<label for='exampleInputEmail1' class='bmd-label-floating'>Id</label>
				<input type='text' class='form-control' name='txtIdProd'  id='idProd' value='$row[id_Producto]' >
			</div>
			<div class='col-lg-1 form-group' >
				<label for='exampleInputEmail1' class='bmd-label-floating'>Id Orden</label>
				<input type='text' class='form-control' name='txtIdOrden'  id='idProd' value='$row[N_Orden]' >
			</div>
			<div class='col-lg-3 form-group'>
				<label for='exampleInputEmail1' class='bmd-label-floating'>Nombre de Producto</label>
				<input type='text' class='form-control' name=''  id='idProd' value='$row[Producto]' >
			</div>

			<div class='col-lg-1 form-group'>
				<label for='exampleInputEmail1' class='bmd-label-floating'>Cant. Pedida</label>
				<input type='text' class='form-control' name='txt'  id='idProd' value='$row[Cantidad]' >
			</div>

			<div class='col-lg-1 form-group'>
				<label for='exampleInputEmail1' class='bmd-label-floating'>Cantidad</label>
				<input type='text' class='form-control' name='txtCantidad'  id='idProd' value='$row[Cantidad]' disabled>
			</div>
			
			<div class='col-lg-1 form-group'>
				<label for='exampleInputEmail1' class='bmd-label-floating'>Unidad</label>
				<input type='text' class='form-control' name='txtUnidad'  id='idProd' value='$row[Unidad]' disabled>
			</div> 

			<div class='col-lg-2 form-group'>
				<label for='exampleFormControlSelect1'>Estado</label>
				<select class='form-control' id='exampleFormControlSelect1' name='txtEstado' >
					<option DEFAULT>Seleccione una opción</option>
					<option value='Completo'>Completo</option>
					<option value='Incompleto'>Incompleto</option>
				</select>
			</div>

			<div class='col-lg-2 form-group'><br>
			<button type='submit' class='btn btn-info'><i class='fas fa-plus-circle'></i> Añadir al Estock</button>
			</div> 

		</div>
	</form>
	<hr>

";
  }

//   while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
//     echo "
  
// 		<form id='FormProd'>
// 			<div class='row'>

// 				<div class='col-lg-1 form-group' >
// 					<label for='exampleInputEmail1' class='bmd-label-floating'>Id</label>
// 					<input type='text' class='form-control' id='idProd' value='$row[id_Producto]' >
// 				</div>
// 				<div class='col-lg-3 form-group'>
// 					<label for='exampleInputEmail1' class='bmd-label-floating'>Nombre de Producto</label>
// 					<input type='text' class='form-control' id='idProd' value='$row[Producto]' >
// 				</div>

// 				<div class='col-lg-2 form-group'>
// 					<label for='exampleInputEmail1' class='bmd-label-floating'>Cantidad Pedida</label>
// 					<input type='text' class='form-control' id='idProd' value='$row[Cantidad]' >
// 				</div>

// 			<div class='col-lg-2 form-group'>
// 					<label for='exampleInputEmail1' class='bmd-label-floating'>Cantidad</label>
// 					<input type='text' class='form-control' id='idProd' value='$row[Cantidad]' disabled>
// 				</div> 

// 				<div class='col-lg-2 form-group'>
// 					<label for='exampleFormControlSelect1'>Estado</label>
// 					<select class='form-control' id='exampleFormControlSelect1'>
// 						<option DEFAULT>Seleccione una opción</option>
// 						<option value='Completo'>Completo</option>
// 						<option value='Incompleto'>Incompleto</option>
// 					</select>
// 				</div>

// 				<div class='col-lg-2 form-group'><br>
//                 <button id=btnInsertarEnt class=btn btn-info><i class=fas fa-plus-circle></i> Añadir al Estock</button>
// 				</div> 

// 			</div>
// 		</form>
//         <hr>
    
//     ";
//   }
}

search();




?>