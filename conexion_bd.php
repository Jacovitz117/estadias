<?php 


class BD_PDO{

	public $tot_reg;
	public $ultimo_id;

	public function getConection ()	
	{
			try {
				   $opcionesPDO[PDO::ATTR_ERRMODE]= PDO::ERRMODE_EXCEPTION;
			       $conexion = new PDO('mysql:host=localhost;dbname=estadias','root','', $opcionesPDO);
		           }
		        catch(PDOException $e){
	                          echo "Failed to get DB handle: " . $e->getMessage();
	                           exit;    
	                                    }
	        return $conexion;
	}	

	public function Ejecutar_Instruccion($consulta_sql)
	{
		# code...
		$conexion = $this->getConection();
        $rows = array();
        
		$query=$conexion->prepare($consulta_sql);
		if(!$query)
		{
         	return "Error al mostrar";
        }
		else
		{			
        	$query->execute();   
           	$this->tot_reg = $query->rowCount();   
           	$this->ultimo_id = $conexion->lastInsertId();   	
        	while ($result = $query->fetch())
			{
            	$rows[] = $result;
          	}			
            return $rows;
        }
	}

	public function Ejecutar_Instruccion_cp($consulta_sql, $parametros)
	{
		# code...
		$conexion = $this->getConection();
        $rows = array();        
		$query=$conexion->prepare($consulta_sql);
		if(!$query)
		{
         	return "Error al mostrar";
        }
		else
		{			
        	$query->execute($parametros);   
           	$this->tot_reg = $query->rowCount();     	
        	while ($result = $query->fetch())
			{
            	$rows[] = $result;
          	}			
            return $rows;
        }
	}

	public function Tot_registros()
	{
		return $this->tot_reg;
	}

	public function get_ultimo_id()
	{
		return $this->ultimo_id;
	}

public function Llenar_Combo($tabla_foranea,$id_foraneo, $campo_foraneo,$tabla_combo,$campo_id_primario)
	{
		$conexion = $this->getConection();		
		$query=$conexion->prepare("SELECT * FROM ".$tabla_foranea."
		 WHERE ".$campo_foraneo."=:id");
        $query->bindParam(':id',$id_foraneo);
        if(!$query)
		{
             return "Error al mostrar";
        }
		else
		{
			$query->execute();			
			$foranea = $query->fetch();		
		}			
		$query2=$conexion->prepare("SELECT * FROM ".$tabla_combo);
		$query2->execute();	
		while ($result = $query2->fetch())
		{
			if($foranea[$campo_id_primario]==$result[$campo_id_primario])
				$select = "selected";
			else
				$select = "";
			$cadena = $cadena.'<option value="'.$result[0].'" '.$select.'>'.$result[1].'</option>';	   
		}	
		return $cadena;		
	}
	
	public function Llenar_Combo2($tabla_combo,$llave_primaria, $campo_visualizar)
	{
		$cadena="";
		$conexion = $this->getConection();		
		$query=$conexion->prepare("SELECT * FROM ".$tabla_combo );
		$query->execute();	
		while ($result = $query->fetch())
		{
			$cadena = $cadena.'<option value="'.$result[$llave_primaria].
			'">'.$result[$campo_visualizar].'</option>';	   
		}	
		return $cadena;				
	}

	public function Llenar_Combo3($tabla_combo,$llave_primaria, $campo_visualizar, $estado)
	{
		$cadena="";
		$conexion = $this->getConection();		
		$query=$conexion->prepare("SELECT * FROM ".$tabla_combo." WHERE estado='{$estado}'" );
		$query->execute();	
		while ($result = $query->fetch())
		{
			$cadena = $cadena.'<option value="'.$result[$llave_primaria].
			'">'.$result[$campo_visualizar].'</option>';	   
		}	
		return $cadena;				
	}


}
?>