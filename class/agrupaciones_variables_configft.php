<?php
require_once('basedatos.php');

  class agrupaciones_variables_configft extends basedatos {
    private $AgrVCon_Codigo;
    private $AgrM_Codigo;
    private $AgrC_Codigo;
    private $AgrVCon_FechaHoraCrea;
    private $AgrVCon_UsuarioCrea;
    private $AgrVCon_Estado;

  function __construct($AgrVCon_Codigo = NULL, $AgrM_Codigo = NULL, $AgrC_Codigo = NULL, $AgrVCon_FechaHoraCrea = NULL, $AgrVCon_UsuarioCrea = NULL, $AgrVCon_Estado = NULL) {
    $this->AgrVCon_Codigo = $AgrVCon_Codigo;
    $this->AgrM_Codigo = $AgrM_Codigo;
    $this->AgrC_Codigo = $AgrC_Codigo;
    $this->AgrVCon_FechaHoraCrea = $AgrVCon_FechaHoraCrea;
    $this->AgrVCon_UsuarioCrea = $AgrVCon_UsuarioCrea;
    $this->AgrVCon_Estado = $AgrVCon_Estado;
    $this->tabla = "agrupaciones_variables_configft";
  }

  function getAgrVCon_Codigo() {
    return $this->AgrVCon_Codigo;
  }

  function getAgrM_Codigo() {
    return $this->AgrM_Codigo;
  }

  function getAgrC_Codigo() {
    return $this->AgrC_Codigo;
  }

  function getAgrVCon_FechaHoraCrea() {
    return $this->AgrVCon_FechaHoraCrea;
  }

  function getAgrVCon_UsuarioCrea() {
    return $this->AgrVCon_UsuarioCrea;
  }

  function getAgrVCon_Estado() {
    return $this->AgrVCon_Estado;
  }

  function setAgrVCon_Codigo($AgrVCon_Codigo) {
    $this->AgrVCon_Codigo = $AgrVCon_Codigo;
  }

  function setAgrM_Codigo($AgrM_Codigo) {
    $this->AgrM_Codigo = $AgrM_Codigo;
  }

  function setAgrC_Codigo($AgrC_Codigo) {
    $this->AgrC_Codigo = $AgrC_Codigo;
  }

  function setAgrVCon_FechaHoraCrea($AgrVCon_FechaHoraCrea) {
    $this->AgrVCon_FechaHoraCrea = $AgrVCon_FechaHoraCrea;
  }

  function setAgrVCon_UsuarioCrea($AgrVCon_UsuarioCrea) {
    $this->AgrVCon_UsuarioCrea = $AgrVCon_UsuarioCrea;
  }

  function setAgrVCon_Estado($AgrVCon_Estado) {
    $this->AgrVCon_Estado = $AgrVCon_Estado;
  }

  public function insertar(){
    $campos = array("AgrM_Codigo", "AgrC_Codigo", "AgrVCon_FechaHoraCrea", "AgrVCon_UsuarioCrea", "AgrVCon_Estado");
    $valores = array(
    array(
      $this->AgrM_Codigo, 
      $this->AgrC_Codigo, 
      $this->AgrVCon_FechaHoraCrea, 
      $this->AgrVCon_UsuarioCrea, 
      $this->AgrVCon_Estado
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
    $sql =  "SELECT * FROM agrupaciones_variables_configft WHERE AgrVCon_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrVCon_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAgrM_Codigo($res[1]);
      $this->setAgrC_Codigo($res[2]);
      $this->setAgrVCon_FechaHoraCrea($res[3]);
      $this->setAgrVCon_UsuarioCrea($res[4]);
      $this->setAgrVCon_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("AgrM_Codigo", "AgrC_Codigo", "AgrVCon_FechaHoraCrea", "AgrVCon_UsuarioCrea", "AgrVCon_Estado");
    $valores = array($this->getAgrM_Codigo(), $this->getAgrC_Codigo(), $this->getAgrVCon_FechaHoraCrea(), $this->getAgrVCon_UsuarioCrea(), $this->getAgrVCon_Estado());
    $llaveprimaria = "AgrVCon_Codigo";
    $valorllaveprimaria = $this->getAgrVCon_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM agrupaciones_variables_configft WHERE AgrVCon_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrVCon_Codigo);
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
  public function listarAgrupacionesCreadas($codAgrM_Codigo){

    $parametros = array(":cod"=>$codAgrM_Codigo);

    $sql = "SELECT AgrC_Codigo
    FROM agrupaciones_variables_configft
    WHERE AgrVCon_Estado = 1 AND AgrM_Codigo = :cod";

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
  public function listarAgrupacionesTodas($codAgrM_Codigo){

    $parametros = array(":cod"=>$codAgrM_Codigo);

    $sql = "SELECT agrupaciones_variables_configft.AgrVCon_Codigo, agrupaciones_configft.AgrC_Nombre
    FROM agrupaciones_variables_configft
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = 1
    WHERE AgrVCon_Estado = 1 AND AgrM_Codigo = :cod";

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
  public function listarAgrupacionesFTTodas($fichaTecnica){
	  
	$parametros = array(":fic"=>$fichaTecnica);

    $sql = "SELECT DISTINCT agrupaciones_variables_configft.AgrM_Codigo, agrupaciones_variables_configft.AgrC_Codigo, agrupaciones_configft.AgrC_Nombre,    agrupaciones_configft.AgrC_Tipo, agrupaciones_configft.AgrC_UnidadMedida, parametros.Par_Nombre,
 agrupaciones_configft.AgrC_TomaVariable, agrupaciones_variables_configft.AgrVCon_Codigo, agrupaciones_configft.AgrC_Codigo, DetFT_ValorControlTexto, DetFT_ValorControl, DetFT_ValorTolerancia, DetFT_Operador, detalle_ficha_tecnica.DetFT_Codigo
    FROM agrupaciones_variables_configft    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo 
    AND AgrC_Estado = 1    INNER JOIN agrupaciones_maquinas ON agrupaciones_variables_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo 
    AND AgrM_Estado = 1    LEFT JOIN parametros ON agrupaciones_configft.AgrC_UnidadMedida = parametros.Par_Codigo AND Par_Estado = 1
 LEFT JOIN detalle_ficha_tecnica ON agrupaciones_variables_configft.AgrVCon_Codigo = detalle_ficha_tecnica.AgrVCon_Codigo AND FicT_Codigo = :fic AND DetFT_Estado = 1    WHERE AgrVCon_Estado = 1 
 GROUP BY agrupaciones_variables_configft.AgrM_Codigo, agrupaciones_variables_configft.AgrC_Codigo, DetFT_ValorControlTexto, DetFT_ValorControl, DetFT_ValorTolerancia, DetFT_Operador ORDER BY agrupaciones_configft.AgrC_Ordenamiento, agrupaciones_variables_configft.AgrM_Codigo, detalle_ficha_tecnica.DetFT_Codigo ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
