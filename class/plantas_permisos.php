<?php
require_once('basedatos.php');

  class plantas_permisos extends basedatos {
    private $PlaP_Codigo;
    private $Par_Codigo;
    private $Pla_Codigo;
    private $PlaP_Agrupacion;
    private $PlaP_SubAgrupacion;
    private $PlaP_URL;
    private $PlaP_Orden;
    private $PlaP_Estado;

  function __construct($PlaP_Codigo = NULL, $Par_Codigo = NULL, $Pla_Codigo = NULL, $PlaP_Agrupacion = NULL, $PlaP_SubAgrupacion = NULL, $PlaP_URL = NULL, $PlaP_Orden = NULL, $PlaP_Estado = NULL) {
    $this->PlaP_Codigo = $PlaP_Codigo;
    $this->Par_Codigo = $Par_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->PlaP_Agrupacion = $PlaP_Agrupacion;
    $this->PlaP_SubAgrupacion = $PlaP_SubAgrupacion;
    $this->PlaP_URL = $PlaP_URL;
    $this->PlaP_Estado = $PlaP_Estado;
    $this->tabla = "plantas_permisos";
  }

  function getPlaP_Codigo() {
    return $this->PlaP_Codigo;
  }

  function getPar_Codigo() {
    return $this->Par_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getPlaP_Agrupacion() {
    return $this->PlaP_Agrupacion;
  }

  function getPlaP_SubAgrupacion() {
    return $this->PlaP_SubAgrupacion;
  }
   
  function getPlaP_URL() {
    return $this->PlaP_URL;
  }
    
  function getPlaP_Orden() {
    return $this->PlaP_Orden;
  }

  function getPlaP_Estado() {
    return $this->PlaP_Estado;
  }

  function setPlaP_Codigo($PlaP_Codigo) {
    $this->PlaP_Codigo = $PlaP_Codigo;
  }

  function setPar_Codigo($Par_Codigo) {
    $this->Par_Codigo = $Par_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setPlaP_Agrupacion($PlaP_Agrupacion) {
    $this->PlaP_Agrupacion = $PlaP_Agrupacion;
  }

  function setPlaP_SubAgrupacion($PlaP_SubAgrupacion) {
    $this->PlaP_SubAgrupacion = $PlaP_SubAgrupacion;
  }
    
  function setPlaP_URL($PlaP_URL) {
    $this->PlaP_URL = $PlaP_URL;
  }
   
  function setPlaP_Orden($PlaP_Orden) {
    $this->PlaP_Orden = $PlaP_Orden;
  }

  function setPlaP_Estado($PlaP_Estado) {
    $this->PlaP_Estado = $PlaP_Estado;
  }

  public function insertar(){
    $campos = array("Par_Codigo", "Pla_Codigo", "PlaP_Agrupacion", "PlaP_SubAgrupacion", "PlaP_URL", "PlaP_Orden", "PlaP_Estado");
    $valores = array(
    array(
      $this->Par_Codigo, 
      $this->Pla_Codigo, 
      $this->PlaP_Agrupacion, 
      $this->PlaP_SubAgrupacion, 
      $this->PlaP_URL, 
      $this->PlaP_Orden, 
      $this->PlaP_Estado
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
    $sql =  "SELECT * FROM plantas_permisos WHERE PlaP_Codigo = :cod";
    $parametros = array(":cod"=>$this->PlaP_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPar_Codigo($res[1]);
      $this->setPla_Codigo($res[2]);
      $this->setPlaP_Agrupacion($res[3]);
      $this->setPlaP_SubAgrupacion($res[4]);
      $this->setPlaP_URL($res[5]);
      $this->setPlaP_Orden($res[6]);
      $this->setPlaP_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Par_Codigo", "Pla_Codigo", "PlaP_Agrupacion", "PlaP_SubAgrupacion", "PlaP_URL", "PlaP_Orden", "PlaP_Estado");
    $valores = array($this->getPar_Codigo(), $this->getPla_Codigo(), $this->getPlaP_Agrupacion(), $this->getPlaP_SubAgrupacion(), $this->getPlaP_URL(), $this->getPlaP_Orden(), $this->getPlaP_Estado());
    $llaveprimaria = "PlaP_Codigo";
    $valorllaveprimaria = $this->getPlaP_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM plantas_permisos WHERE PlaP_Codigo = :cod";
    $parametros = array(":cod"=>$this->PlaP_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: RxDavid
  Fecha: 
  Descripción: Se le envia la agrupación para listar las subagrupaciones y los modulos de cada uno
  Parámetros:
  */
  public function listarMenuAgrupaciones($planta){

    $parametros = array(":pla"=>$planta);
    
    $sql = "SELECT PlaP_Agrupacion, PlaP_SubAgrupacion, Per_Modulo, PlaP_URL, plantas_permisos.Per_Codigo
    FROM plantas_permisos
    INNER JOIN permisos ON plantas_permisos.Per_Codigo = permisos.Per_Codigo
    WHERE PlaP_Estado = 1 AND plantas_permisos.Pla_Codigo = :pla
    ORDER BY PlaP_Orden ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>