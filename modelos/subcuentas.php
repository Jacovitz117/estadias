<?php
require_once("../conexion_bd.php"); 

class SubCuenta extends BD_PDO
{
	
	public function get_subcuenta()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT id_sub,numero_sub,nombre_sub,descripcion_sub,numero_cuen,nombre_cuen FROM subcuentas INNER JOIN cuentas ON subcuentas.id_cuenta=cuentas.id_cuen WHERE subcuentas.est=1");
		return $result; 
	}

	public function get_subcuenta_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT * FROM subcuentas where id_sub ='{$id}'");
		return $result;
	}

	public function delete_subcuenta($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE subcuentas set est=0, fecha_elim = '{$fecha}' where id_sub = '{$id}'");
		return $result;
	}

	public function insertar_subcuenta($num,$nom,$desc,$cuen)
	{
		$date = date('Y-m-d');

		$result = parent::Ejecutar_Instruccion("INSERT INTO subcuentas (numero_sub, nombre_sub, descripcion_sub, id_cuenta, fecha_crea, est) VALUES ('{$num}','{$nom}','{$desc}','{$cuen}','{$date}',1);");
		return $result;
	}

	public function update_subcuenta($id,$num,$nom,$desc,$cuen)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE subcuentas set numero_sub='{$num}', nombre_sub='{$nom}', descripcion_sub='{$desc}', id_cuenta='{$cuen}',est=1, fecha_mod='{$date}' WHERE id_sub = '{$id}'");
		return $result;
	}
}

?>