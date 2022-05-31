<?php
//session_start();

require_once("../conexion_bd.php");

class Usuarios extends BD_PDO
{
	public function get_iniciar_sesion($usuario,$contrasena)
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM usuarios WHERE usuario='{$usuario}' and contrasena='{$contrasena}'");
		return $result;
	}

	/*public function get_categoria_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("Select * from categorias where id_categoria = '{$id}'");
		return $result;
	}

	public function delete_categoria($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("Update categorias set estatus=0 where id_categoria = '{$id}'");
		return $result;
	}

	public function insert_categoria($nom)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("INSERT INTO categorias (Nombre_cat, Estatus) VALUES ('{$nom}', '1');");
		return $result;
	}

	public function update_categoria($id, $nom)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("Update categorias set Nombre_cat='{$nom}' where id_categoria = '{$id}'");
		return $result;
	}*/
}

?>