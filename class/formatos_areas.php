<?php
require_once('basedatos.php');

  class formatos_areas extends basedatos {
    private $ForA_Codigo;
    private $Are_Codigo;
    private $For_Codigo;
    private $ForA_UsuarioCrea;
    private $ForA_FechaHoraCrea;
    private $ForA_Estado;

  function __construct($ForA_Codigo = NULL, $Are_Codigo = NULL, $For_Codigo = NULL, $ForA_UsuarioCrea = NULL, $ForA_FechaHoraCrea = NULL, $ForA_Estado = NULL) {
    $this->ForA_Codigo = $ForA_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->ForA_UsuarioCrea = $ForA_UsuarioCrea;
    $this->ForA_FechaHoraCrea = $ForA_FechaHoraCrea;
    $this->ForA_Estado = $ForA_Estado;
    $this->tabla = "formatos_areas";
  }

  function getForA_Codigo() {
    return $this->ForA_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getForA_UsuarioCrea() {
    return $this->ForA_UsuarioCrea;
  }

  function getForA_FechaHoraCrea() {
    return $this->ForA_FechaHoraCrea;
  }

  function getForA_Estado() {
    return $this->ForA_Estado;
  }

  function setForA_Codigo($ForA_Codigo) {
    $this->ForA_Codigo = $ForA_Codigo;
  }

  function setAre_Codigo($Are_Codigo) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setForA_UsuarioCrea($ForA_UsuarioCrea) {
    $this->ForA_UsuarioCrea = $ForA_UsuarioCrea;
  }

  function setForA_FechaHoraCrea($ForA_FechaHoraCrea) {
    $this->ForA_FechaHoraCrea = $ForA_FechaHoraCrea;
  }

  function setForA_Estado($ForA_Estado) {
    $this->ForA_Estado = $ForA_Estado;
  }

  public function insertar(){
    $campos = array("Are_Codigo", "For_Codigo", "ForA_UsuarioCrea", "ForA_FechaHoraCrea", "ForA_Estado");
    $valores = array(
    array( 
      $this->Are_Codigo, 
      $this->For_Codigo, 
      $this->ForA_UsuarioCrea, 
      $this->ForA_FechaHoraCrea, 
      $this->ForA_Estado
      )
    );

    $resultado = $this->insertarRegistros($campos, $valores);
    $this->desconectar();

    if($resultado[0] == "OK"){
      return true;
    }else{
      return false;
    }
  }

  public function consultar(){
    $sql =  "SELECT * FROM formatos_areas WHERE ForA_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForA_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAre_Codigo($res[1]);
      $this->setFor_Codigo($res[2]);
      $this->setForA_UsuarioCrea($res[3]);
      $this->setForA_FechaHoraCrea($res[4]);
      $this->setForA_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Are_Codigo", "For_Codigo", "ForA_UsuarioCrea", "ForA_FechaHoraCrea", "ForA_Estado");
    $valores = array($this->getAre_Codigo(), $this->getFor_Codigo(), $this->getForA_UsuarioCrea(), $this->getForA_FechaHoraCrea(), $this->getForA_Estado());
    $llaveprimaria = "ForA_Codigo";
    $valorllaveprimaria = $this->getForA_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM formatos_areas WHERE ForA_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForA_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
	  
 /*
    Autor: DNatalia Rodríguez
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarFormatosAreasUsuario( $planta, $area, $estado, $formato, $usuario ){

    $parametros = array(":usu"=>$usuario,":est"=>$estado);

    $sql = "SELECT ForA_Codigo, plantas.Pla_Nombre, areas.Are_Nombre, formatos.For_Nombre, ForA_Estado
    FROM formatos_areas
    INNER JOIN areas ON formatos_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN formatos ON formatos_areas.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ForA_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu ";
    
    
    if($planta != ""){ 
      $pri = 1; 
      foreach($planta as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " plantas.Pla_Codigo = :pla".$pri." "; 
        $parametros[':pla'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($area != ""){ 
      $pri4 = 1; 
      foreach($area as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " areas.Are_Codigo = :are".$pri4." "; 
        $parametros[':are'.$pri4] = $registro4; 
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
    if($formato != ""){ 
      $pri5 = 1; 
      foreach($formato as $registro5){ 
        if($pri5 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " formatos.For_Codigo = :for".$pri5." "; 
        $parametros[':for'.$pri5] = $registro5; 
        $pri5++; 
      } 
      $sql .= " )"; 
    }
    
    $SQL .=" ORDER BY plantas.Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
	  
}
?>
