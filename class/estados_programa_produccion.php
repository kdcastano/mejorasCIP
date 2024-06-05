<?php
require_once('basedatos.php');

  class estados_programa_produccion extends basedatos {
    private $EProP_Codigo;
    private $ProP_Codigo;
    private $EProP_EstadoActual;
    private $EProP_FechaHoraCrea;
    private $EProP_UsuarioCrea;
    private $EProP_Estado;

  function __construct($EProP_Codigo = NULL, $ProP_Codigo = NULL, $EProP_EstadoActual = NULL, $EProP_FechaHoraCrea = NULL, $EProP_UsuarioCrea = NULL, $EProP_Estado = NULL) {
    $this->EProP_Codigo = $EProP_Codigo;
    $this->ProP_Codigo = $ProP_Codigo;
    $this->EProP_EstadoActual = $EProP_EstadoActual;
    $this->EProP_FechaHoraCrea = $EProP_FechaHoraCrea;
    $this->EProP_UsuarioCrea = $EProP_UsuarioCrea;
    $this->EProP_Estado = $EProP_Estado;
    $this->tabla = "estados_programa_produccion";
  }

  function getEProP_Codigo() {
    return $this->EProP_Codigo;
  }

  function getProP_Codigo() {
    return $this->ProP_Codigo;
  }

  function getEProP_EstadoActual() {
    return $this->EProP_EstadoActual;
  }

  function getEProP_FechaHoraCrea() {
    return $this->EProP_FechaHoraCrea;
  }

  function getEProP_UsuarioCrea() {
    return $this->EProP_UsuarioCrea;
  }

  function getEProP_Estado() {
    return $this->EProP_Estado;
  }

  function setEProP_Codigo($EProP_Codigo) {
    $this->EProP_Codigo = $EProP_Codigo;
  }

  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
  }

  function setEProP_EstadoActual($EProP_EstadoActual) {
    $this->EProP_EstadoActual = $EProP_EstadoActual;
  }

  function setEProP_FechaHoraCrea($EProP_FechaHoraCrea) {
    $this->EProP_FechaHoraCrea = $EProP_FechaHoraCrea;
  }

  function setEProP_UsuarioCrea($EProP_UsuarioCrea) {
    $this->EProP_UsuarioCrea = $EProP_UsuarioCrea;
  }

  function setEProP_Estado($EProP_Estado) {
    $this->EProP_Estado = $EProP_Estado;
  }

  public function insertar(){
    $campos = array("ProP_Codigo", "EProP_EstadoActual", "EProP_FechaHoraCrea", "EProP_UsuarioCrea", "EProP_Estado");
    $valores = array(
    array(
      $this->ProP_Codigo, 
      $this->EProP_EstadoActual, 
      $this->EProP_FechaHoraCrea, 
      $this->EProP_UsuarioCrea, 
      $this->EProP_Estado
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
    $sql =  "SELECT * FROM estados_programa_produccion WHERE EProP_Codigo = :cod";
    $parametros = array(":cod"=>$this->EProP_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setProP_Codigo($res[1]);
      $this->setEProP_EstadoActual($res[2]);
      $this->setEProP_FechaHoraCrea($res[3]);
      $this->setEProP_UsuarioCrea($res[4]);
      $this->setEProP_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("ProP_Codigo", "EProP_EstadoActual", "EProP_FechaHoraCrea", "EProP_UsuarioCrea", "EProP_Estado");
    $valores = array($this->getProP_Codigo(), $this->getEProP_EstadoActual(), $this->getEProP_FechaHoraCrea(), $this->getEProP_UsuarioCrea(), $this->getEProP_Estado());
    $llaveprimaria = "EProP_Codigo";
    $valorllaveprimaria = $this->getEProP_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM estados_programa_produccion WHERE EProP_Codigo = :cod";
    $parametros = array(":cod"=>$this->EProP_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
}
?>
