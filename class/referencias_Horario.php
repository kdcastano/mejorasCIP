<?php
require_once('basedatos.php');

  class referencias_Horario extends basedatos {
    private $RefH_Codigo;
    private $PueT_Codigo;
    private $ProP_Codigo;
    private $RefH_HoraInicio;
    private $RefH_HoraFinal;
    private $RefH_FechaInicio;
    private $RefH_FechaFinal;
    private $RefH_Turno;
    private $RefH_ConceptoInicio;
    private $RefH_ConceptoFinal;
    private $RefH_FechaHoraCrea;
    private $RefH_UsuarioCrea;
    private $RefH_Estado;

  function __construct($RefH_Codigo = NULL, $PueT_Codigo = NULL, $ProP_Codigo = NULL, $RefH_HoraInicio = NULL, $RefH_HoraFinal = NULL, $RefH_FechaInicio = NULL, $RefH_FechaFinal = NULL, $RefH_Turno = NULL, $RefH_ConceptoInicio = NULL, $RefH_ConceptoFinal = NULL, $RefH_FechaHoraCrea = NULL, $RefH_UsuarioCrea = NULL, $RefH_Estado = NULL) {
    $this->RefH_Codigo = $RefH_Codigo;
    $this->PueT_Codigo = $PueT_Codigo;
    $this->ProP_Codigo = $ProP_Codigo;
    $this->RefH_HoraInicio = $RefH_HoraInicio;
    $this->RefH_HoraFinal = $RefH_HoraFinal;
    $this->RefH_FechaInicio = $RefH_FechaInicio;
    $this->RefH_FechaFinal = $RefH_FechaFinal;
    $this->RefH_Turno = $RefH_Turno;
    $this->RefH_ConceptoInicio = $RefH_ConceptoInicio;
    $this->RefH_ConceptoFinal = $RefH_ConceptoFinal;
    $this->RefH_FechaHoraCrea = $RefH_FechaHoraCrea;
    $this->RefH_UsuarioCrea = $RefH_UsuarioCrea;
    $this->RefH_Estado = $RefH_Estado;
    $this->tabla = "referencias_Horario";
  }

  function getRefH_Codigo() {
    return $this->RefH_Codigo;
  }

  function getPueT_Codigo() {
    return $this->PueT_Codigo;
  }

  function getProP_Codigo() {
    return $this->ProP_Codigo;
  }

  function getRefH_HoraInicio() {
    return $this->RefH_HoraInicio;
  }

  function getRefH_HoraFinal() {
    return $this->RefH_HoraFinal;
  }

  function getRefH_FechaInicio() {
    return $this->RefH_FechaInicio;
  }

  function getRefH_FechaFinal() {
    return $this->RefH_FechaFinal;
  }

  function getRefH_Turno() {
    return $this->RefH_Turno;
  }

  function getRefH_ConceptoInicio() {
    return $this->RefH_ConceptoInicio;
  }

  function getRefH_ConceptoFinal() {
    return $this->RefH_ConceptoFinal;
  }

  function getRefH_FechaHoraCrea() {
    return $this->RefH_FechaHoraCrea;
  }

  function getRefH_UsuarioCrea() {
    return $this->RefH_UsuarioCrea;
  }

  function getRefH_Estado() {
    return $this->RefH_Estado;
  }

  function setRefH_Codigo($RefH_Codigo) {
    $this->RefH_Codigo = $RefH_Codigo;
  }

  function setPueT_Codigo($PueT_Codigo) {
    $this->PueT_Codigo = $PueT_Codigo;
  }

  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
  }

  function setRefH_HoraInicio($RefH_HoraInicio) {
    $this->RefH_HoraInicio = $RefH_HoraInicio;
  }

  function setRefH_HoraFinal($RefH_HoraFinal) {
    $this->RefH_HoraFinal = $RefH_HoraFinal;
  }

  function setRefH_FechaInicio($RefH_FechaInicio) {
    $this->RefH_FechaInicio = $RefH_FechaInicio;
  }

  function setRefH_FechaFinal($RefH_FechaFinal) {
    $this->RefH_FechaFinal = $RefH_FechaFinal;
  }

  function setRefH_Turno($RefH_Turno) {
    $this->RefH_Turno = $RefH_Turno;
  }

  function setRefH_ConceptoInicio($RefH_ConceptoInicio) {
    $this->RefH_ConceptoInicio = $RefH_ConceptoInicio;
  }

  function setRefH_ConceptoFinal($RefH_ConceptoFinal) {
    $this->RefH_ConceptoFinal = $RefH_ConceptoFinal;
  }

  function setRefH_FechaHoraCrea($RefH_FechaHoraCrea) {
    $this->RefH_FechaHoraCrea = $RefH_FechaHoraCrea;
  }

  function setRefH_UsuarioCrea($RefH_UsuarioCrea) {
    $this->RefH_UsuarioCrea = $RefH_UsuarioCrea;
  }

  function setRefH_Estado($RefH_Estado) {
    $this->RefH_Estado = $RefH_Estado;
  }

  public function insertar(){
    $campos = array("PueT_Codigo", "ProP_Codigo", "RefH_HoraInicio", "RefH_HoraFinal", "RefH_FechaInicio", "RefH_FechaFinal", "RefH_Turno", "RefH_ConceptoInicio", "RefH_ConceptoFinal", "RefH_FechaHoraCrea", "RefH_UsuarioCrea", "RefH_Estado");
    $valores = array(
    array( 
      $this->PueT_Codigo, 
      $this->ProP_Codigo, 
      $this->RefH_HoraInicio, 
      $this->RefH_HoraFinal, 
      $this->RefH_FechaInicio, 
      $this->RefH_FechaFinal, 
      $this->RefH_Turno, 
      $this->RefH_ConceptoInicio, 
      $this->RefH_ConceptoFinal, 
      $this->RefH_FechaHoraCrea, 
      $this->RefH_UsuarioCrea, 
      $this->RefH_Estado
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
    $sql =  "SELECT * FROM referencias_Horario WHERE RefH_Codigo = :cod";
    $parametros = array(":cod"=>$this->RefH_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPueT_Codigo($res[1]);
      $this->setProP_Codigo($res[2]);
      $this->setRefH_HoraInicio($res[3]);
      $this->setRefH_HoraFinal($res[4]);
      $this->setRefH_FechaInicio($res[5]);
      $this->setRefH_FechaFinal($res[6]);
      $this->setRefH_Turno($res[7]);
      $this->setRefH_ConceptoInicio($res[8]);
      $this->setRefH_ConceptoFinal($res[9]);
      $this->setRefH_FechaHoraCrea($res[10]);
      $this->setRefH_UsuarioCrea($res[11]);
      $this->setRefH_Estado($res[12]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("PueT_Codigo", "ProP_Codigo", "RefH_HoraInicio", "RefH_HoraFinal", "RefH_FechaInicio", "RefH_FechaFinal", "RefH_Turno", "RefH_ConceptoInicio", "RefH_ConceptoFinal", "RefH_FechaHoraCrea", "RefH_UsuarioCrea", "RefH_Estado");
    $valores = array($this->getPueT_Codigo(), $this->getProP_Codigo(), $this->getRefH_HoraInicio(), $this->getRefH_HoraFinal(), $this->getRefH_FechaInicio(), $this->getRefH_FechaFinal(), $this->getRefH_Turno(), $this->getRefH_ConceptoInicio(), $this->getRefH_ConceptoFinal(), $this->getRefH_FechaHoraCrea(), $this->getRefH_UsuarioCrea(), $this->getRefH_Estado());
    $llaveprimaria = "RefH_Codigo";
    $valorllaveprimaria = $this->getRefH_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM referencias_Horario WHERE RefH_Codigo = :cod";
    $parametros = array(":cod"=>$this->RefH_Codigo);
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
  public function buscarRegistroCreado($puestoTrabajo, $programaProduccion, $fechaInicio, $turno){

    $parametros = array(":pue"=>$puestoTrabajo,":pro"=>$programaProduccion,":fec"=>$fechaInicio,":tur"=>$turno);

    $sql = "SELECT RefH_Codigo, ProP_Codigo
    FROM referencias_Horario
    WHERE RefH_Estado = '1' AND PueT_Codigo = :pue AND ProP_Codigo = :pro AND RefH_FechaInicio = :fec AND RefH_Turno = :tur ";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }  
}
?>
