<?php
require_once('basedatos.php');

  class frecuencias_configuracion_ficha_tecnica extends basedatos {
    private $FreCFT_Codigo;
    private $ConFT_Codigo;
    private $Tur_Codigo;
    private $FreCFT_Hora;
    private $FreCFT_FechaHoraCrea;
    private $FreCFT_UsuarioCrea;
    private $FreCFT_Estado;

  function __construct($FreCFT_Codigo = NULL, $ConFT_Codigo = NULL, $Tur_Codigo = NULL, $FreCFT_Hora = NULL, $FreCFT_FechaHoraCrea = NULL, $FreCFT_UsuarioCrea = NULL, $FreCFT_Estado = NULL) {
    $this->FreCFT_Codigo = $FreCFT_Codigo;
    $this->ConFT_Codigo = $ConFT_Codigo;
    $this->Tur_Codigo = $Tur_Codigo;
    $this->FreCFT_Hora = $FreCFT_Hora;
    $this->FreCFT_FechaHoraCrea = $FreCFT_FechaHoraCrea;
    $this->FreCFT_UsuarioCrea = $FreCFT_UsuarioCrea;
    $this->FreCFT_Estado = $FreCFT_Estado;
    $this->tabla = "frecuencias_configuracion_ficha_tecnica";
  }

  function getFreCFT_Codigo() {
    return $this->FreCFT_Codigo;
  }

  function getConFT_Codigo() {
    return $this->ConFT_Codigo;
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }

  function getFreCFT_Hora() {
    return $this->FreCFT_Hora;
  }

  function getFreCFT_FechaHoraCrea() {
    return $this->FreCFT_FechaHoraCrea;
  }

  function getFreCFT_UsuarioCrea() {
    return $this->FreCFT_UsuarioCrea;
  }

  function getFreCFT_Estado() {
    return $this->FreCFT_Estado;
  }

  function setFreCFT_Codigo($FreCFT_Codigo) {
    $this->FreCFT_Codigo = $FreCFT_Codigo;
  }

  function setConFT_Codigo($ConFT_Codigo) {
    $this->ConFT_Codigo = $ConFT_Codigo;
  }

  function setTur_Codigo($Tur_Codigo) {
    $this->Tur_Codigo = $Tur_Codigo;
  }

  function setFreCFT_Hora($FreCFT_Hora) {
    $this->FreCFT_Hora = $FreCFT_Hora;
  }

  function setFreCFT_FechaHoraCrea($FreCFT_FechaHoraCrea) {
    $this->FreCFT_FechaHoraCrea = $FreCFT_FechaHoraCrea;
  }

  function setFreCFT_UsuarioCrea($FreCFT_UsuarioCrea) {
    $this->FreCFT_UsuarioCrea = $FreCFT_UsuarioCrea;
  }

  function setFreCFT_Estado($FreCFT_Estado) {
    $this->FreCFT_Estado = $FreCFT_Estado;
  }

  public function insertar(){
    $campos = array("ConFT_Codigo", "Tur_Codigo", "FreCFT_Hora", "FreCFT_FechaHoraCrea", "FreCFT_UsuarioCrea", "FreCFT_Estado");
    $valores = array(
    array( 
      $this->ConFT_Codigo, 
      $this->Tur_Codigo, 
      $this->FreCFT_Hora, 
      $this->FreCFT_FechaHoraCrea, 
      $this->FreCFT_UsuarioCrea, 
      $this->FreCFT_Estado
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
    $sql =  "SELECT * FROM frecuencias_configuracion_ficha_tecnica WHERE FreCFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->FreCFT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setConFT_Codigo($res[1]);
      $this->setTur_Codigo($res[2]);
      $this->setFreCFT_Hora($res[3]);
      $this->setFreCFT_FechaHoraCrea($res[4]);
      $this->setFreCFT_UsuarioCrea($res[5]);
      $this->setFreCFT_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("ConFT_Codigo", "Tur_Codigo", "FreCFT_Hora", "FreCFT_FechaHoraCrea", "FreCFT_UsuarioCrea", "FreCFT_Estado");
    $valores = array($this->getConFT_Codigo(), $this->getTur_Codigo(), $this->getFreCFT_Hora(), $this->getFreCFT_FechaHoraCrea(), $this->getFreCFT_UsuarioCrea(), $this->getFreCFT_Estado());
    $llaveprimaria = "FreCFT_Codigo";
    $valorllaveprimaria = $this->getFreCFT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM frecuencias_configuracion_ficha_tecnica WHERE FreCFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->FreCFT_Codigo);
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
  public function listarFrecuenciasConfFT($codConfigFT){

    $parametros = array(":cod"=>$codConfigFT);

    $sql = "SELECT FreCFT_Codigo, ConFT_Codigo, Tur_Codigo, FreCFT_Hora
    FROM frecuencias_configuracion_ficha_tecnica
    WHERE FreCFT_Estado = 1 AND ConFT_Codigo = :cod
    ORDER BY FreCFT_Hora ASC";

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
  public function listarFrecuenciasConfFTActivoDesactivo($codConfigFT){

    $parametros = array(":cod"=>$codConfigFT);

    $sql = "SELECT FreCFT_Codigo, ConFT_Codigo, Tur_Codigo, FreCFT_Hora
    FROM frecuencias_configuracion_ficha_tecnica
    WHERE ConFT_Codigo = :cod
    ORDER BY FreCFT_Hora ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
