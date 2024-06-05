<?php
require_once('basedatos.php');

  class frecuencias_agrupaciones_configft extends basedatos {
    private $FreACFT_Codigo;
    private $AgrC_Codigo;
    private $Tur_Codigo;
    private $FreACFT_Hora;
    private $FreACFT_FechaHoraCrea;
    private $FreACFT_UsuarioCrea;
    private $FreACFT_Estado;

  function __construct($FreACFT_Codigo = NULL, $AgrC_Codigo = NULL, $Tur_Codigo = NULL, $FreACFT_Hora = NULL, $FreACFT_FechaHoraCrea = NULL, $FreACFT_UsuarioCrea = NULL, $FreACFT_Estado = NULL) {
    $this->FreACFT_Codigo = $FreACFT_Codigo;
    $this->AgrC_Codigo = $AgrC_Codigo;
    $this->Tur_Codigo = $Tur_Codigo;
    $this->FreACFT_Hora = $FreACFT_Hora;
    $this->FreACFT_FechaHoraCrea = $FreACFT_FechaHoraCrea;
    $this->FreACFT_UsuarioCrea = $FreACFT_UsuarioCrea;
    $this->FreACFT_Estado = $FreACFT_Estado;
    $this->tabla = "frecuencias_agrupaciones_configft";
  }

  function getFreACFT_Codigo() {
    return $this->FreACFT_Codigo;
  }

  function getAgrC_Codigo() {
    return $this->AgrC_Codigo;
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }

  function getFreACFT_Hora() {
    return $this->FreACFT_Hora;
  }

  function getFreACFT_FechaHoraCrea() {
    return $this->FreACFT_FechaHoraCrea;
  }

  function getFreACFT_UsuarioCrea() {
    return $this->FreACFT_UsuarioCrea;
  }

  function getFreACFT_Estado() {
    return $this->FreACFT_Estado;
  }

  function setFreACFT_Codigo($FreACFT_Codigo) {
    $this->FreACFT_Codigo = $FreACFT_Codigo;
  }

  function setAgrC_Codigo($AgrC_Codigo) {
    $this->AgrC_Codigo = $AgrC_Codigo;
  }

  function setTur_Codigo($Tur_Codigo) {
    $this->Tur_Codigo = $Tur_Codigo;
  }

  function setFreACFT_Hora($FreACFT_Hora) {
    $this->FreACFT_Hora = $FreACFT_Hora;
  }

  function setFreACFT_FechaHoraCrea($FreACFT_FechaHoraCrea) {
    $this->FreACFT_FechaHoraCrea = $FreACFT_FechaHoraCrea;
  }

  function setFreACFT_UsuarioCrea($FreACFT_UsuarioCrea) {
    $this->FreACFT_UsuarioCrea = $FreACFT_UsuarioCrea;
  }

  function setFreACFT_Estado($FreACFT_Estado) {
    $this->FreACFT_Estado = $FreACFT_Estado;
  }

  public function insertar(){
    $campos = array("AgrC_Codigo", "Tur_Codigo", "FreACFT_Hora", "FreACFT_FechaHoraCrea", "FreACFT_UsuarioCrea", "FreACFT_Estado");
    $valores = array(
    array(
      $this->AgrC_Codigo, 
      $this->Tur_Codigo, 
      $this->FreACFT_Hora, 
      $this->FreACFT_FechaHoraCrea, 
      $this->FreACFT_UsuarioCrea, 
      $this->FreACFT_Estado
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
    $sql =  "SELECT * FROM frecuencias_agrupaciones_configft WHERE FreACFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->FreACFT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAgrC_Codigo($res[1]);
      $this->setTur_Codigo($res[2]);
      $this->setFreACFT_Hora($res[3]);
      $this->setFreACFT_FechaHoraCrea($res[4]);
      $this->setFreACFT_UsuarioCrea($res[5]);
      $this->setFreACFT_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("AgrC_Codigo", "Tur_Codigo", "FreACFT_Hora", "FreACFT_FechaHoraCrea", "FreACFT_UsuarioCrea", "FreACFT_Estado");
    $valores = array($this->getAgrC_Codigo(), $this->getTur_Codigo(), $this->getFreACFT_Hora(), $this->getFreACFT_FechaHoraCrea(), $this->getFreACFT_UsuarioCrea(), $this->getFreACFT_Estado());
    $llaveprimaria = "FreACFT_Codigo";
    $valorllaveprimaria = $this->getFreACFT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM frecuencias_agrupaciones_configft WHERE FreACFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->FreACFT_Codigo);
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
  public function listarFrecuenciasConfFT($codAgrupacionCFT){

    $parametros = array(":cod"=>$codAgrupacionCFT);

    $sql = "SELECT FreACFT_Codigo, AgrC_Codigo, Tur_Codigo, FreACFT_Hora
    FROM frecuencias_agrupaciones_configft
    WHERE FreACFT_Estado = 1 AND AgrC_Codigo = :cod
    ORDER BY FreACFT_Hora ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
        /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarFrecuenciasConfFTActivoDesactivo($codAgrupacionCFT){

    $parametros = array(":cod"=>$codAgrupacionCFT);

    $sql = "SELECT FreACFT_Codigo, AgrC_Codigo, Tur_Codigo, FreACFT_Hora
    FROM frecuencias_agrupaciones_configft
    WHERE AgrC_Codigo = :cod
    ORDER BY FreACFT_Hora ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
  /*
    Autor: Dayanna Castano
    Fecha: 
    Descripción:
    Parámetros:
  */
  public function frecuenciasVariablesControlPorAreayMaquina($codigoPlanta){
      $parametros = array(":pla"=>$codigoPlanta);

    $sql = "SELECT DISTINCT agrupaciones_configft.AgrC_Nombre
    FROM frecuencias_agrupaciones_configft
    INNER JOIN agrupaciones_configft ON frecuencias_agrupaciones_configft.AgrC_Codigo= agrupaciones_configft.AgrC_Codigo AND AgrC_Estado= '1'
    INNER JOIN turnos ON frecuencias_agrupaciones_configft.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
    WHERE FreACFT_Estado= '1' AND turnos.Pla_Codigo = :pla
    ORDER BY agrupaciones_configft.AgrC_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  } 
    
  /*
    Autor: Dayanna 
    Fecha: 
    Descripción:
    Parámetros:
  */
  public function frecuenciasVariablesControlHorasPorAreayMaquina($codigoPlanta){
      $parametros = array(":pla"=>$codigoPlanta);

    $sql = "SELECT FreACFT_Codigo,agrupaciones_configft.AgrC_Nombre,
    frecuencias_agrupaciones_configft.Tur_Codigo, turnos.Tur_Nombre , FreACFT_Hora
    FROM frecuencias_agrupaciones_configft
    INNER JOIN agrupaciones_configft ON frecuencias_agrupaciones_configft.AgrC_Codigo= agrupaciones_configft.AgrC_Codigo AND AgrC_Estado= '1'
    INNER JOIN turnos ON frecuencias_agrupaciones_configft.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
    WHERE FreACFT_Estado= '1' AND turnos.Pla_Codigo = :pla
    ORDER BY agrupaciones_configft.AgrC_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  } 
}
?>
