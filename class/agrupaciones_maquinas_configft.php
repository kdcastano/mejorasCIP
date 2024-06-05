<?php
require_once('basedatos.php');

  class agrupaciones_maquinas_configft extends basedatos {
    private $AgrMCon_Codigo;
    private $AgrM_Codigo;
    private $Maq_Codigo;
    private $AgrMCon_FechaHoraCrea;
    private $AgrMCon_UsuarioCrea;
    private $AgrMCon_Estado;

  function __construct($AgrMCon_Codigo = NULL, $AgrM_Codigo = NULL, $Maq_Codigo = NULL, $AgrMCon_FechaHoraCrea = NULL, $AgrMCon_UsuarioCrea = NULL, $AgrMCon_Estado = NULL) {
    $this->AgrMCon_Codigo = $AgrMCon_Codigo;
    $this->AgrM_Codigo = $AgrM_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->AgrMCon_FechaHoraCrea = $AgrMCon_FechaHoraCrea;
    $this->AgrMCon_UsuarioCrea = $AgrMCon_UsuarioCrea;
    $this->AgrMCon_Estado = $AgrMCon_Estado;
    $this->tabla = "agrupaciones_maquinas_configft";
  }

  function getAgrMCon_Codigo() {
    return $this->AgrMCon_Codigo;
  }

  function getAgrM_Codigo() {
    return $this->AgrM_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getAgrMCon_FechaHoraCrea() {
    return $this->AgrMCon_FechaHoraCrea;
  }

  function getAgrMCon_UsuarioCrea() {
    return $this->AgrMCon_UsuarioCrea;
  }

  function getAgrMCon_Estado() {
    return $this->AgrMCon_Estado;
  }

  function setAgrMCon_Codigo($AgrMCon_Codigo) {
    $this->AgrMCon_Codigo = $AgrMCon_Codigo;
  }

  function setAgrM_Codigo($AgrM_Codigo) {
    $this->AgrM_Codigo = $AgrM_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setAgrMCon_FechaHoraCrea($AgrMCon_FechaHoraCrea) {
    $this->AgrMCon_FechaHoraCrea = $AgrMCon_FechaHoraCrea;
  }

  function setAgrMCon_UsuarioCrea($AgrMCon_UsuarioCrea) {
    $this->AgrMCon_UsuarioCrea = $AgrMCon_UsuarioCrea;
  }

  function setAgrMCon_Estado($AgrMCon_Estado) {
    $this->AgrMCon_Estado = $AgrMCon_Estado;
  }

  public function insertar(){
    $campos = array("AgrM_Codigo", "Maq_Codigo", "AgrMCon_FechaHoraCrea", "AgrMCon_UsuarioCrea", "AgrMCon_Estado");
    $valores = array(
    array( 
      $this->AgrM_Codigo, 
      $this->Maq_Codigo, 
      $this->AgrMCon_FechaHoraCrea, 
      $this->AgrMCon_UsuarioCrea, 
      $this->AgrMCon_Estado
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
    $sql =  "SELECT * FROM agrupaciones_maquinas_configft WHERE AgrMCon_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrMCon_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAgrM_Codigo($res[1]);
      $this->setMaq_Codigo($res[2]);
      $this->setAgrMCon_FechaHoraCrea($res[3]);
      $this->setAgrMCon_UsuarioCrea($res[4]);
      $this->setAgrMCon_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("AgrM_Codigo", "Maq_Codigo", "AgrMCon_FechaHoraCrea", "AgrMCon_UsuarioCrea", "AgrMCon_Estado");
    $valores = array($this->getAgrM_Codigo(), $this->getMaq_Codigo(), $this->getAgrMCon_FechaHoraCrea(), $this->getAgrMCon_UsuarioCrea(), $this->getAgrMCon_Estado());
    $llaveprimaria = "AgrMCon_Codigo";
    $valorllaveprimaria = $this->getAgrMCon_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM agrupaciones_maquinas_configft WHERE AgrMCon_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrMCon_Codigo);
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
  public function listarMaquinasExistentes($codigo){

    $parametros = array(":cod"=>$codigo);

    $sql = "SELECT Maq_Codigo
    FROM agrupaciones_maquinas_configft
    WHERE AgrMCon_Estado = 1 AND AgrM_Codigo = :cod";

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
  public function listarMaquinasAgrupacionM($codigo){

    $parametros = array(":cod"=>$codigo);

    $sql = "SELECT AgrMCon_Codigo, maquinas.Maq_Nombre
    FROM agrupaciones_maquinas_configft
    INNER JOIN maquinas ON agrupaciones_maquinas_configft.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE AgrMCon_Estado = 1 AND agrupaciones_maquinas_configft.AgrM_Codigo = :cod";

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
  public function buscarCodigoAgrupacionMaquinaCFT($maquina, $agrupacion){

    $parametros = array(":maq"=>$maquina, ":agr"=>$agrupacion);

    $sql = "SELECT AgrMCon_Codigo
    FROM agrupaciones_maquinas_configft
    WHERE AgrM_Codigo = :agr AND Maq_Codigo = :maq AND AgrMCon_Estado = '1'
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: Dayanna Castaño
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function selectEquiposFTMultiple($tipo,$formato){

    $parametros = array(":for"=>$formato);

    $sql = "SELECT agrupaciones_maquinas_configft.AgrM_Codigo, agrupaciones_maquinas_configft.Maq_Codigo, areas.Are_Nombre, Maq_Nombre     
    FROM agrupaciones_maquinas_configft 
    INNER JOIN maquinas ON agrupaciones_maquinas_configft.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = '1' 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado= '1' 
    INNER JOIN formatos_areas ON areas.Are_Codigo = formatos_areas.Are_Codigo AND ForA_Estado = '1' 
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo 
    AND AgrM_Estado = '1' WHERE AgrMCon_Estado = '1' AND formatos_areas.For_Codigo = :for";
    
    if($tipo == "2"){
      $sql .= " AND AgrM_Tipo IN (2,3)";
    }else{
      $sql .= " AND AgrM_Tipo = :tip ";
      $parametros[':tip'] = $tipo;
    }

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
  public function buscarAgrupacionMaq($maquina){

    $parametros = array(":maq"=>$maquina);

    $sql = "SELECT AgrM_Codigo
    FROM agrupaciones_maquinas_configft
    WHERE Maq_Codigo = :maq AND AgrMCon_Estado = '1'
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
