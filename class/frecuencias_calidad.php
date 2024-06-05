<?php
require_once('basedatos.php');

  class frecuencias_calidad extends basedatos {
    private $FreC_Codigo;
    private $Tur_Codigo;
    private $Cal_Codigo;
    private $FreC_Hora;
    private $FreC_FechaHoraCrea;
    private $FreC_UsuarioCrea;
    private $FreC_Estado;

  function __construct($FreC_Codigo = NULL, $Tur_Codigo = NULL, $Cal_Codigo = NULL, $FreC_Hora = NULL, $FreC_FechaHoraCrea = NULL, $FreC_UsuarioCrea = NULL, $FreC_Estado = NULL) {
    $this->FreC_Codigo = $FreC_Codigo;
    $this->Tur_Codigo = $Tur_Codigo;
    $this->Cal_Codigo = $Cal_Codigo;
    $this->FreC_Hora = $FreC_Hora;
    $this->FreC_FechaHoraCrea = $FreC_FechaHoraCrea;
    $this->FreC_UsuarioCrea = $FreC_UsuarioCrea;
    $this->FreC_Estado = $FreC_Estado;
    $this->tabla = "frecuencias_calidad";
  }

  function getFreC_Codigo() {
    return $this->FreC_Codigo;
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }

  function getCal_Codigo() {
    return $this->Cal_Codigo;
  }

  function getFreC_Hora() {
    return $this->FreC_Hora;
  }

  function getFreC_FechaHoraCrea() {
    return $this->FreC_FechaHoraCrea;
  }

  function getFreC_UsuarioCrea() {
    return $this->FreC_UsuarioCrea;
  }

  function getFreC_Estado() {
    return $this->FreC_Estado;
  }

  function setFreC_Codigo($FreC_Codigo) {
    $this->FreC_Codigo = $FreC_Codigo;
  }

  function setTur_Codigo($Tur_Codigo) {
    $this->Tur_Codigo = $Tur_Codigo;
  }

  function setCal_Codigo($Cal_Codigo) {
    $this->Cal_Codigo = $Cal_Codigo;
  }

  function setFreC_Hora($FreC_Hora) {
    $this->FreC_Hora = $FreC_Hora;
  }

  function setFreC_FechaHoraCrea($FreC_FechaHoraCrea) {
    $this->FreC_FechaHoraCrea = $FreC_FechaHoraCrea;
  }

  function setFreC_UsuarioCrea($FreC_UsuarioCrea) {
    $this->FreC_UsuarioCrea = $FreC_UsuarioCrea;
  }

  function setFreC_Estado($FreC_Estado) {
    $this->FreC_Estado = $FreC_Estado;
  }

  public function insertar(){
    $campos = array("Tur_Codigo", "Cal_Codigo", "FreC_Hora", "FreC_FechaHoraCrea", "FreC_UsuarioCrea", "FreC_Estado");
    $valores = array(
    array( 
      $this->Tur_Codigo, 
      $this->Cal_Codigo, 
      $this->FreC_Hora, 
      $this->FreC_FechaHoraCrea, 
      $this->FreC_UsuarioCrea, 
      $this->FreC_Estado
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
    $sql =  "SELECT * FROM frecuencias_calidad WHERE FreC_Codigo = :cod";
    $parametros = array(":cod"=>$this->FreC_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setTur_Codigo($res[1]);
      $this->setCal_Codigo($res[2]);
      $this->setFreC_Hora($res[3]);
      $this->setFreC_FechaHoraCrea($res[4]);
      $this->setFreC_UsuarioCrea($res[5]);
      $this->setFreC_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Tur_Codigo", "Cal_Codigo", "FreC_Hora", "FreC_FechaHoraCrea", "FreC_UsuarioCrea", "FreC_Estado");
    $valores = array($this->getTur_Codigo(), $this->getCal_Codigo(), $this->getFreC_Hora(), $this->getFreC_FechaHoraCrea(), $this->getFreC_UsuarioCrea(), $this->getFreC_Estado());
    $llaveprimaria = "FreC_Codigo";
    $valorllaveprimaria = $this->getFreC_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM frecuencias_calidad WHERE FreC_Codigo = :cod";
    $parametros = array(":cod"=>$this->FreC_Codigo);
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
  public function listarFrecuenciasEstadoActivoInactivo($codigo){

    $parametros = array(":cod"=>$codigo);

    $sql = "SELECT FreC_Codigo, Cal_Codigo, Tur_Codigo, FreC_Hora
    FROM frecuencias_calidad
    WHERE Cal_Codigo = :cod
    ORDER BY FreC_Hora ASC";

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
  public function listarFrecuencias($codigo){

    $parametros = array(":cod"=>$codigo);

    $sql = "SELECT FreC_Codigo, Cal_Codigo, Tur_Codigo, FreC_Hora
    FROM frecuencias_calidad
    WHERE Cal_Codigo = :cod AND FreC_Estado = 1
    ORDER BY FreC_Hora ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
    /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarFrecuenciasCalidadPanelOperador($planta, $area){

    $parametros = array(":pla"=>$planta, ":are"=>$area);

    $sql = "SELECT frecuencias_calidad.Cal_Codigo, FreC_Hora
    FROM frecuencias_calidad
    INNER JOIN calidad ON frecuencias_calidad.Cal_Codigo = calidad.Cal_Codigo AND calidad.Cal_Estado = 1
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    WHERE frecuencias_calidad.FreC_Estado = 1 AND areas.Pla_Codigo = :pla AND areas.Are_Codigo = :are";

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
  public function frecuenciasVariablesCalidadPorAreayMaquina($codigoPlanta){
    $parametros = array(":pla"=>$codigoPlanta);

    $sql = "SELECT DISTINCT areas.Are_Codigo , Are_Nombre, calidad.Cal_Nombre
    FROM frecuencias_calidad
    INNER JOIN calidad ON frecuencias_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado= '1'
    INNER JOIN turnos ON frecuencias_calidad.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE FreC_Estado= '1' AND turnos.Pla_Codigo = :pla
    ORDER BY frecuencias_calidad.FreC_Codigo ASC";

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
  public function frecuenciasVariablesCalidadHorasPorAreayMaquina($codigoPlanta){
    $parametros = array(":pla"=>$codigoPlanta);

    $sql = "SELECT areas.Are_Codigo , Are_Nombre, frecuencias_calidad.FreC_Codigo,
    calidad.Cal_Nombre, frecuencias_calidad.Tur_Codigo, turnos.Tur_Nombre , FreC_Hora
    FROM frecuencias_calidad
    INNER JOIN calidad ON frecuencias_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado= '1'
    INNER JOIN turnos ON frecuencias_calidad.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE FreC_Estado= '1' AND turnos.Pla_Codigo = :pla
    ORDER BY frecuencias_calidad.FreC_Codigo ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
