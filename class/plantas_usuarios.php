<?php
require_once('basedatos.php');

  class plantas_usuarios extends basedatos {
    private $PlaU_Codigo;
    private $Usu_Codigo;
    private $Pla_Codigo;
    private $PlaU_FechaHoraCrea;
    private $PlaU_UsuarioCrea;
    private $PlaU_Estado;

  function __construct($PlaU_Codigo = NULL, $Usu_Codigo = NULL, $Pla_Codigo = NULL, $PlaU_FechaHoraCrea = NULL, $PlaU_UsuarioCrea = NULL, $PlaU_Estado = NULL) {
    $this->PlaU_Codigo = $PlaU_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->PlaU_FechaHoraCrea = $PlaU_FechaHoraCrea;
    $this->PlaU_UsuarioCrea = $PlaU_UsuarioCrea;
    $this->PlaU_Estado = $PlaU_Estado;
    $this->tabla = "plantas_usuarios";
  }

  function getPlaU_Codigo() {
    return $this->PlaU_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getPlaU_FechaHoraCrea() {
    return $this->PlaU_FechaHoraCrea;
  }

  function getPlaU_UsuarioCrea() {
    return $this->PlaU_UsuarioCrea;
  }

  function getPlaU_Estado() {
    return $this->PlaU_Estado;
  }

  function setPlaU_Codigo($PlaU_Codigo) {
    $this->PlaU_Codigo = $PlaU_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setPlaU_FechaHoraCrea($PlaU_FechaHoraCrea) {
    $this->PlaU_FechaHoraCrea = $PlaU_FechaHoraCrea;
  }

  function setPlaU_UsuarioCrea($PlaU_UsuarioCrea) {
    $this->PlaU_UsuarioCrea = $PlaU_UsuarioCrea;
  }

  function setPlaU_Estado($PlaU_Estado) {
    $this->PlaU_Estado = $PlaU_Estado;
  }

  public function insertar(){
    $campos = array("Usu_Codigo", "Pla_Codigo", "PlaU_FechaHoraCrea", "PlaU_UsuarioCrea", "PlaU_Estado");
    $valores = array(
    array( 
      $this->Usu_Codigo, 
      $this->Pla_Codigo, 
      $this->PlaU_FechaHoraCrea, 
      $this->PlaU_UsuarioCrea, 
      $this->PlaU_Estado
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
    $sql =  "SELECT * FROM plantas_usuarios WHERE PlaU_Codigo = :cod";
    $parametros = array(":cod"=>$this->PlaU_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setUsu_Codigo($res[1]);
      $this->setPla_Codigo($res[2]);
      $this->setPlaU_FechaHoraCrea($res[3]);
      $this->setPlaU_UsuarioCrea($res[4]);
      $this->setPlaU_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Usu_Codigo", "Pla_Codigo", "PlaU_FechaHoraCrea", "PlaU_UsuarioCrea", "PlaU_Estado");
    $valores = array($this->getUsu_Codigo(), $this->getPla_Codigo(), $this->getPlaU_FechaHoraCrea(), $this->getPlaU_UsuarioCrea(), $this->getPlaU_Estado());
    $llaveprimaria = "PlaU_Codigo";
    $valorllaveprimaria = $this->getPlaU_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM plantas_usuarios WHERE PlaU_Codigo = :cod";
    $parametros = array(":cod"=>$this->PlaU_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    

  /*
    Autor: Natalia Rodríguez
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function plantasUsuarioListar($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS nombre, Pla_nombre, plantas.Pla_Codigo, PlaU_Codigo
    FROM plantas_usuarios
    INNER JOIN plantas ON plantas.Pla_Codigo=plantas_usuarios.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN usuarios ON usuarios.Usu_Codigo=plantas_usuarios.Usu_Codigo AND usuarios.Usu_Estado = 1
    WHERE plantas_usuarios.Usu_Codigo= :usu AND PlaU_Estado = 1";


    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
