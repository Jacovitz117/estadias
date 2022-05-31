<?php
require_once("../conexion_bd.php"); 

class Producto extends BD_PDO
{
	
	public function get_producto()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM productos WHERE est=1");
		return $result;
	}

	public function get_producto_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT * FROM productos where id_prod='{$id}'");
		return $result;
	}

	public function delete_producto($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE productos set est=0, fecha_elim = '{$fecha}' where id_prod = '{$id}'");
		return $result;
	}

	public function insertar_producto($nom,$stmn)
	{
		$date = date('Y-m-d');

		$result = parent::Ejecutar_Instruccion("INSERT INTO productos (nombre_prod, stock_minimo_prod, est, fecha_crea) VALUES ('{$nom}','{$stmn}',1,'{$date}');");
		return $result;
	}

	public function update_producto($id,$nom,$stmn)
	{
		$date = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE productos set nombre_prod='{$nom}', stock_minimo_prod='{$stmn}', est=1, fecha_mod='{$date}' WHERE id_prod = '{$id}'");
		return $result;
	}
}

?>