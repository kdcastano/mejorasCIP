<?php
require_once('basedatos.php');

  class planes_acciones extends basedatos {
    private $PlaA_Codigo;
    private $Res_Codigo;
    private $PlaA_TipoDefecto;
    private $PlaA_ObservacionesOperario;
    private $PlaA_ObservacionesSupervisor;
    private $PlaA_FechaObservacionesOperario;
    private $PlaA_FechaObservacionesSupervisor;
    private $PlaA_HoraObservacionesOperario;
    private $PlaA_HoraObservacionesSupervisor;
    private $PlaA_ObservacionesJefaturas;
    private $PlaA_FechaObservacionesJefaturas;
    private $PlaA_HoraObservacionesJefaturas;
    private $PlaA_Prioridad;
    private $PlaA_Supervisor;
    private $PlaA_FechaHoraCrea;
    private $PlaA_UsuarioCrea;
    private $PlaA_Estado;
    private $PlaA_Mantenimiento;
    private $PlaA_Mant_TarjetaRoja;
    private $PlaA_Mant_AvisoSAP;
    private $PlaA_Mant_Observaciones;
    private $PlaA_Mant_Fecha;
    private $PlaA_Mant_usuarioSAP;

  function __construct($PlaA_Codigo = NULL, $Res_Codigo = NULL, $PlaA_TipoDefecto = NULL, $PlaA_ObservacionesOperario = NULL, $PlaA_ObservacionesSupervisor = NULL, $PlaA_FechaObservacionesOperario = NULL, $PlaA_FechaObservacionesSupervisor = NULL, $PlaA_HoraObservacionesOperario = NULL, $PlaA_HoraObservacionesSupervisor = NULL, $PlaA_ObservacionesJefaturas = NULL, $PlaA_FechaObservacionesJefaturas = NULL, $PlaA_HoraObservacionesJefaturas = NULL, $PlaA_Prioridad = NULL, $PlaA_Supervisor = NULL, $PlaA_FechaHoraCrea = NULL, $PlaA_UsuarioCrea = NULL, $PlaA_Estado = NULL, $PlaA_Mantenimiento = NULL, $PlaA_Mant_TarjetaRoja = NULL, $PlaA_Mant_AvisoSAP = NULL, $PlaA_Mant_Observaciones = NULL, $PlaA_Mant_Fecha = NULL, $PlaA_Mant_usuarioSAP = NULL) {
    $this->PlaA_Codigo = $PlaA_Codigo;
    $this->Res_Codigo = $Res_Codigo;
    $this->PlaA_TipoDefecto = $PlaA_TipoDefecto;
    $this->PlaA_ObservacionesOperario = $PlaA_ObservacionesOperario;
    $this->PlaA_ObservacionesSupervisor = $PlaA_ObservacionesSupervisor;
    $this->PlaA_FechaObservacionesOperario = $PlaA_FechaObservacionesOperario;
    $this->PlaA_FechaObservacionesSupervisor = $PlaA_FechaObservacionesSupervisor;
    $this->PlaA_HoraObservacionesOperario = $PlaA_HoraObservacionesOperario;
    $this->PlaA_HoraObservacionesSupervisor = $PlaA_HoraObservacionesSupervisor;
    $this->PlaA_ObservacionesJefaturas = $PlaA_ObservacionesJefaturas;
    $this->PlaA_FechaObservacionesJefaturas = $PlaA_FechaObservacionesJefaturas;
    $this->PlaA_HoraObservacionesJefaturas = $PlaA_HoraObservacionesJefaturas;
    $this->PlaA_Prioridad = $PlaA_Prioridad;
    $this->PlaA_Supervisor = $PlaA_Supervisor;
    $this->PlaA_FechaHoraCrea = $PlaA_FechaHoraCrea;
    $this->PlaA_UsuarioCrea = $PlaA_UsuarioCrea;
    $this->PlaA_Estado = $PlaA_Estado;
    $this->PlaA_Mantenimiento = $PlaA_Mantenimiento;
    $this->PlaA_Mant_TarjetaRoja = $PlaA_Mant_TarjetaRoja;
    $this->PlaA_Mant_AvisoSAP = $PlaA_Mant_AvisoSAP;
    $this->PlaA_Mant_Observaciones = $PlaA_Mant_Observaciones;
    $this->PlaA_Mant_Fecha = $PlaA_Mant_Fecha;
    $this->PlaA_Mant_usuarioSAP = $PlaA_Mant_usuarioSAP;
    $this->tabla = "planes_acciones";
  }

  function getPlaA_Codigo() {
    return $this->PlaA_Codigo;
  }

  function getRes_Codigo() {
    return $this->Res_Codigo;
  }

  function getPlaA_TipoDefecto() {
    return $this->PlaA_TipoDefecto;
  }

  function getPlaA_ObservacionesOperario() {
    return $this->PlaA_ObservacionesOperario;
  }

  function getPlaA_ObservacionesSupervisor() {
    return $this->PlaA_ObservacionesSupervisor;
  }

  function getPlaA_FechaObservacionesOperario() {
    return $this->PlaA_FechaObservacionesOperario;
  }

  function getPlaA_FechaObservacionesSupervisor() {
    return $this->PlaA_FechaObservacionesSupervisor;
  }

  function getPlaA_HoraObservacionesOperario() {
    return $this->PlaA_HoraObservacionesOperario;
  }

  function getPlaA_HoraObservacionesSupervisor() {
    return $this->PlaA_HoraObservacionesSupervisor;
  }

  function getPlaA_ObservacionesJefaturas() {
    return $this->PlaA_ObservacionesJefaturas;
  }

  function getPlaA_FechaObservacionesJefaturas() {
    return $this->PlaA_FechaObservacionesJefaturas;
  }

  function getPlaA_HoraObservacionesJefaturas() {
    return $this->PlaA_HoraObservacionesJefaturas;
  }

  function getPlaA_Prioridad() {
    return $this->PlaA_Prioridad;
  }

  function getPlaA_Supervisor() {
    return $this->PlaA_Supervisor;
  }

  function getPlaA_FechaHoraCrea() {
    return $this->PlaA_FechaHoraCrea;
  }

  function getPlaA_UsuarioCrea() {
    return $this->PlaA_UsuarioCrea;
  }

  function getPlaA_Estado() {
    return $this->PlaA_Estado;
  }

  function getPlaA_Mantenimiento() {
    return $this->PlaA_Mantenimiento;
  }

  function getPlaA_Mant_TarjetaRoja() {
    return $this->PlaA_Mant_TarjetaRoja;
  }

  function getPlaA_Mant_AvisoSAP() {
    return $this->PlaA_Mant_AvisoSAP;
  }

  function getPlaA_Mant_Observaciones() {
    return $this->PlaA_Mant_Observaciones;
  }

  function getPlaA_Mant_Fecha() {
    return $this->PlaA_Mant_Fecha;
  }

  function getPlaA_Mant_usuarioSAP() {
    return $this->PlaA_Mant_usuarioSAP;
  }

  function setPlaA_Codigo($PlaA_Codigo) {
    $this->PlaA_Codigo = $PlaA_Codigo;
  }

  function setRes_Codigo($Res_Codigo) {
    $this->Res_Codigo = $Res_Codigo;
  }

  function setPlaA_TipoDefecto($PlaA_TipoDefecto) {
    $this->PlaA_TipoDefecto = $PlaA_TipoDefecto;
  }

  function setPlaA_ObservacionesOperario($PlaA_ObservacionesOperario) {
    $this->PlaA_ObservacionesOperario = $PlaA_ObservacionesOperario;
  }

  function setPlaA_ObservacionesSupervisor($PlaA_ObservacionesSupervisor) {
    $this->PlaA_ObservacionesSupervisor = $PlaA_ObservacionesSupervisor;
  }

  function setPlaA_FechaObservacionesOperario($PlaA_FechaObservacionesOperario) {
    $this->PlaA_FechaObservacionesOperario = $PlaA_FechaObservacionesOperario;
  }

  function setPlaA_FechaObservacionesSupervisor($PlaA_FechaObservacionesSupervisor) {
    $this->PlaA_FechaObservacionesSupervisor = $PlaA_FechaObservacionesSupervisor;
  }

  function setPlaA_HoraObservacionesOperario($PlaA_HoraObservacionesOperario) {
    $this->PlaA_HoraObservacionesOperario = $PlaA_HoraObservacionesOperario;
  }

  function setPlaA_HoraObservacionesSupervisor($PlaA_HoraObservacionesSupervisor) {
    $this->PlaA_HoraObservacionesSupervisor = $PlaA_HoraObservacionesSupervisor;
  }

  function setPlaA_ObservacionesJefaturas($PlaA_ObservacionesJefaturas) {
    $this->PlaA_ObservacionesJefaturas = $PlaA_ObservacionesJefaturas;
  }

  function setPlaA_FechaObservacionesJefaturas($PlaA_FechaObservacionesJefaturas) {
    $this->PlaA_FechaObservacionesJefaturas = $PlaA_FechaObservacionesJefaturas;
  }

  function setPlaA_HoraObservacionesJefaturas($PlaA_HoraObservacionesJefaturas) {
    $this->PlaA_HoraObservacionesJefaturas = $PlaA_HoraObservacionesJefaturas;
  }

  function setPlaA_Prioridad($PlaA_Prioridad) {
    $this->PlaA_Prioridad = $PlaA_Prioridad;
  }

  function setPlaA_Supervisor($PlaA_Supervisor) {
    $this->PlaA_Supervisor = $PlaA_Supervisor;
  }

  function setPlaA_FechaHoraCrea($PlaA_FechaHoraCrea) {
    $this->PlaA_FechaHoraCrea = $PlaA_FechaHoraCrea;
  }

  function setPlaA_UsuarioCrea($PlaA_UsuarioCrea) {
    $this->PlaA_UsuarioCrea = $PlaA_UsuarioCrea;
  }

  function setPlaA_Estado($PlaA_Estado) {
    $this->PlaA_Estado = $PlaA_Estado;
  }

  function setPlaA_Mantenimiento($PlaA_Mantenimiento) {
    $this->PlaA_Mantenimiento = $PlaA_Mantenimiento;
  }

  function setPlaA_Mant_TarjetaRoja($PlaA_Mant_TarjetaRoja) {
    $this->PlaA_Mant_TarjetaRoja = $PlaA_Mant_TarjetaRoja;
  }

  function setPlaA_Mant_AvisoSAP($PlaA_Mant_AvisoSAP) {
    $this->PlaA_Mant_AvisoSAP = $PlaA_Mant_AvisoSAP;
  }

  function setPlaA_Mant_Observaciones($PlaA_Mant_Observaciones) {
    $this->PlaA_Mant_Observaciones = $PlaA_Mant_Observaciones;
  }

  function setPlaA_Mant_Fecha($PlaA_Mant_Fecha) {
    $this->PlaA_Mant_Fecha = $PlaA_Mant_Fecha;
  }

  function setPlaA_Mant_usuarioSAP($PlaA_Mant_usuarioSAP) {
    $this->PlaA_Mant_usuarioSAP = $PlaA_Mant_usuarioSAP;
  }

  public function insertar(){
    $campos = array("Res_Codigo", "PlaA_TipoDefecto", "PlaA_ObservacionesOperario", "PlaA_ObservacionesSupervisor", "PlaA_FechaObservacionesOperario", "PlaA_FechaObservacionesSupervisor", "PlaA_HoraObservacionesOperario", "PlaA_HoraObservacionesSupervisor", "PlaA_ObservacionesJefaturas", "PlaA_FechaObservacionesJefaturas", "PlaA_HoraObservacionesJefaturas", "PlaA_Prioridad", "PlaA_Supervisor", "PlaA_FechaHoraCrea", "PlaA_UsuarioCrea", "PlaA_Estado", "PlaA_Mantenimiento", "PlaA_Mant_TarjetaRoja", "PlaA_Mant_AvisoSAP", "PlaA_Mant_Observaciones", "PlaA_Mant_Fecha", "PlaA_Mant_usuarioSAP");
    $valores = array(
    array(
      $this->Res_Codigo, 
      $this->PlaA_TipoDefecto, 
      $this->PlaA_ObservacionesOperario, 
      $this->PlaA_ObservacionesSupervisor, 
      $this->PlaA_FechaObservacionesOperario, 
      $this->PlaA_FechaObservacionesSupervisor, 
      $this->PlaA_HoraObservacionesOperario, 
      $this->PlaA_HoraObservacionesSupervisor, 
      $this->PlaA_ObservacionesJefaturas, 
      $this->PlaA_FechaObservacionesJefaturas, 
      $this->PlaA_HoraObservacionesJefaturas, 
      $this->PlaA_Prioridad, 
      $this->PlaA_Supervisor, 
      $this->PlaA_FechaHoraCrea, 
      $this->PlaA_UsuarioCrea, 
      $this->PlaA_Estado, 
      $this->PlaA_Mantenimiento, 
      $this->PlaA_Mant_TarjetaRoja, 
      $this->PlaA_Mant_AvisoSAP, 
      $this->PlaA_Mant_Observaciones, 
      $this->PlaA_Mant_Fecha, 
      $this->PlaA_Mant_usuarioSAP
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
    $sql =  "SELECT * FROM planes_acciones WHERE PlaA_Codigo = :cod";
    $parametros = array(":cod"=>$this->PlaA_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setRes_Codigo($res[1]);
      $this->setPlaA_TipoDefecto($res[2]);
      $this->setPlaA_ObservacionesOperario($res[3]);
      $this->setPlaA_ObservacionesSupervisor($res[4]);
      $this->setPlaA_FechaObservacionesOperario($res[5]);
      $this->setPlaA_FechaObservacionesSupervisor($res[6]);
      $this->setPlaA_HoraObservacionesOperario($res[7]);
      $this->setPlaA_HoraObservacionesSupervisor($res[8]);
      $this->setPlaA_ObservacionesJefaturas($res[9]);
      $this->setPlaA_FechaObservacionesJefaturas($res[10]);
      $this->setPlaA_HoraObservacionesJefaturas($res[11]);
      $this->setPlaA_Prioridad($res[12]);
      $this->setPlaA_Supervisor($res[13]);
      $this->setPlaA_FechaHoraCrea($res[14]);
      $this->setPlaA_UsuarioCrea($res[15]);
      $this->setPlaA_Estado($res[16]);
      $this->setPlaA_Mantenimiento($res[17]);
      $this->setPlaA_Mant_TarjetaRoja($res[18]);
      $this->setPlaA_Mant_AvisoSAP($res[19]);
      $this->setPlaA_Mant_Observaciones($res[20]);
      $this->setPlaA_Mant_Fecha($res[21]);
      $this->setPlaA_Mant_usuarioSAP($res[22]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Res_Codigo", "PlaA_TipoDefecto", "PlaA_ObservacionesOperario", "PlaA_ObservacionesSupervisor", "PlaA_FechaObservacionesOperario", "PlaA_FechaObservacionesSupervisor", "PlaA_HoraObservacionesOperario", "PlaA_HoraObservacionesSupervisor", "PlaA_ObservacionesJefaturas", "PlaA_FechaObservacionesJefaturas", "PlaA_HoraObservacionesJefaturas", "PlaA_Prioridad", "PlaA_Supervisor", "PlaA_FechaHoraCrea", "PlaA_UsuarioCrea", "PlaA_Estado", "PlaA_Mantenimiento", "PlaA_Mant_TarjetaRoja", "PlaA_Mant_AvisoSAP", "PlaA_Mant_Observaciones", "PlaA_Mant_Fecha", "PlaA_Mant_usuarioSAP");
    $valores = array($this->getRes_Codigo(), $this->getPlaA_TipoDefecto(), $this->getPlaA_ObservacionesOperario(), $this->getPlaA_ObservacionesSupervisor(), $this->getPlaA_FechaObservacionesOperario(), $this->getPlaA_FechaObservacionesSupervisor(), $this->getPlaA_HoraObservacionesOperario(), $this->getPlaA_HoraObservacionesSupervisor(), $this->getPlaA_ObservacionesJefaturas(), $this->getPlaA_FechaObservacionesJefaturas(), $this->getPlaA_HoraObservacionesJefaturas(), $this->getPlaA_Prioridad(), $this->getPlaA_Supervisor(), $this->getPlaA_FechaHoraCrea(), $this->getPlaA_UsuarioCrea(), $this->getPlaA_Estado(), $this->getPlaA_Mantenimiento(), $this->getPlaA_Mant_TarjetaRoja(), $this->getPlaA_Mant_AvisoSAP(), $this->getPlaA_Mant_Observaciones(), $this->getPlaA_Mant_Fecha(), $this->getPlaA_Mant_usuarioSAP());
    $llaveprimaria = "PlaA_Codigo";
    $valorllaveprimaria = $this->getPlaA_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM planes_acciones WHERE PlaA_Codigo = :cod";
    $parametros = array(":cod"=>$this->PlaA_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }

 
    /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarObservacionesRespuestasPanelSupervisor($respuesta){

    $parametros = array(":resp"=>$respuesta);

    $sql = "SELECT PlaA_Codigo, PlaA_ObservacionesOperario, PlaA_FechaObservacionesOperario, PlaA_HoraObservacionesOperario,
PlaA_ObservacionesSupervisor, PlaA_FechaObservacionesSupervisor, PlaA_HoraObservacionesSupervisor
FROM planes_acciones
WHERE Res_Codigo = :resp
LIMIT 1";

    if($_SERVER['REMOTE_ADDR'] == '172.19.23.10'){  
     echo $sql."<br>";  
   //  var_dump($parametros); 
}
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>