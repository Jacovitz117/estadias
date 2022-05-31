<?php
require_once("../conexion_bd.php");

class Perfil extends BD_PDO
{
	
	public function get_perfiles()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("SELECT * FROM usuarios WHERE est=1");
		return $result;
	}
 
	public function get_perfil_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("SELECT * FROM usuarios where id='{$id}'");
		return $result;
	}

	public function delete_perfil($id)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE usuarios set est=0, fecha_elim = '{$fecha}' where id = '{$id}'");
		return $result;
	}

	public function insertar_perfil($nom,$ape,$us, $corr,$con,$priv)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("INSERT INTO usuarios (nombre, apellidos, usuario, correo, contrasena, privilegio, est) VALUES ('{$nom}','{$ape}','{$us}','{$corr}','{$con}','{$priv}',1);");
		return $result;
	}

	public function update_perfil($id,$nom,$ape,$us,$corr,$con,$priv)
	{
		$fecha = date('Y-m-d');
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("UPDATE usuarios set nombre='{$nom}', apellidos = '{$ape}', usuario = '{$us}', correo = '{$corr}', contrasena = '{$con}', privilegio = '{$priv}', est=1, fecha_mod = '{$fecha}' WHERE id = '{$id}'");
		return $result;
	}

	public function update_foto_perfil($id,$RutaFoto)
	{
		$fecha = date('Y-m-d');
		$result = parent::Ejecutar_Instruccion("UPDATE usuarios set foto='{$RutaFoto}', est=1, fecha_mod = '{$fecha}' WHERE id = '{$id}'");
		return $result;
	}

	public function eliminar_foto_perfil($id,$RutaFoto)
	{
		$fecha = date('Y-m-d');
		$result = parent::Ejecutar_Instruccion("UPDATE usuarios set foto='{$RutaFoto}', est=1, fecha_mod = '{$fecha}' WHERE id = '{$id}'");
		return $result;
	}
}

?>