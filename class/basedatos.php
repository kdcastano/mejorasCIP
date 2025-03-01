<?php
abstract class basedatos{
	
	private $BaseDatos = "BD_CIPMejoras";		
	private $Servidor = "localhost";		
	private $Usuario = "User_BDCIPMejoras";	
	private $Clave = '8Y^;vK2QW{CiD1R-yl';
	
	protected $Conexion_ID; //identificador de conexión
	protected $Consulta_ID; //identificador de consulta
	private $Consulta_SQL; //SQL enviado
	protected $ResultadoCon; //registro de la consulta

	protected $ErrNo;  //numero de error
	protected $ErrTxt; //texto de error
	
	protected $tabla = ""; //tabla actual
	
	
	//funciones básicas
	abstract protected function consultar();
	abstract protected function insertar();
	abstract protected function actualizar();
	abstract protected function eliminar();
	
	//conecta a la base de datos
	private function conectar(){
		$this->limpiarerror();
		try{
			$this->Conexion_ID = new PDO('mysql:host='.$this->Servidor.';dbname='.$this->BaseDatos, $this->Usuario, $this->Clave, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'", PDO::MYSQL_ATTR_LOCAL_INFILE => true));
		}catch(PDOException $e){
			$this->ErrNo = -1;
			$this->ErrTxt = $e->getMessage();
		}
	}
	
	//desconecta la base de datos
	protected function desconectar(){
		$this->Conexion_ID = NULL;
	}
	
	/* prepara el sql enviado
	   valida los errores retorna true si es correcta, retorna false en caso de error, el error es guardado en
	   los campos ErrNo y ErrTxt
	   
	   sql->script sql a ejecutar
	*/
	private function prepararSQL($sql){
		$this->Consulta_SQL = $sql;
		$this->conectar();
		if($this->validarerror() && $this->Conexion_ID){
			try{
				$this->Consulta_ID = $this->Conexion_ID->prepare($this->Consulta_SQL);
				return true;
			}catch(PDOException $e){
				$this->ErrNo = -1;
				$this->ErrTxt = $e->getMessage();
				$this->desconectar();
				return false;
			}
		}
		$this->desconectar();
		return false;
	}
	
	/* ejecuta el sql
	   valida los errores retorna true si es correcta, retorna false en caso de error
	   
	   parametros->Arreglo con los parametros enviados a el SQL
	*/
	private function ejecutarSQL($parametros){
		if($this->Conexion_ID && $this->validarerror()){
			try{
				if($parametros){
					$this->Consulta_ID->execute($parametros);
				}else{
					$this->Consulta_ID->execute();
				}
				$errores = $this->Consulta_ID->errorInfo();
				$this->ErrNo = $errores[0];
				$this->ErrTxt = $errores[2];

				return $this->validarerror();
			}catch(PDOException $e){
				$this->ErrTxt = $e->getMessage();
				return false;
			}
		}
		return false;
	}
	
	/* carga una matriz con el resultado completo de una consulta
	   valida los errores retorna la matriz de resultados si es correcta, retorna false en caso de error
	*/
	protected function cargarTodo(){
		if($this->validarerror()){
			$this->ResultadoCon = $this->Consulta_ID->fetchAll();
		}else{
			$this->ResultadoCon = false;
		}
		$this->desconectar();
		return($this->ResultadoCon);
	}
	
	/* carga una matriz con el registro actual de la consulta
	   valida los errores retorna el registro si es correcta, retorna false en caso de error
	*/
	protected function cargarRegistro(){
		if($this->validarerror()){
			$this->ResultadoCon = $this->Consulta_ID->fetch(PDO::FETCH_BOTH);
		}else{
			$this->ResultadoCon = false;
		}
		return($this->ResultadoCon);
	}

	/* ejecuta un sql con una consulta preparada
	   valida los errores retorna true si es correcta, retorna false en caso de error
	   
	   sql->string con el script sql
	   parametros->arreglo con los parametros que se envian a la consulta, si no hay parametros se envia un NULL
	*/
	protected function consultaSQL($sql, $parametros = NULL){
		if(!$this->Conexion_ID){
			if($this->prepararSQL($sql)){
				return $this->ejecutarSQL($parametros);
			}
			$this->desconectar();
			return false;
		}
		$this->desconectar();
		return false;
	}
	
	/* lista todos los elementos de una tabla
		devuelve  un arreglo con el resultado
	*/
	public function listarTodos(){
		$sql = sprintf("SELECT * FROM %s ", $this->tabla);
		$this->consultaSQL($sql);
		return $this->cargarTodo();
	}


	/* inserta uno o varios registros. Retorna:
	   un array con el resultado de cada inserción
	   un false en caso de error
	   
	   campos-> arreglo con los campos que se deben cargar
	   valores-> matriz con los valores para cada campo (deben coincidir con los campos)
	   tabla->String con la tabla a la que se va a insertar
	*/
	public function insertarRegistros($campos, $valores){
		$lerror = array();
		$i = 0;
		$parametros = "";
		$lcampos = "";
		
		foreach($campos as $x){
			$lcampos .= sprintf("%s, ", $x);
			$parametros .= sprintf(":campo%s, ", $i);
			$i++;
		}
		
		//elimino la coma al final
		$lcampos = substr($lcampos, 0, -2);
		$parametros = substr($parametros, 0, -2);
		
		//genero el sql
		$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->tabla, $lcampos, $parametros);
		
		if($this->prepararSQL($sql)){
			$cont = 0;
			for($i=0; $i<count($valores); $i++){
				$this->limpiarerror();
				if(count($campos) != count($valores[$i])){
					$lerror[$i] = "Los campos no coinciden con los valores";
				}else{
					$lvalores = array();
					for($j=0; $j<count($valores[$i]); $j++){
						$lvalores["campo".$j] = $valores[$i][$j];
					}
					if($this->ejecutarSQL($lvalores)){
						$lerror[$i] = "OK";						
					}else{
						$lerror[$i] = $this->imprimirError();
					}
					$lvalores = NULL;
				}
			}
			$this->desconectar();
			return $lerror;
		}else{
			$this->desconectar();
			return false;
		}		
	}
	
	/* actualiza registros. Retorna:
	   false si no realiza la actualización
	   true si realiza la actualización
	   
	   campos-> arreglo con los campos que se van a actualizar
	   valores-> arreglo con los nuevos valores para cada campo (deben coincidir con los campos)
	   llaveprimaria-> nombre del campo de llave principal
	   valorllaveprimaria-> valor del campo de llave principal
	*/
	public function actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria){
		$i = 0;
		$act = "";
		
		foreach($campos as $x){
			$act .= sprintf("%s = :campo%s, ", $x, $i);
			$i++;
		}
		//elimino la coma
		$act = substr($act, 0, -2);
		
		$i=0;
		$cond = sprintf("%s = :campocon ", $llaveprimaria);
		
		//genero el sql
		$sql = sprintf("UPDATE %s SET %s WHERE %s", $this->tabla, $act, $cond);
		
		if($this->prepararSQL($sql)){
			if(count($campos) != count($valores)){
				$this->ErrTxt = "Los campos no coinciden con los valores";
				$this->ErrNo = "XXXX";
				return false;
			}
			for($i=0; $i<count($valores); $i++){
				$lvalores["campo".$i] = $valores[$i];
			}
			$lvalores["campocon"] = $valorllaveprimaria;
			
			if(!$this->ejecutarSQL($lvalores)){
				return false;
			}
		}else{
			return false;
		}
		return true;
	}
	
	/*
	Devuelve un string con el error guardado en caso de que exista
	*/		
	public function imprimirError(){
		return sprintf("Error: %s - %s", $this->ErrNo, $this->ErrTxt);
	}
	
	/*
	Valida si existe un error al momento de realizar una acción
	*/
	private function validarerror(){
		$estado = true;
		if($this->ErrNo != '00000' && $this->ErrNo != '' && $this->ErrTxt != '00000' && $this->ErrTxt != ''){
			$estado = false;
		}
		return $estado;
	}
	
	/*
	Limpia las variables de error
	*/
	private function limpiarerror(){
		$this->ErrNo = "";
		$this->ErrTxt = "";
	}
	
	public function imprimirsql(){
		return $this->Consulta_SQL;
	}
}
?>