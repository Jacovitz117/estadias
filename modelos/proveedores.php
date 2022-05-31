<?php
require_once("../conexion_bd.php"); 

class Proveedor extends BD_PDO
{
	
	public function get_proveedor()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM proveedores WHERE est=1");
		return $result;
	}

	public function get_proveedor_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT * FROM proveedores where id_prov ='{$id}'");
		return $result;
	}

	public function delete_proveedor($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE proveedores set est=0, fecha_elim = '{$fecha}' where id_prov = '{$id}'");
		return $result;
	}

	public function insertar_proveedor($nom,$emp,$corr,$tel,$dir,$iva)
	{
		$date = date('Y-m-d');

		$result = parent::Ejecutar_Instruccion("INSERT INTO proveedores (nombre_prov, empresa_prov, correo_prov, telefono_prov, direccion_prov, iva_prov, est, fecha_crea) VALUES ('{$nom}','{$emp}','{$corr}','{$tel}','{$dir}','{$iva}',1,'{$date}');");
		return $result;
	}

	public function update_proveedor($id,$nom,$emp,$corr,$tel,$dir,$iva)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE proveedores set nombre_prov='{$nom}', empresa_prov='{$emp}', correo_prov='{$corr}', telefono_prov='{$tel}', direccion_prov='{$dir}', iva_prov='{$iva}', est=1, fecha_mod='{$date}' WHERE id_prov = '{$id}'");
		return $result;
	}
}

?>