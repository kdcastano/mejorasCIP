<?php
require_once('basedatos.php');

  class puesta_puntos_aprobaciones extends basedatos {
    private $PuePA_Codigo;
    private $PueP_Codigo;
    private $Usu_Codigo;
    private $PuePA_FechaAprobacion;
    private $PuePA_HoraAprobacion;
    private $PuePA_Observacion;
    private $PuePA_EstadoAprobacion;
    private $PuePA_Aprobador;
    private $PuePA_Estado;

  function __construct($PuePA_Codigo = NULL, $PueP_Codigo = NULL, $Usu_Codigo = NULL, $PuePA_FechaAprobacion = NULL, $PuePA_HoraAprobacion = NULL, $PuePA_Observacion = NULL, $PuePA_EstadoAprobacion = NULL, $PuePA_Aprobador = NULL, $PuePA_Estado = NULL) {
    $this->PuePA_Codigo = $PuePA_Codigo;
    $this->PueP_Codigo = $PueP_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->PuePA_FechaAprobacion = $PuePA_FechaAprobacion;
    $this->PuePA_HoraAprobacion = $PuePA_HoraAprobacion;
    $this->PuePA_Observacion = $PuePA_Observacion;
    $this->PuePA_EstadoAprobacion = $PuePA_EstadoAprobacion;
    $this->PuePA_Aprobador = $PuePA_Aprobador;
    $this->PuePA_Estado = $PuePA_Estado;
    $this->tabla = "puesta_puntos_aprobaciones";
  }

  function getPuePA_Codigo() {
    return $this->PuePA_Codigo;
  }

  function getPueP_Codigo() {
    return $this->PueP_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPuePA_FechaAprobacion() {
    return $this->PuePA_FechaAprobacion;
  }

  function getPuePA_HoraAprobacion() {
    return $this->PuePA_HoraAprobacion;
  }

  function getPuePA_Observacion() {
    return $this->PuePA_Observacion;
  }

  function getPuePA_EstadoAprobacion() {
    return $this->PuePA_EstadoAprobacion;
  }

  function getPuePA_Aprobador() {
    return $this->PuePA_Aprobador;
  }

  function getPuePA_Estado() {
    return $this->PuePA_Estado;
  }

  function setPuePA_Codigo($PuePA_Codigo) {
    $this->PuePA_Codigo = $PuePA_Codigo;
  }

  function setPueP_Codigo($PueP_Codigo) {
    $this->PueP_Codigo = $PueP_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPuePA_FechaAprobacion($PuePA_FechaAprobacion) {
    $this->PuePA_FechaAprobacion = $PuePA_FechaAprobacion;
  }

  function setPuePA_HoraAprobacion($PuePA_HoraAprobacion) {
    $this->PuePA_HoraAprobacion = $PuePA_HoraAprobacion;
  }

  function setPuePA_Observacion($PuePA_Observacion) {
    $this->PuePA_Observacion = $PuePA_Observacion;
  }

  function setPuePA_EstadoAprobacion($PuePA_EstadoAprobacion) {
    $this->PuePA_EstadoAprobacion = $PuePA_EstadoAprobacion;
  }

  function setPuePA_Aprobador($PuePA_Aprobador) {
    $this->PuePA_Aprobador = $PuePA_Aprobador;
  }

  function setPuePA_Estado($PuePA_Estado) {
    $this->PuePA_Estado = $PuePA_Estado;
  }

  public function insertar(){
    $campos = array("PueP_Codigo", "Usu_Codigo", "PuePA_FechaAprobacion", "PuePA_HoraAprobacion", "PuePA_Observacion", "PuePA_EstadoAprobacion", "PuePA_Aprobador", "PuePA_Estado");
    $valores = array(
    array( 
      $this->PueP_Codigo, 
      $this->Usu_Codigo, 
      $this->PuePA_FechaAprobacion, 
      $this->PuePA_HoraAprobacion, 
      $this->PuePA_Observacion, 
      $this->PuePA_EstadoAprobacion, 
      $this->PuePA_Aprobador, 
      $this->PuePA_Estado
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
    $sql =  "SELECT * FROM puesta_puntos_aprobaciones WHERE PuePA_Codigo = :cod";
    $parametros = array(":cod"=>$this->PuePA_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPueP_Codigo($res[1]);
      $this->setUsu_Codigo($res[2]);
      $this->setPuePA_FechaAprobacion($res[3]);
      $this->setPuePA_HoraAprobacion($res[4]);
      $this->setPuePA_Observacion($res[5]);
      $this->setPuePA_EstadoAprobacion($res[6]);
      $this->setPuePA_Aprobador($res[7]);
      $this->setPuePA_Estado($res[8]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("PueP_Codigo", "Usu_Codigo", "PuePA_FechaAprobacion", "PuePA_HoraAprobacion", "PuePA_Observacion", "PuePA_EstadoAprobacion", "PuePA_Aprobador", "PuePA_Estado");
    $valores = array($this->getPueP_Codigo(), $this->getUsu_Codigo(), $this->getPuePA_FechaAprobacion(), $this->getPuePA_HoraAprobacion(), $this->getPuePA_Observacion(), $this->getPuePA_EstadoAprobacion(), $this->getPuePA_Aprobador(), $this->getPuePA_Estado());
    $llaveprimaria = "PuePA_Codigo";
    $valorllaveprimaria = $this->getPuePA_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM puesta_puntos_aprobaciones WHERE PuePA_Codigo = :cod";
    $parametros = array(":cod"=>$this->PuePA_Codigo);
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
  public function buscarPuestaPuntoCreadas($puestaPunto){

    $parametros = array(":pue"=>$puestaPunto);

    $sql = "SELECT PuePA_Codigo, PueP_Codigo, PuePA_Aprobador, PuePA_Observacion, PuePA_EstadoAprobacion, PuePA_FechaAprobacion, PuePA_HoraAprobacion,
    CONCAT_WS(' ',usuarios.Usu_Nombres,usuarios.Usu_Apellidos) AS nombre
    FROM puesta_puntos_aprobaciones
    INNER JOIN usuarios ON puesta_puntos_aprobaciones.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = '1'
    WHERE PueP_Codigo = :pue AND PuePA_Estado = '1'";

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
  public function buscarPuestaPuntoCreadasInforme($puestaPunto){

    $parametros = array();

    $sql = "SELECT PuePA_Codigo, PueP_Codigo, PuePA_Aprobador, PuePA_Observacion, PuePA_EstadoAprobacion, PuePA_FechaAprobacion, PuePA_HoraAprobacion,
    CONCAT_WS(' ',usuarios.Usu_Nombres,usuarios.Usu_Apellidos) AS nombre
    FROM puesta_puntos_aprobaciones
    INNER JOIN usuarios ON puesta_puntos_aprobaciones.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = '1'
    WHERE PuePA_Estado = '1' ";
    
    if($puestaPunto != ""){ 
      $pri3 = 1; 
      foreach($puestaPunto as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " PueP_Codigo = :pue".$pri3." "; 
        $parametros[':pue'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
