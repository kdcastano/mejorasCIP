<?php
require_once('basedatos.php');

  class vacios_respuestas extends basedatos {
    private $vacR_Codigo;
    private $Maq_Codigo;
    private $ProP_Codigo;
    private $EstU_Codigo;
    private $vacR_Fecha;
    private $vacR_HoraSugerida;
    private $vacR_VacioObservacion;
    private $vacR_UsuarioCrea;
    private $vacR_Estado;

  function __construct($vacR_Codigo = NULL, $Maq_Codigo = NULL, $ProP_Codigo = NULL, $EstU_Codigo = NULL, $vacR_Fecha = NULL, $vacR_HoraSugerida = NULL, $vacR_VacioObservacion = NULL, $vacR_UsuarioCrea = NULL, $vacR_Estado = NULL) {
    $this->vacR_Codigo = $vacR_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->ProP_Codigo = $ProP_Codigo;
    $this->EstU_Codigo = $EstU_Codigo;
    $this->vacR_Fecha = $vacR_Fecha;
    $this->vacR_HoraSugerida = $vacR_HoraSugerida;
    $this->vacR_VacioObservacion = $vacR_VacioObservacion;
    $this->vacR_UsuarioCrea = $vacR_UsuarioCrea;
    $this->vacR_Estado = $vacR_Estado;
    $this->tabla = "vacios_respuestas";
  }

  function getVacR_Codigo() {
    return $this->vacR_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getProP_Codigo() {
    return $this->ProP_Codigo;
  }

  function getEstU_Codigo() {
    return $this->EstU_Codigo;
  }

  function getVacR_Fecha() {
    return $this->vacR_Fecha;
  }

  function getVacR_HoraSugerida() {
    return $this->vacR_HoraSugerida;
  }

  function getVacR_VacioObservacion() {
    return $this->vacR_VacioObservacion;
  }

  function getVacR_UsuarioCrea() {
    return $this->vacR_UsuarioCrea;
  }

  function getVacR_Estado() {
    return $this->vacR_Estado;
  }

  function setVacR_Codigo($vacR_Codigo) {
    $this->vacR_Codigo = $vacR_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
  }

  function setEstU_Codigo($EstU_Codigo) {
    $this->EstU_Codigo = $EstU_Codigo;
  }

  function setVacR_Fecha($vacR_Fecha) {
    $this->vacR_Fecha = $vacR_Fecha;
  }

  function setVacR_HoraSugerida($vacR_HoraSugerida) {
    $this->vacR_HoraSugerida = $vacR_HoraSugerida;
  }

  function setVacR_VacioObservacion($vacR_VacioObservacion) {
    $this->vacR_VacioObservacion = $vacR_VacioObservacion;
  }

  function setVacR_UsuarioCrea($vacR_UsuarioCrea) {
    $this->vacR_UsuarioCrea = $vacR_UsuarioCrea;
  }

  function setVacR_Estado($vacR_Estado) {
    $this->vacR_Estado = $vacR_Estado;
  }

  public function insertar(){
    $campos = array("Maq_Codigo", "ProP_Codigo", "EstU_Codigo", "vacR_Fecha", "vacR_HoraSugerida", "vacR_VacioObservacion", "vacR_UsuarioCrea", "vacR_Estado");
    $valores = array(
    array(
      $this->Maq_Codigo, 
      $this->ProP_Codigo, 
      $this->EstU_Codigo, 
      $this->vacR_Fecha, 
      $this->vacR_HoraSugerida, 
      $this->vacR_VacioObservacion, 
      $this->vacR_UsuarioCrea, 
      $this->vacR_Estado
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
    $sql =  "SELECT * FROM vacios_respuestas WHERE vacR_Codigo = :cod";
    $parametros = array(":cod"=>$this->vacR_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setMaq_Codigo($res[1]);
      $this->setProP_Codigo($res[2]);
      $this->setEstU_Codigo($res[3]);
      $this->setvacR_Fecha($res[4]);
      $this->setvacR_HoraSugerida($res[5]);
      $this->setvacR_VacioObservacion($res[6]);
      $this->setvacR_UsuarioCrea($res[7]);
      $this->setvacR_Estado($res[8]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Maq_Codigo", "ProP_Codigo", "EstU_Codigo", "vacR_Fecha", "vacR_HoraSugerida", "vacR_VacioObservacion", "vacR_UsuarioCrea", "vacR_Estado");
    $valores = array($this->getMaq_Codigo(), $this->getProP_Codigo(), $this->getEstU_Codigo(), $this->getVacR_Fecha(), $this->getVacR_HoraSugerida(), $this->getVacR_VacioObservacion(), $this->getVacR_UsuarioCrea(), $this->getVacR_Estado());
    $llaveprimaria = "vacR_Codigo";
    $valorllaveprimaria = $this->getvacR_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM vacios_respuestas WHERE vacR_Codigo = :cod";
    $parametros = array(":cod"=>$this->vacR_Codigo);
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
  public function listarObservacionesVacio($estacionUsuario, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $parametros = array(":estU"=>$estacionUsuario);

    $sql = "SELECT vacR_Codigo, Maq_Codigo, vacR_Fecha, vacR_HoraSugerida, vacR_VacioObservacion
    FROM vacios_respuestas
    WHERE EstU_Codigo = :estU AND vacR_Estado = '1' ";
    
    if($valFecha == "0"){
      $sql .= " AND vacR_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((vacR_Fecha = :fecini
      AND vacR_HoraSugerida BETWEEN :horini AND :horfin) OR (vacR_Fecha = :fecfin
      AND vacR_HoraSugerida BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    if($_SESSION['CP_Usuario'] == "712"){
    echo "------"."<br>".$sql;
    var_dump($parametros);
    echo "<br>";
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
 public function buscarComentariosVacios($fechaInicial, $fechaFinal, $fechaHoraInicial, $fechaHoraFinal){

 $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":fecHI"=>$fechaHoraInicial, ":fecHF"=>$fechaHoraFinal);

    $sql = "SELECT Maq_Codigo, ProP_Codigo, EstU_Codigo, vacR_Fecha, vacR_HoraSugerida, vacR_VacioObservacion, CONCAT_WS(' ', vacR_Fecha, vacR_HoraSugerida) AS FecComp
    FROM vacios_respuestas
    WHERE vacR_Estado = '1' AND vacR_Fecha BETWEEN :fecI AND :fecF HAVING FecComp BETWEEN :fecHI AND :fecHF
    ORDER BY FecComp ASC";

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
  public function buscarComentariosVaciosTS($maquina, $esUsuario, $fecha, $hora){

    $parametros = array(":maq"=>$maquina,":estU"=>$esUsuario,":fec"=>$fecha,":hor"=>$hora);

    $sql = "SELECT vacR_Codigo, vacR_VacioObservacion
    FROM vacios_respuestas
    WHERE Maq_Codigo = :maq AND EstU_Codigo = :estU AND vacR_Fecha = :fec AND vacR_HoraSugerida = :hor AND vacR_Estado = '1' LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
