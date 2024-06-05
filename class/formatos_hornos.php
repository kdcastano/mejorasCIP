<?php
require_once('basedatos.php');

  class formatos_hornos extends basedatos {
    private $ForH_Codigo;
    private $Are_Codigo;
    private $For_Codigo;
    private $ForH_FechaHoraCrea;
    private $ForH_UsuarioCrea;
    private $ForH_Estado;

  function __construct($ForH_Codigo = NULL, $Are_Codigo = NULL, $For_Codigo = NULL, $ForH_FechaHoraCrea = NULL, $ForH_UsuarioCrea = NULL, $ForH_Estado = NULL) {
    $this->ForH_Codigo = $ForH_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->ForH_FechaHoraCrea = $ForH_FechaHoraCrea;
    $this->ForH_UsuarioCrea = $ForH_UsuarioCrea;
    $this->ForH_Estado = $ForH_Estado;
    $this->tabla = "formatos_hornos";
  }

  function getForH_Codigo() {
    return $this->ForH_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getForH_FechaHoraCrea() {
    return $this->ForH_FechaHoraCrea;
  }

  function getForH_UsuarioCrea() {
    return $this->ForH_UsuarioCrea;
  }

  function getForH_Estado() {
    return $this->ForH_Estado;
  }

  function setForH_Codigo($ForH_Codigo) {
    $this->ForH_Codigo = $ForH_Codigo;
  }

  function setAre_Codigo($Are_Codigo) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setForH_FechaHoraCrea($ForH_FechaHoraCrea) {
    $this->ForH_FechaHoraCrea = $ForH_FechaHoraCrea;
  }

  function setForH_UsuarioCrea($ForH_UsuarioCrea) {
    $this->ForH_UsuarioCrea = $ForH_UsuarioCrea;
  }

  function setForH_Estado($ForH_Estado) {
    $this->ForH_Estado = $ForH_Estado;
  }

  public function insertar(){
    $campos = array("Are_Codigo", "For_Codigo", "ForH_FechaHoraCrea", "ForH_UsuarioCrea", "ForH_Estado");
    $valores = array(
    array( 
      $this->Are_Codigo, 
      $this->For_Codigo, 
      $this->ForH_FechaHoraCrea, 
      $this->ForH_UsuarioCrea, 
      $this->ForH_Estado
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
    $sql =  "SELECT * FROM formatos_hornos WHERE ForH_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForH_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAre_Codigo($res[1]);
      $this->setFor_Codigo($res[2]);
      $this->setForH_FechaHoraCrea($res[3]);
      $this->setForH_UsuarioCrea($res[4]);
      $this->setForH_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Are_Codigo", "For_Codigo", "ForH_FechaHoraCrea", "ForH_UsuarioCrea", "ForH_Estado");
    $valores = array($this->getAre_Codigo(), $this->getFor_Codigo(), $this->getForH_FechaHoraCrea(), $this->getForH_UsuarioCrea(), $this->getForH_Estado());
    $llaveprimaria = "ForH_Codigo";
    $valorllaveprimaria = $this->getForH_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM formatos_hornos WHERE ForH_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForH_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
    
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarFormatosUsuario($usuario, $planta, $area, $estado, $formato){

    $parametros = array(":usu"=>$usuario,":est"=>$estado);

    $sql = "SELECT ForH_Codigo, plantas.Pla_Nombre, areas.Are_Nombre, formatos.For_Nombre, ForH_Estado
    FROM formatos_hornos
    INNER JOIN areas ON formatos_hornos.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN formatos ON formatos_hornos.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ForH_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu ";
    
    
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
    
  /*
    Autor: Natalia Rodríguez
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarFormatosUsuarioArea($usuario, $area){

    $parametros = array(":usu"=>$usuario,":are"=>$area );

    $sql = "SELECT formatos_hornos.For_Codigo, formatos.For_Nombre
    FROM formatos_hornos
    INNER JOIN areas ON formatos_hornos.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN formatos ON formatos_hornos.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ForH_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND areas.Are_Codigo = :are ";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
