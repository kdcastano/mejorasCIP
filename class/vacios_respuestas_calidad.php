<?php
require_once('basedatos.php');

  class vacios_respuestas_calidad extends basedatos {
    private $vacRC_Codigo;
    private $ProP_Codigo;
    private $EstU_Codigo;
    private $vacRC_Fecha;
    private $vacRC_HoraSugerida;
    private $vacRC_VacioObservacion;
    private $vacRC_UsuarioCrea;
    private $vacRC_Estado;

  function __construct($vacRC_Codigo = NULL, $ProP_Codigo = NULL, $EstU_Codigo = NULL, $vacRC_Fecha = NULL, $vacRC_HoraSugerida = NULL, $vacRC_VacioObservacion = NULL, $vacRC_UsuarioCrea = NULL, $vacRC_Estado = NULL) {
    $this->vacRC_Codigo = $vacRC_Codigo;
    $this->ProP_Codigo = $ProP_Codigo;
    $this->EstU_Codigo = $EstU_Codigo;
    $this->vacRC_Fecha = $vacRC_Fecha;
    $this->vacRC_HoraSugerida = $vacRC_HoraSugerida;
    $this->vacRC_VacioObservacion = $vacRC_VacioObservacion;
    $this->vacRC_UsuarioCrea = $vacRC_UsuarioCrea;
    $this->vacRC_Estado = $vacRC_Estado;
    $this->tabla = "vacios_respuestas_calidad";
  }

  function getVacRC_Codigo() {
    return $this->vacRC_Codigo;
  }

  function getProP_Codigo() {
    return $this->ProP_Codigo;
  }

  function getEstU_Codigo() {
    return $this->EstU_Codigo;
  }

  function getVacRC_Fecha() {
    return $this->vacRC_Fecha;
  }

  function getVacRC_HoraSugerida() {
    return $this->vacRC_HoraSugerida;
  }

  function getVacRC_VacioObservacion() {
    return $this->vacRC_VacioObservacion;
  }

  function getVacRC_UsuarioCrea() {
    return $this->vacRC_UsuarioCrea;
  }

  function getVacRC_Estado() {
    return $this->vacRC_Estado;
  }

  function setVacRC_Codigo($vacRC_Codigo) {
    $this->vacRC_Codigo = $vacRC_Codigo;
  }

  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
  }

  function setEstU_Codigo($EstU_Codigo) {
    $this->EstU_Codigo = $EstU_Codigo;
  }

  function setVacRC_Fecha($vacRC_Fecha) {
    $this->vacRC_Fecha = $vacRC_Fecha;
  }

  function setVacRC_HoraSugerida($vacRC_HoraSugerida) {
    $this->vacRC_HoraSugerida = $vacRC_HoraSugerida;
  }

  function setVacRC_VacioObservacion($vacRC_VacioObservacion) {
    $this->vacRC_VacioObservacion = $vacRC_VacioObservacion;
  }

  function setVacRC_UsuarioCrea($vacRC_UsuarioCrea) {
    $this->vacRC_UsuarioCrea = $vacRC_UsuarioCrea;
  }

  function setVacRC_Estado($vacRC_Estado) {
    $this->vacRC_Estado = $vacRC_Estado;
  }

  public function insertar(){
    $campos = array("ProP_Codigo", "EstU_Codigo", "vacRC_Fecha", "vacRC_HoraSugerida", "vacRC_VacioObservacion", "vacRC_UsuarioCrea", "vacRC_Estado");
    $valores = array(
    array(
      $this->ProP_Codigo, 
      $this->EstU_Codigo, 
      $this->vacRC_Fecha, 
      $this->vacRC_HoraSugerida, 
      $this->vacRC_VacioObservacion, 
      $this->vacRC_UsuarioCrea, 
      $this->vacRC_Estado
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
    $sql =  "SELECT * FROM vacios_respuestas_calidad WHERE vacRC_Codigo = :cod";
    $parametros = array(":cod"=>$this->vacRC_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setProP_Codigo($res[1]);
      $this->setEstU_Codigo($res[2]);
      $this->setvacRC_Fecha($res[3]);
      $this->setvacRC_HoraSugerida($res[4]);
      $this->setvacRC_VacioObservacion($res[5]);
      $this->setvacRC_UsuarioCrea($res[6]);
      $this->setvacRC_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("ProP_Codigo", "EstU_Codigo", "vacRC_Fecha", "vacRC_HoraSugerida", "vacRC_VacioObservacion", "vacRC_UsuarioCrea", "vacRC_Estado");
    $valores = array($this->getProP_Codigo(), $this->getEstU_Codigo(), $this->getVacRC_Fecha(), $this->getVacRC_HoraSugerida(), $this->getVacRC_VacioObservacion(), $this->getVacRC_UsuarioCrea(), $this->getVacRC_Estado());
    $llaveprimaria = "vacRC_Codigo";
    $valorllaveprimaria = $this->getvacRC_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM vacios_respuestas_calidad WHERE vacRC_Codigo = :cod";
    $parametros = array(":cod"=>$this->vacRC_Codigo);
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
  public function buscarRespuestasVacios($programaproduccion, $estacionUsuario){

    $parametros = array(":prop"=>$programaproduccion,":estu"=>$estacionUsuario);

    $sql = "SELECT vacRC_Codigo, vacRC_Fecha, vacRC_HoraSugerida, vacRC_VacioObservacion
    FROM vacios_respuestas_calidad
    WHERE ProP_Codigo = :prop AND EstU_Codigo = :estu AND vacRC_Estado = '1'";
    
    if($_SESSION['CP_Usuario'] == "1"){
    echo "------"."<br>".$sql;
    var_dump($parametros);
    echo "<br>";
  }

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
