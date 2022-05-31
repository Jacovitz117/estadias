<?php
require_once("../conexion_bd.php"); 

class Entrada extends BD_PDO
{
	
	public function get_entrada()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM cuentas WHERE est=1");
		return $result;
	}

	public function get_entrada_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT * FROM cuentas where id_cuen ='{$id}'");
		return $result;
	}

	public function delete_cuenta($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE cuentas set est=0, fecha_elim = '{$fecha}' where id_cuen = '{$id}'");
		return $result;
	}

	public function insertar_cuenta($num,$nom,$desc)
	{
		$date = date('Y-m-d');

		$result = parent::Ejecutar_Instruccion("INSERT INTO cuentas (numero_cuen, nombre_cuen, descripcion_cuen, fecha_crea, est) VALUES ('{$num}','{$nom}','{$desc}','{$date}',1);");
		return $result;
	}

	public function update_cuenta($id,$num,$nom,$desc)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE cuentas set numero_cuen='{$num}', nombre_cuen='{$nom}', descripcion_cuen='{$desc}',est=1, fecha_mod='{$date}' WHERE id_cuen = '{$id}'");
		return $result;
	}

	public function get_id_Orden($id)
	{
		$result = parent::Ejecutar_Instruccion("SELECT id_orden from ordencompra WHERE numero_orden = '{$id}' ");
		return $result;
	}

	public function get_datos_entrada($id)
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT ordencompra.id_orden AS Id_Orden,
		ordencompra.numero_orden AS N_Orden, 
		ordencompra.estatus_orden AS E_Orden,
		productos.id_prod AS id_Producto, 
		productos.nombre_prod AS Producto, 
		detalleorden.cantidad_pedida_det AS Cantidad, 
		detalleorden.estado_det AS Estado, 
		unidades.nombre_unid AS Unidad,
		unidades.id_unid AS id_unidad
		FROM detalleorden
		INNER JOIN ordencompra ON detalleorden.id_orden_det = ordencompra.id_orden
		INNER JOIN productos ON detalleorden.id_prod = productos.id_prod
		INNER JOIN unidades ON detalleorden.id_unidad_det = unidades.id_unid
		WHERE ordencompra.numero_orden = '{$id}' 
		AND detalleorden.estado_det = 'Pendiente' 
		OR detalleorden.estado_det = 'Incompleto'");
		
		return $result; 
	}

	
}

?>