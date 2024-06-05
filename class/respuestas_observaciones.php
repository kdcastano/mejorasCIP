<?php
require_once('basedatos.php');

  class respuestas_observaciones extends basedatos {
    private $ResO_Codigo;
    private $Res_Codigo;
    private $Usu_Codigo;
    private $ResO_Fecha;
    private $ResO_Hora;
    private $ResO_Observacion;
    private $ResO_FechaHoraCrea;
    private $ResO_UsuarioCrea;
    private $ResO_Estado;

  function __construct($ResO_Codigo = NULL, $Res_Codigo = NULL, $Usu_Codigo = NULL, $ResO_Fecha = NULL, $ResO_Hora = NULL, $ResO_Observacion = NULL, $ResO_FechaHoraCrea = NULL, $ResO_UsuarioCrea = NULL, $ResO_Estado = NULL) {
    $this->ResO_Codigo = $ResO_Codigo;
    $this->Res_Codigo = $Res_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->ResO_Fecha = $ResO_Fecha;
    $this->ResO_Hora = $ResO_Hora;
    $this->ResO_Observacion = $ResO_Observacion;
    $this->ResO_FechaHoraCrea = $ResO_FechaHoraCrea;
    $this->ResO_UsuarioCrea = $ResO_UsuarioCrea;
    $this->ResO_Estado = $ResO_Estado;
    $this->tabla = "respuestas_observaciones";
  }

  function getResO_Codigo() {
    return $this->ResO_Codigo;
  }

  function getRes_Codigo() {
    return $this->Res_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getResO_Fecha() {
    return $this->ResO_Fecha;
  }

  function getResO_Hora() {
    return $this->ResO_Hora;
  }

  function getResO_Observacion() {
    return $this->ResO_Observacion;
  }

  function getResO_FechaHoraCrea() {
    return $this->ResO_FechaHoraCrea;
  }

  function getResO_UsuarioCrea() {
    return $this->ResO_UsuarioCrea;
  }

  function getResO_Estado() {
    return $this->ResO_Estado;
  }

  function setResO_Codigo($ResO_Codigo) {
    $this->ResO_Codigo = $ResO_Codigo;
  }

  function setRes_Codigo($Res_Codigo) {
    $this->Res_Codigo = $Res_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setResO_Fecha($ResO_Fecha) {
    $this->ResO_Fecha = $ResO_Fecha;
  }

  function setResO_Hora($ResO_Hora) {
    $this->ResO_Hora = $ResO_Hora;
  }

  function setResO_Observacion($ResO_Observacion) {
    $this->ResO_Observacion = $ResO_Observacion;
  }

  function setResO_FechaHoraCrea($ResO_FechaHoraCrea) {
    $this->ResO_FechaHoraCrea = $ResO_FechaHoraCrea;
  }

  function setResO_UsuarioCrea($ResO_UsuarioCrea) {
    $this->ResO_UsuarioCrea = $ResO_UsuarioCrea;
  }

  function setResO_Estado($ResO_Estado) {
    $this->ResO_Estado = $ResO_Estado;
  }

  public function insertar(){
    $campos = array("Res_Codigo", "Usu_Codigo", "ResO_Fecha", "ResO_Hora", "ResO_Observacion", "ResO_FechaHoraCrea", "ResO_UsuarioCrea", "ResO_Estado");
    $valores = array(
    array(
      $this->Res_Codigo, 
      $this->Usu_Codigo, 
      $this->ResO_Fecha, 
      $this->ResO_Hora, 
      $this->ResO_Observacion, 
      $this->ResO_FechaHoraCrea, 
      $this->ResO_UsuarioCrea, 
      $this->ResO_Estado
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
    $sql =  "SELECT * FROM respuestas_observaciones WHERE ResO_Codigo = :cod";
    $parametros = array(":cod"=>$this->ResO_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setRes_Codigo($res[1]);
      $this->setUsu_Codigo($res[2]);
      $this->setResO_Fecha($res[3]);
      $this->setResO_Hora($res[4]);
      $this->setResO_Observacion($res[5]);
      $this->setResO_FechaHoraCrea($res[6]);
      $this->setResO_UsuarioCrea($res[7]);
      $this->setResO_Estado($res[8]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Res_Codigo", "Usu_Codigo", "ResO_Fecha", "ResO_Hora", "ResO_Observacion", "ResO_FechaHoraCrea", "ResO_UsuarioCrea", "ResO_Estado");
    $valores = array($this->getRes_Codigo(), $this->getUsu_Codigo(), $this->getResO_Fecha(), $this->getResO_Hora(), $this->getResO_Observacion(), $this->getResO_FechaHoraCrea(), $this->getResO_UsuarioCrea(), $this->getResO_Estado());
    $llaveprimaria = "ResO_Codigo";
    $valorllaveprimaria = $this->getResO_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM respuestas_observaciones WHERE ResO_Codigo = :cod";
    $parametros = array(":cod"=>$this->ResO_Codigo);
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
  public function listarPanelSupervisorObservaciones($Res_Codigo){

    $parametros = array(":cod"=>$Res_Codigo);

    $sql = "SELECT ResO_Codigo, CONCAT_WS(' ',Usu_Nombres, Usu_Apellidos) AS nombres, ResO_Fecha, ResO_Observacion, usuarios.Usu_Codigo
    FROM respuestas_observaciones
    INNER JOIN usuarios ON respuestas_observaciones.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE ResO_Estado = 1 AND Res_Codigo = :cod";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
