<?php
require_once("../conexion_bd.php"); 

class Departamento extends BD_PDO
{
	
	public function get_departamento()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM departamentos WHERE est=1");
		return $result;
	}

	public function get_departamento_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT * FROM departamentos where id_dep='{$id}'");
		return $result;
	}

	public function delete_departamento($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE departamentos set est=0, fecha_elim = '{$fecha}' where id_dep = '{$id}'");
		return $result;
	}

	public function insertar_departamento($nom,$enc)
	{
		$date = date('Y-m-d');

		$result = parent::Ejecutar_Instruccion("INSERT INTO departamentos (nombre_dep, encargado_dep, fecha_crea, est) VALUES ('{$nom}','{$enc}','{$date}',1);");
		return $result;
	}

	public function update_departamento($id,$nom,$enc)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE departamentos set nombre_dep='{$nom}', encargado_dep='{$enc}', est=1, fecha_mod='{$date}' WHERE id_dep = '{$id}'");
		return $result;
	}
}

?>