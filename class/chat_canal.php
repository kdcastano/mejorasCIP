<?php
require_once('basedatos.php');

  class chat_canal extends basedatos {
    private $ChaC_Codigo;
    private $Agr_Codigo;
    private $ChaC_Usuario;
    private $ChaC_Fecha;
    private $ChaC_Hora;
    private $ChaC_Mensaje;
    private $ChaC_Adjunto;
    private $ChaC_FechaHoraCrea;
    private $ChaC_UsuarioCrea;
    private $ChaC_Estado;

  function __construct($ChaC_Codigo = NULL, $Agr_Codigo = NULL, $ChaC_Usuario = NULL, $ChaC_Fecha = NULL, $ChaC_Hora = NULL, $ChaC_Mensaje = NULL, $ChaC_Adjunto = NULL, $ChaC_FechaHoraCrea = NULL, $ChaC_UsuarioCrea = NULL, $ChaC_Estado = NULL) {
    $this->ChaC_Codigo = $ChaC_Codigo;
    $this->Agr_Codigo = $Agr_Codigo;
    $this->ChaC_Usuario = $ChaC_Usuario;
    $this->ChaC_Fecha = $ChaC_Fecha;
    $this->ChaC_Hora = $ChaC_Hora;
    $this->ChaC_Mensaje = $ChaC_Mensaje;
    $this->ChaC_Adjunto = $ChaC_Adjunto;
    $this->ChaC_FechaHoraCrea = $ChaC_FechaHoraCrea;
    $this->ChaC_UsuarioCrea = $ChaC_UsuarioCrea;
    $this->ChaC_Estado = $ChaC_Estado;
    $this->tabla = "chat_canal";
  }

  function getChaC_Codigo() {
    return $this->ChaC_Codigo;
  }

  function getAgr_Codigo() {
    return $this->Agr_Codigo;
  }

  function getChaC_Usuario() {
    return $this->ChaC_Usuario;
  }

  function getChaC_Fecha() {
    return $this->ChaC_Fecha;
  }

  function getChaC_Hora() {
    return $this->ChaC_Hora;
  }

  function getChaC_Mensaje() {
    return $this->ChaC_Mensaje;
  }

  function getChaC_Adjunto() {
    return $this->ChaC_Adjunto;
  }

  function getChaC_FechaHoraCrea() {
    return $this->ChaC_FechaHoraCrea;
  }

  function getChaC_UsuarioCrea() {
    return $this->ChaC_UsuarioCrea;
  }

  function getChaC_Estado() {
    return $this->ChaC_Estado;
  }

  function setChaC_Codigo($ChaC_Codigo) {
    $this->ChaC_Codigo = $ChaC_Codigo;
  }

  function setAgr_Codigo($Agr_Codigo) {
    $this->Agr_Codigo = $Agr_Codigo;
  }

  function setChaC_Usuario($ChaC_Usuario) {
    $this->ChaC_Usuario = $ChaC_Usuario;
  }

  function setChaC_Fecha($ChaC_Fecha) {
    $this->ChaC_Fecha = $ChaC_Fecha;
  }

  function setChaC_Hora($ChaC_Hora) {
    $this->ChaC_Hora = $ChaC_Hora;
  }

  function setChaC_Mensaje($ChaC_Mensaje) {
    $this->ChaC_Mensaje = $ChaC_Mensaje;
  }

  function setChaC_Adjunto($ChaC_Adjunto) {
    $this->ChaC_Adjunto = $ChaC_Adjunto;
  }

  function setChaC_FechaHoraCrea($ChaC_FechaHoraCrea) {
    $this->ChaC_FechaHoraCrea = $ChaC_FechaHoraCrea;
  }

  function setChaC_UsuarioCrea($ChaC_UsuarioCrea) {
    $this->ChaC_UsuarioCrea = $ChaC_UsuarioCrea;
  }

  function setChaC_Estado($ChaC_Estado) {
    $this->ChaC_Estado = $ChaC_Estado;
  }

  public function insertar(){
    $campos = array("Agr_Codigo", "ChaC_Usuario", "ChaC_Fecha", "ChaC_Hora", "ChaC_Mensaje", "ChaC_Adjunto", "ChaC_FechaHoraCrea", "ChaC_UsuarioCrea", "ChaC_Estado");
    $valores = array(
    array( 
      $this->Agr_Codigo, 
      $this->ChaC_Usuario, 
      $this->ChaC_Fecha, 
      $this->ChaC_Hora, 
      $this->ChaC_Mensaje, 
      $this->ChaC_Adjunto, 
      $this->ChaC_FechaHoraCrea, 
      $this->ChaC_UsuarioCrea, 
      $this->ChaC_Estado
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
    $sql =  "SELECT * FROM chat_canal WHERE ChaC_Codigo = :cod";
    $parametros = array(":cod"=>$this->ChaC_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAgr_Codigo($res[1]);
      $this->setChaC_Usuario($res[2]);
      $this->setChaC_Fecha($res[3]);
      $this->setChaC_Hora($res[4]);
      $this->setChaC_Mensaje($res[5]);
      $this->setChaC_Adjunto($res[6]);
      $this->setChaC_FechaHoraCrea($res[7]);
      $this->setChaC_UsuarioCrea($res[8]);
      $this->setChaC_Estado($res[9]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Agr_Codigo", "ChaC_Usuario", "ChaC_Fecha", "ChaC_Hora", "ChaC_Mensaje", "ChaC_Adjunto", "ChaC_FechaHoraCrea", "ChaC_UsuarioCrea", "ChaC_Estado");
    $valores = array($this->getAgr_Codigo(), $this->getChaC_Usuario(), $this->getChaC_Fecha(), $this->getChaC_Hora(), $this->getChaC_Mensaje(), $this->getChaC_Adjunto(), $this->getChaC_FechaHoraCrea(), $this->getChaC_UsuarioCrea(), $this->getChaC_Estado());
    $llaveprimaria = "ChaC_Codigo";
    $valorllaveprimaria = $this->getChaC_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM chat_canal WHERE ChaC_Codigo = :cod";
    $parametros = array(":cod"=>$this->ChaC_Codigo);
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
  public function listarInfoChat($agrupacion, $fechainicial, $fechaFinal){

    $parametros = array(":agr"=>$agrupacion,":fecI"=>$fechainicial,":fecF"=>$fechaFinal);

    $sql = "SELECT CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS nombre, ChaC_Fecha, ChaC_Hora, ChaC_Mensaje, ChaC_Usuario, ChaC_Adjunto
    FROM chat_canal
    INNER JOIN usuarios ON chat_canal.ChaC_Usuario = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE ChaC_Estado = 1 AND Agr_Codigo = :agr AND ChaC_Fecha BETWEEN :fecI AND :fecF";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
