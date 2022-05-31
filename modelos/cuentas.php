<?php
require_once("../conexion_bd.php"); 

class Cuenta extends BD_PDO
{
	
	public function get_cuenta()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM cuentas WHERE est=1");
		return $result;
	}

	public function get_cuenta_id($id)
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
}

?>