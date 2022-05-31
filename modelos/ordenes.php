<?php
require_once("../conexion_bd.php"); 

class Orden extends BD_PDO
{
	
	public function get_orden()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT
		id_orden, 
		numero_orden, 
		numero_req_orden, 
		proveedores.nombre_prov, 
		departamentos.nombre_dep AS DEP, 
		departamentos.encargado_dep AS ENDEP, 
		estatus_orden, 
		observaciones_orden 
		FROM ordencompra
		INNER JOIN proveedores ON ordencompra.id_prov_orden = proveedores.id_prov
		INNER JOIN departamentos ON ordencompra.id_dep_orden = departamentos.id_dep");
		return $result;
	}

	public function get_orden_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT
		id_orden, 
		numero_orden, 
		numero_req_orden, 
		proveedores.nombre_prov, 
		departamentos.nombre_dep AS DEP, 
		departamentos.encargado_dep AS ENDEP, 
		estatus_orden, 
		observaciones_orden 
		FROM ordencompra
		INNER JOIN proveedores ON ordencompra.id_prov_orden = proveedores.id_prov
		INNER JOIN departamentos ON ordencompra.id_dep_orden = departamentos.id_dep 
		where id_orden='{$id}'");
		return $result;
	}

	public function delete_orden($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE ordencompra set est=0, fecha_elim = '{$fecha}' where id_orden = '{$id}'");
		return $result;
	}

	public function insertar_orden($nor,$nre,$prov,$dep)
	{
		$date = date('Y-m-d');

		$result = parent::Ejecutar_Instruccion("INSERT INTO ordencompra (numero_orden,numero_req_orden,id_prov_orden,id_dep_orden,fecha_crea) VALUES ('{$nor}','{$nre}','{$prov}','{$dep}','{$date}');");
		return $result;
	}

	public function update_orden($id,$nom,$enc)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE ordencompra set nombre_dep='{$nom}', encargado_dep='{$enc}', est=1, fecha_mod='{$date}' WHERE id_orden = '{$id}'");
		return $result;
	}

	public function insertar_detalle_orden($ord,$cuen,$scu,$can,$uni,$pro,$puni)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("INSERT INTO detalleorden (id_orden_det,id_cuenta_det,id_subcuenta_det,cantidad_pedida_det,id_unidad_det,id_prod,precio_unitario_det) 
		VALUES ('{$ord}','{$cuen}','{$scu}','{$can}','{$uni}','{$pro}','{$puni}')");
		return $result;
	}

	public function delete_detalle_orden($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("DELETE FROM detalleorden WHERE id_det = '{$id}'");
		return $result;
	}

	public function get_ped_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT id_det, id_orden_det, ordencompra.numero_orden, 
		cuentas.numero_cuen, subcuentas.numero_sub, productos.nombre_prod, unidades.nombre_unid, 
		cantidad_pedida_det, precio_unitario_det, estado_det 
		FROM detalleorden 
		INNER JOIN ordencompra ON detalleorden.id_orden_det = ordencompra.id_orden 
		INNER JOIN cuentas ON detalleorden.id_cuenta_det = cuentas.id_cuen 
		INNER JOIN subcuentas ON detalleorden.id_subcuenta_det = subcuentas.id_sub 
		INNER JOIN unidades ON detalleorden.id_unidad_det = unidades.id_unid 
		INNER JOIN productos ON detalleorden.id_prod = productos.id_prod 
		WHERE id_orden_det='{$id}'");
		return $result;
	}
}

?>