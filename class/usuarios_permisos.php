<?php
require_once('basedatos.php');

  class usuarios_permisos extends basedatos {
    private $UsuP_Codigo;
    private $Per_Codigo;
    private $Usu_Codigo;
    private $UsuP_Ver;
    private $UsuP_Crear;
    private $UsuP_Modificar;
    private $UsuP_Eliminar;
    private $UsuP_FechaHoraCrea;
    private $UsuP_UsuarioCrea;
    private $UsuP_Estado;

  function __construct($UsuP_Codigo = NULL, $Per_Codigo = NULL, $Usu_Codigo = NULL, $UsuP_Ver = NULL, $UsuP_Crear = NULL, $UsuP_Modificar = NULL, $UsuP_Eliminar = NULL, $UsuP_FechaHoraCrea = NULL, $UsuP_UsuarioCrea = NULL, $UsuP_Estado = NULL) {
    $this->UsuP_Codigo = $UsuP_Codigo;
    $this->Per_Codigo = $Per_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->UsuP_Ver = $UsuP_Ver;
    $this->UsuP_Crear = $UsuP_Crear;
    $this->UsuP_Modificar = $UsuP_Modificar;
    $this->UsuP_Eliminar = $UsuP_Eliminar;
    $this->UsuP_FechaHoraCrea = $UsuP_FechaHoraCrea;
    $this->UsuP_UsuarioCrea = $UsuP_UsuarioCrea;
    $this->UsuP_Estado = $UsuP_Estado;
    $this->tabla = "usuarios_permisos";
  }

  function getUsuP_Codigo() {
    return $this->UsuP_Codigo;
  }

  function getPer_Codigo() {
    return $this->Per_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getUsuP_Ver() {
    return $this->UsuP_Ver;
  }

  function getUsuP_Crear() {
    return $this->UsuP_Crear;
  }

  function getUsuP_Modificar() {
    return $this->UsuP_Modificar;
  }

  function getUsuP_Eliminar() {
    return $this->UsuP_Eliminar;
  }

  function getUsuP_FechaHoraCrea() {
    return $this->UsuP_FechaHoraCrea;
  }

  function getUsuP_UsuarioCrea() {
    return $this->UsuP_UsuarioCrea;
  }

  function getUsuP_Estado() {
    return $this->UsuP_Estado;
  }

  function setUsuP_Codigo($UsuP_Codigo) {
    $this->UsuP_Codigo = $UsuP_Codigo;
  }

  function setPer_Codigo($Per_Codigo) {
    $this->Per_Codigo = $Per_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setUsuP_Ver($UsuP_Ver) {
    $this->UsuP_Ver = $UsuP_Ver;
  }

  function setUsuP_Crear($UsuP_Crear) {
    $this->UsuP_Crear = $UsuP_Crear;
  }

  function setUsuP_Modificar($UsuP_Modificar) {
    $this->UsuP_Modificar = $UsuP_Modificar;
  }

  function setUsuP_Eliminar($UsuP_Eliminar) {
    $this->UsuP_Eliminar = $UsuP_Eliminar;
  }

  function setUsuP_FechaHoraCrea($UsuP_FechaHoraCrea) {
    $this->UsuP_FechaHoraCrea = $UsuP_FechaHoraCrea;
  }

  function setUsuP_UsuarioCrea($UsuP_UsuarioCrea) {
    $this->UsuP_UsuarioCrea = $UsuP_UsuarioCrea;
  }

  function setUsuP_Estado($UsuP_Estado) {
    $this->UsuP_Estado = $UsuP_Estado;
  }

  public function insertar(){
    $campos = array("Per_Codigo", "Usu_Codigo", "UsuP_Ver", "UsuP_Crear", "UsuP_Modificar", "UsuP_Eliminar", "UsuP_FechaHoraCrea", "UsuP_UsuarioCrea", "UsuP_Estado");
    $valores = array(
    array(
      $this->Per_Codigo, 
      $this->Usu_Codigo, 
      $this->UsuP_Ver, 
      $this->UsuP_Crear, 
      $this->UsuP_Modificar, 
      $this->UsuP_Eliminar, 
      $this->UsuP_FechaHoraCrea, 
      $this->UsuP_UsuarioCrea, 
      $this->UsuP_Estado
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
    $sql =  "SELECT * FROM usuarios_permisos WHERE UsuP_Codigo = :cod";
    $parametros = array(":cod"=>$this->UsuP_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPer_Codigo($res[1]);
      $this->setUsu_Codigo($res[2]);
      $this->setUsuP_Ver($res[3]);
      $this->setUsuP_Crear($res[4]);
      $this->setUsuP_Modificar($res[5]);
      $this->setUsuP_Eliminar($res[6]);
      $this->setUsuP_FechaHoraCrea($res[7]);
      $this->setUsuP_UsuarioCrea($res[8]);
      $this->setUsuP_Estado($res[9]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Per_Codigo", "Usu_Codigo", "UsuP_Ver", "UsuP_Crear", "UsuP_Modificar", "UsuP_Eliminar", "UsuP_FechaHoraCrea", "UsuP_UsuarioCrea", "UsuP_Estado");
    $valores = array($this->getPer_Codigo(), $this->getUsu_Codigo(), $this->getUsuP_Ver(), $this->getUsuP_Crear(), $this->getUsuP_Modificar(), $this->getUsuP_Eliminar(), $this->getUsuP_FechaHoraCrea(), $this->getUsuP_UsuarioCrea(), $this->getUsuP_Estado());
    $llaveprimaria = "UsuP_Codigo";
    $valorllaveprimaria = $this->getUsuP_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM usuarios_permisos WHERE UsuP_Codigo = :cod";
    $parametros = array(":cod"=>$this->UsuP_Codigo);
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
  public function Permisos($usuario, $permiso){

    $parametros = array(":usu"=>$usuario, ":per"=>$permiso);

    $sql = "SELECT usuarios_permisos.Per_Codigo, permisos.Per_Modulo, usuarios_permisos.Usu_Codigo, usuarios_permisos.UsuP_Ver, usuarios_permisos.UsuP_Crear,
    usuarios_permisos.UsuP_Modificar, usuarios_permisos.UsuP_Eliminar
    FROM usuarios_permisos
    INNER JOIN permisos ON usuarios_permisos.Per_Codigo = permisos.Per_Codigo AND permisos.Per_Estado = 1
    WHERE usuarios_permisos.Usu_Codigo = :usu AND permisos.Per_Codigo = :per LIMIT 1";
	
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
