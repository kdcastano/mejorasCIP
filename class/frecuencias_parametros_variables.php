<?php
require_once('basedatos.php');

  class frecuencias_parametros_variables extends basedatos {
    private $FrePV_Codigo;
    private $ParV_Codigo;
    private $Tur_Codigo;
    private $FrePV_Hora;
    private $FrePV_FechaHoraCrea;
    private $FrePV_UsuarioCrea;
    private $FrePV_Estado;

  function __construct($FrePV_Codigo = NULL, $ParV_Codigo = NULL, $Tur_Codigo = NULL, $FrePV_Hora = NULL, $FrePV_FechaHoraCrea = NULL, $FrePV_UsuarioCrea = NULL, $FrePV_Estado = NULL) {
    $this->FrePV_Codigo = $FrePV_Codigo;
    $this->ParV_Codigo = $ParV_Codigo;
    $this->Tur_Codigo = $Tur_Codigo;
    $this->FrePV_Hora = $FrePV_Hora;
    $this->FrePV_FechaHoraCrea = $FrePV_FechaHoraCrea;
    $this->FrePV_UsuarioCrea = $FrePV_UsuarioCrea;
    $this->FrePV_Estado = $FrePV_Estado;
    $this->tabla = "frecuencias_parametros_variables";
  }

  function getFrePV_Codigo() {
    return $this->FrePV_Codigo;
  }

  function getParV_Codigo() {
    return $this->ParV_Codigo;
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }

  function getFrePV_Hora() {
    return $this->FrePV_Hora;
  }

  function getFrePV_FechaHoraCrea() {
    return $this->FrePV_FechaHoraCrea;
  }

  function getFrePV_UsuarioCrea() {
    return $this->FrePV_UsuarioCrea;
  }

  function getFrePV_Estado() {
    return $this->FrePV_Estado;
  }

  function setFrePV_Codigo($FrePV_Codigo) {
    $this->FrePV_Codigo = $FrePV_Codigo;
  }

  function setParV_Codigo($ParV_Codigo) {
    $this->ParV_Codigo = $ParV_Codigo;
  }

  function setTur_Codigo($Tur_Codigo) {
    $this->Tur_Codigo = $Tur_Codigo;
  }

  function setFrePV_Hora($FrePV_Hora) {
    $this->FrePV_Hora = $FrePV_Hora;
  }

  function setFrePV_FechaHoraCrea($FrePV_FechaHoraCrea) {
    $this->FrePV_FechaHoraCrea = $FrePV_FechaHoraCrea;
  }

  function setFrePV_UsuarioCrea($FrePV_UsuarioCrea) {
    $this->FrePV_UsuarioCrea = $FrePV_UsuarioCrea;
  }

  function setFrePV_Estado($FrePV_Estado) {
    $this->FrePV_Estado = $FrePV_Estado;
  }

  public function insertar(){
    $campos = array("ParV_Codigo", "Tur_Codigo", "FrePV_Hora", "FrePV_FechaHoraCrea", "FrePV_UsuarioCrea", "FrePV_Estado");
    $valores = array(
    array( 
      $this->ParV_Codigo, 
      $this->Tur_Codigo, 
      $this->FrePV_Hora, 
      $this->FrePV_FechaHoraCrea, 
      $this->FrePV_UsuarioCrea, 
      $this->FrePV_Estado
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
    $sql =  "SELECT * FROM frecuencias_parametros_variables WHERE FrePV_Codigo = :cod";
    $parametros = array(":cod"=>$this->FrePV_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setParV_Codigo($res[1]);
      $this->setTur_Codigo($res[2]);
      $this->setFrePV_Hora($res[3]);
      $this->setFrePV_FechaHoraCrea($res[4]);
      $this->setFrePV_UsuarioCrea($res[5]);
      $this->setFrePV_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("ParV_Codigo", "Tur_Codigo", "FrePV_Hora", "FrePV_FechaHoraCrea", "FrePV_UsuarioCrea", "FrePV_Estado");
    $valores = array($this->getParV_Codigo(), $this->getTur_Codigo(), $this->getFrePV_Hora(), $this->getFrePV_FechaHoraCrea(), $this->getFrePV_UsuarioCrea(), $this->getFrePV_Estado());
    $llaveprimaria = "FrePV_Codigo";
    $valorllaveprimaria = $this->getFrePV_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM frecuencias_parametros_variables WHERE FrePV_Codigo = :cod";
    $parametros = array(":cod"=>$this->FrePV_Codigo);
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
  public function frecuenciasParametros($codParametro){

    $parametros = array(":cod"=>$codParametro);

    $sql = "SELECT max(fp.FrePV_Codigo), ParV_Codigo, Tur_Codigo, fp.FrePV_Hora,
    (SELECT fp2.FrePV_Estado
    FROM frecuencias_parametros_variables fp2
    WHERE max(fp.FrePV_Codigo) = fp2.FrePV_Codigo) AS estado
    FROM frecuencias_parametros_variables fp
    WHERE ParV_Codigo = :cod
    group by ParV_Codigo, Tur_Codigo, fp.FrePV_Hora
    ORDER BY Tur_Codigo,fp.FrePV_Codigo desc, fp.FrePV_Hora asc";

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
  public function frecuenciasParametrosActivosInactivos($codParametro){

    $parametros = array(":cod"=>$codParametro);

    $sql = "SELECT FrePV_Codigo, ParV_Codigo, Tur_Codigo, FrePV_Hora
    FROM frecuencias_parametros_variables
    WHERE ParV_Codigo = :cod
    ORDER BY FrePV_Hora ASC";

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
  public function frecuenciasParametrosVariablesPorAreayMaquina($codigoPlanta){
      $parametros = array(":pla"=>$codigoPlanta);

    $sql = "SELECT DISTINCT areas.Are_Codigo , Are_Nombre, maquinas.Maq_Codigo, Maq_Nombre,
    parametros_variables.ParV_Nombre, formatos.For_Codigo, formatos.For_Nombre
    FROM frecuencias_parametros_variables
    INNER JOIN parametros_variables ON frecuencias_parametros_variables.ParV_Codigo = parametros_variables.ParV_Codigo AND ParV_Estado = '1'
    INNER JOIN formatos ON parametros_variables.For_Codigo = formatos.For_Codigo AND For_Estado = '1'
    INNER JOIN turnos ON frecuencias_parametros_variables.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
    INNER JOIN maquinas ON parametros_variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE FrePV_Estado = '1' AND turnos.Pla_Codigo = :pla 
    ORDER BY formatos.For_Codigo ASC";

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
  public function frecuenciasParametrosVariablesHorasPorAreayMaquina($codigoPlanta){
    
    $parametros = array(":pla"=>$codigoPlanta);

    $sql = "SELECT areas.Are_Codigo , Are_Nombre, maquinas.Maq_Codigo, Maq_Nombre, frecuencias_parametros_variables.FrePV_Codigo,
    parametros_variables.ParV_Nombre, frecuencias_parametros_variables.Tur_Codigo, turnos.Tur_Nombre , FrePV_Hora, formatos.For_Codigo, formatos.For_Nombre
    FROM frecuencias_parametros_variables
    INNER JOIN parametros_variables ON frecuencias_parametros_variables.ParV_Codigo = parametros_variables.ParV_Codigo AND ParV_Estado = '1'
    INNER JOIN formatos ON parametros_variables.For_Codigo = formatos.For_Codigo AND For_Estado = '1'
    INNER JOIN turnos ON frecuencias_parametros_variables.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
    INNER JOIN maquinas ON parametros_variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE FrePV_Estado = '1' AND turnos.Pla_Codigo = :pla
    ORDER BY frecuencias_parametros_variables.ParV_Codigo ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
