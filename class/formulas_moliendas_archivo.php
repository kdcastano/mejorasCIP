<?php
require_once('basedatos.php');

  class formulas_moliendas_archivo extends basedatos {
    private $ForMA_Codigo;
    private $ForM_Codigo;
    private $ForMA_Version;
    private $ForMA_Archivo;
    private $ForMA_Fecha;
    private $ForMA_UsuarioCrea;
    private $ForMA_FechaHoraCrea;
    private $ForMA_Estado;

  function __construct($ForMA_Codigo = NULL, $ForM_Codigo = NULL, $ForMA_Version = NULL, $ForMA_Archivo = NULL, $ForMA_Fecha = NULL, $ForMA_UsuarioCrea = NULL, $ForMA_FechaHoraCrea = NULL, $ForMA_Estado = NULL) {
    $this->ForMA_Codigo = $ForMA_Codigo;
    $this->ForM_Codigo = $ForM_Codigo;
    $this->ForMA_Version = $ForMA_Version;
    $this->ForMA_Archivo = $ForMA_Archivo;
    $this->ForMA_Fecha = $ForMA_Fecha;
    $this->ForMA_UsuarioCrea = $ForMA_UsuarioCrea;
    $this->ForMA_FechaHoraCrea = $ForMA_FechaHoraCrea;
    $this->ForMA_Estado = $ForMA_Estado;
    $this->tabla = "formulas_moliendas_archivo";
  }

  function getForMA_Codigo() {
    return $this->ForMA_Codigo;
  }

  function getForM_Codigo() {
    return $this->ForM_Codigo;
  }

  function getForMA_Version() {
    return $this->ForMA_Version;
  }

  function getForMA_Archivo() {
    return $this->ForMA_Archivo;
  }

  function getForMA_Fecha() {
    return $this->ForMA_Fecha;
  }

  function getForMA_UsuarioCrea() {
    return $this->ForMA_UsuarioCrea;
  }

  function getForMA_FechaHoraCrea() {
    return $this->ForMA_FechaHoraCrea;
  }

  function getForMA_Estado() {
    return $this->ForMA_Estado;
  }

  function setForMA_Codigo($ForMA_Codigo) {
    $this->ForMA_Codigo = $ForMA_Codigo;
  }

  function setForM_Codigo($ForM_Codigo) {
    $this->ForM_Codigo = $ForM_Codigo;
  }

  function setForMA_Version($ForMA_Version) {
    $this->ForMA_Version = $ForMA_Version;
  }

  function setForMA_Archivo($ForMA_Archivo) {
    $this->ForMA_Archivo = $ForMA_Archivo;
  }

  function setForMA_Fecha($ForMA_Fecha) {
    $this->ForMA_Fecha = $ForMA_Fecha;
  }

  function setForMA_UsuarioCrea($ForMA_UsuarioCrea) {
    $this->ForMA_UsuarioCrea = $ForMA_UsuarioCrea;
  }

  function setForMA_FechaHoraCrea($ForMA_FechaHoraCrea) {
    $this->ForMA_FechaHoraCrea = $ForMA_FechaHoraCrea;
  }

  function setForMA_Estado($ForMA_Estado) {
    $this->ForMA_Estado = $ForMA_Estado;
  }

  public function insertar(){
    $campos = array("ForM_Codigo", "ForMA_Version", "ForMA_Archivo", "ForMA_Fecha", "ForMA_UsuarioCrea", "ForMA_FechaHoraCrea", "ForMA_Estado");
    $valores = array(
    array(
      $this->ForM_Codigo, 
      $this->ForMA_Version, 
      $this->ForMA_Archivo, 
      $this->ForMA_Fecha, 
      $this->ForMA_UsuarioCrea, 
      $this->ForMA_FechaHoraCrea, 
      $this->ForMA_Estado
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
    $sql =  "SELECT * FROM formulas_moliendas_archivo WHERE ForMA_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForMA_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setForM_Codigo($res[1]);
      $this->setForMA_Version($res[2]);
      $this->setForMA_Archivo($res[3]);
      $this->setForMA_Fecha($res[4]);
      $this->setForMA_UsuarioCrea($res[5]);
      $this->setForMA_FechaHoraCrea($res[6]);
      $this->setForMA_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("ForM_Codigo", "ForMA_Version", "ForMA_Archivo", "ForMA_Fecha", "ForMA_UsuarioCrea", "ForMA_FechaHoraCrea", "ForMA_Estado");
    $valores = array($this->getForM_Codigo(), $this->getForMA_Version(), $this->getForMA_Archivo(), $this->getForMA_Fecha(), $this->getForMA_UsuarioCrea(), $this->getForMA_FechaHoraCrea(), $this->getForMA_Estado());
    $llaveprimaria = "ForMA_Codigo";
    $valorllaveprimaria = $this->getForMA_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM formulas_moliendas_archivo WHERE ForMA_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForMA_Codigo);
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
  public function buscarUltimaVersion($codigoFM){

    $parametros = array(":for"=>$codigoFM);

    $sql = "SELECT MAX(ForMA_Version)
    FROM formulas_moliendas_archivo
    WHERE ForM_Codigo = :for LIMIT 1";

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
  public function buscarArchivoVersion($codigo, $version){

    $parametros = array(":cod"=>$codigo,":ver"=>$version);

    $sql = "SELECT ForMA_Codigo, ForMA_Archivo
    FROM formulas_moliendas_archivo
    WHERE ForM_Codigo = :cod AND ForMA_Version = :ver ";

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
  public function listarInfoCodigo($codigo){

    $parametros = array(":cod"=>$codigo);

    $sql = "SELECT ForMA_Fecha, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS nombre, ForMA_Version, ForMA_Archivo
    FROM formulas_moliendas_archivo
    INNER JOIN usuarios ON formulas_moliendas_archivo.ForMA_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE ForM_Codigo = :cod
    ORDER BY ForMA_Version DESC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
