<?php
require_once("../conexion_bd.php"); 

class Unidad extends BD_PDO
{
	
	public function get_unidad()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM unidades WHERE est=1");
		return $result;
	}

	public function get_unidad_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT * FROM unidades where id_unid ='{$id}'");
		return $result;
	}

	public function delete_unidad($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE unidades set est=0, fecha_elim = '{$fecha}' where id_unid = '{$id}'");
		return $result;
	}

	public function insertar_unidad($nom)
	{
		$date = date('Y-m-d');

		$result = parent::Ejecutar_Instruccion("INSERT INTO unidades (nombre_unid, fecha_crea, est) VALUES ('{$nom}','{$date}',1);");
		return $result;
	}

	public function update_unidad($id,$nom)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE unidades set nombre_unid='{$nom}', est=1, fecha_mod='{$date}' WHERE id_unid = '{$id}'");
		return $result;
	}
}

?>