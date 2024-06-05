<?php
require_once('basedatos.php');

  class ft_pdf_observaciones extends basedatos {
    private $ft_pdf_Codigo;
    private $FicT_Codigo;
    private $ft_pdf_Tipo;
    private $ft_pdf_Observaciones;
    private $ft_pdf_FechaHoraCrea;
    private $ft_pdf_UsuarioCrea;
    private $ft_pdf_Estado;

  function __construct($ft_pdf_Codigo = NULL, $FicT_Codigo = NULL, $ft_pdf_Tipo = NULL, $ft_pdf_Observaciones = NULL, $ft_pdf_FechaHoraCrea = NULL, $ft_pdf_UsuarioCrea = NULL, $ft_pdf_Estado = NULL) {
    $this->ft_pdf_Codigo = $ft_pdf_Codigo;
    $this->FicT_Codigo = $FicT_Codigo;
    $this->ft_pdf_Tipo = $ft_pdf_Tipo;
    $this->ft_pdf_Observaciones = $ft_pdf_Observaciones;
    $this->ft_pdf_FechaHoraCrea = $ft_pdf_FechaHoraCrea;
    $this->ft_pdf_UsuarioCrea = $ft_pdf_UsuarioCrea;
    $this->ft_pdf_Estado = $ft_pdf_Estado;
    $this->tabla = "ft_pdf_observaciones";
  }

  function getFt_pdf_Codigo() {
    return $this->ft_pdf_Codigo;
  }

  function getFicT_Codigo() {
    return $this->FicT_Codigo;
  }

  function getFt_pdf_Tipo() {
    return $this->ft_pdf_Tipo;
  }

  function getFt_pdf_Observaciones() {
    return $this->ft_pdf_Observaciones;
  }

  function getFt_pdf_FechaHoraCrea() {
    return $this->ft_pdf_FechaHoraCrea;
  }

  function getFt_pdf_UsuarioCrea() {
    return $this->ft_pdf_UsuarioCrea;
  }

  function getFt_pdf_Estado() {
    return $this->ft_pdf_Estado;
  }

  function setFt_pdf_Codigo($ft_pdf_Codigo) {
    $this->ft_pdf_Codigo = $ft_pdf_Codigo;
  }

  function setFicT_Codigo($FicT_Codigo) {
    $this->FicT_Codigo = $FicT_Codigo;
  }

  function setFt_pdf_Tipo($ft_pdf_Tipo) {
    $this->ft_pdf_Tipo = $ft_pdf_Tipo;
  }

  function setFt_pdf_Observaciones($ft_pdf_Observaciones) {
    $this->ft_pdf_Observaciones = $ft_pdf_Observaciones;
  }

  function setFt_pdf_FechaHoraCrea($ft_pdf_FechaHoraCrea) {
    $this->ft_pdf_FechaHoraCrea = $ft_pdf_FechaHoraCrea;
  }

  function setFt_pdf_UsuarioCrea($ft_pdf_UsuarioCrea) {
    $this->ft_pdf_UsuarioCrea = $ft_pdf_UsuarioCrea;
  }

  function setFt_pdf_Estado($ft_pdf_Estado) {
    $this->ft_pdf_Estado = $ft_pdf_Estado;
  }

  public function insertar(){
    $campos = array("FicT_Codigo", "ft_pdf_Tipo", "ft_pdf_Observaciones", "ft_pdf_FechaHoraCrea", "ft_pdf_UsuarioCrea", "ft_pdf_Estado");
    $valores = array(
    array( 
      $this->FicT_Codigo, 
      $this->ft_pdf_Tipo, 
      $this->ft_pdf_Observaciones, 
      $this->ft_pdf_FechaHoraCrea, 
      $this->ft_pdf_UsuarioCrea, 
      $this->ft_pdf_Estado
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
    $sql =  "SELECT * FROM ft_pdf_observaciones WHERE ft_pdf_Codigo = :cod";
    $parametros = array(":cod"=>$this->ft_pdf_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setFicT_Codigo($res[1]);
      $this->setft_pdf_Tipo($res[2]);
      $this->setft_pdf_Observaciones($res[3]);
      $this->setft_pdf_FechaHoraCrea($res[4]);
      $this->setft_pdf_UsuarioCrea($res[5]);
      $this->setft_pdf_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("FicT_Codigo", "ft_pdf_Tipo", "ft_pdf_Observaciones", "ft_pdf_FechaHoraCrea", "ft_pdf_UsuarioCrea", "ft_pdf_Estado");
    $valores = array($this->getFicT_Codigo(), $this->getFt_pdf_Tipo(), $this->getFt_pdf_Observaciones(), $this->getFt_pdf_FechaHoraCrea(), $this->getFt_pdf_UsuarioCrea(), $this->getFt_pdf_Estado());
    $llaveprimaria = "ft_pdf_Codigo";
    $valorllaveprimaria = $this->getft_pdf_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM ft_pdf_observaciones WHERE ft_pdf_Codigo = :cod";
    $parametros = array(":cod"=>$this->ft_pdf_Codigo);
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
  public function listarObservacionTipo($fichaTecnica){

    $parametros = array(":ft"=>$fichaTecnica);

    $sql = "SELECT ft_pdf_Codigo, FicT_Codigo, ft_pdf_Tipo, ft_pdf_Observaciones
    FROM ft_pdf_observaciones
    WHERE FicT_Codigo = :ft AND ft_pdf_Estado = '1'";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
