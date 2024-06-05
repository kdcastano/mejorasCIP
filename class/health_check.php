<?php
require_once('basedatos.php');

  class health_check extends basedatos {
    private $HeaC_Codigo;
    private $Pla_Codigo;
    private $Ref_Codigo;
    private $Usu_Codigo;
    private $HeaC_fecha;
    private $HeaC_ProcesoEvaluar;
    private $HeaC_Evaluador;
    private $HeaC_Area;
    private $HeaC_Horno;
    private $HeaC_Supervisor;
    private $HeaC_Operador1;
    private $HeaC_Operador2;
    private $HeaC_Operador3;
    private $HeaC_Operador4;
    private $HeaC_Operador5;
    private $HeaC_Operador6;
    private $HeaC_Operador7;
    private $HeaC_Operador8;
    private $HeaC_Supervisor1;
    private $HeaC_Supervisor2;
    private $HeaC_Supervisor3;
    private $HeaC_Supervisor4;
    private $HeaC_Supervisor5;
    private $HeaC_Supervisor6;
    private $HeaC_jefe1;
    private $HeaC_jefe2;
    private $HeaC_Comentarios;
    private $HeaC_Comentarios1;
    private $HeaC_Comentarios2;
    private $HeaC_Comentarios3;
    private $HeaC_Comentarios4;
    private $HeaC_Comentarios5;
    private $HeaC_Comentarios6;
    private $HeaC_Comentarios7;
    private $HeaC_Comentarios8;
    private $HeaC_Comentarios9;
    private $HeaC_Comentarios10;
    private $HeaC_Comentarios11;
    private $HeaC_Comentarios12;
    private $HeaC_Comentarios13;
    private $HeaC_Comentarios14;
    private $HeaC_Comentarios15;
    private $HeaC_Comentarios16;
    private $HeaC_FechaHoraCrea;
    private $HeaC_UsuarioCrea;
    private $HeaC_Estado;

  function __construct($HeaC_Codigo = NULL, $Pla_Codigo = NULL, $Ref_Codigo = NULL, $Usu_Codigo = NULL, $HeaC_fecha = NULL, $HeaC_ProcesoEvaluar = NULL, $HeaC_Evaluador = NULL, $HeaC_Area = NULL, $HeaC_Horno = NULL, $HeaC_Supervisor = NULL, $HeaC_Operador1 = NULL, $HeaC_Operador2 = NULL, $HeaC_Operador3 = NULL, $HeaC_Operador4 = NULL, $HeaC_Operador5 = NULL, $HeaC_Operador6 = NULL, $HeaC_Operador7 = NULL, $HeaC_Operador8 = NULL, $HeaC_Supervisor1 = NULL, $HeaC_Supervisor2 = NULL, $HeaC_Supervisor3 = NULL, $HeaC_Supervisor4 = NULL, $HeaC_Supervisor5 = NULL, $HeaC_Supervisor6 = NULL, $HeaC_jefe1 = NULL, $HeaC_jefe2 = NULL, $HeaC_Comentarios = NULL, $HeaC_Comentarios1 = NULL, $HeaC_Comentarios2 = NULL, $HeaC_Comentarios3 = NULL, $HeaC_Comentarios4 = NULL, $HeaC_Comentarios5 = NULL, $HeaC_Comentarios6 = NULL, $HeaC_Comentarios7 = NULL, $HeaC_Comentarios8 = NULL, $HeaC_Comentarios9 = NULL, $HeaC_Comentarios10 = NULL, $HeaC_Comentarios11 = NULL, $HeaC_Comentarios12 = NULL, $HeaC_Comentarios13 = NULL, $HeaC_Comentarios14 = NULL, $HeaC_Comentarios15 = NULL, $HeaC_Comentarios16 = NULL, $HeaC_FechaHoraCrea = NULL, $HeaC_UsuarioCrea = NULL, $HeaC_Estado = NULL) {
    $this->HeaC_Codigo = $HeaC_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Ref_Codigo = $Ref_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->HeaC_fecha = $HeaC_fecha;
    $this->HeaC_ProcesoEvaluar = $HeaC_ProcesoEvaluar;
    $this->HeaC_Evaluador = $HeaC_Evaluador;
    $this->HeaC_Area = $HeaC_Area;
    $this->HeaC_Horno = $HeaC_Horno;
    $this->HeaC_Supervisor = $HeaC_Supervisor;
    $this->HeaC_Operador1 = $HeaC_Operador1;
    $this->HeaC_Operador2 = $HeaC_Operador2;
    $this->HeaC_Operador3 = $HeaC_Operador3;
    $this->HeaC_Operador4 = $HeaC_Operador4;
    $this->HeaC_Operador5 = $HeaC_Operador5;
    $this->HeaC_Operador6 = $HeaC_Operador6;
    $this->HeaC_Operador7 = $HeaC_Operador7;
    $this->HeaC_Operador8 = $HeaC_Operador8;
    $this->HeaC_Supervisor1 = $HeaC_Supervisor1;
    $this->HeaC_Supervisor2 = $HeaC_Supervisor2;
    $this->HeaC_Supervisor3 = $HeaC_Supervisor3;
    $this->HeaC_Supervisor4 = $HeaC_Supervisor4;
    $this->HeaC_Supervisor5 = $HeaC_Supervisor5;
    $this->HeaC_Supervisor6 = $HeaC_Supervisor6;
    $this->HeaC_jefe1 = $HeaC_jefe1;
    $this->HeaC_jefe2 = $HeaC_jefe2;
    $this->HeaC_Comentarios = $HeaC_Comentarios;
    $this->HeaC_Comentarios1 = $HeaC_Comentarios1;
    $this->HeaC_Comentarios2 = $HeaC_Comentarios2;
    $this->HeaC_Comentarios3 = $HeaC_Comentarios3;
    $this->HeaC_Comentarios4 = $HeaC_Comentarios4;

    $this->HeaC_Comentarios5 = $HeaC_Comentarios5;
    $this->HeaC_Comentarios6 = $HeaC_Comentarios6;
    $this->HeaC_Comentarios7 = $HeaC_Comentarios7;
    $this->HeaC_Comentarios8 = $HeaC_Comentarios8;
    $this->HeaC_Comentarios9 = $HeaC_Comentarios9;
    $this->HeaC_Comentarios10 = $HeaC_Comentarios10;
    $this->HeaC_Comentarios11 = $HeaC_Comentarios11;
    $this->HeaC_Comentarios12 = $HeaC_Comentarios12;
    $this->HeaC_Comentarios13 = $HeaC_Comentarios13;
    $this->HeaC_Comentarios14 = $HeaC_Comentarios14;
    $this->HeaC_Comentarios15 = $HeaC_Comentarios15;
    $this->HeaC_Comentarios16 = $HeaC_Comentarios16;
    $this->HeaC_FechaHoraCrea = $HeaC_FechaHoraCrea;
    $this->HeaC_UsuarioCrea = $HeaC_UsuarioCrea;
    $this->HeaC_Estado = $HeaC_Estado;
    $this->tabla = "health_check";
  }

  function getHeaC_Codigo() {
    return $this->HeaC_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getRef_Codigo() {
    return $this->Ref_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getHeaC_fecha() {
    return $this->HeaC_fecha;
  }

  function getHeaC_ProcesoEvaluar() {
    return $this->HeaC_ProcesoEvaluar;
  }

  function getHeaC_Evaluador() {
    return $this->HeaC_Evaluador;
  }

  function getHeaC_Area() {
    return $this->HeaC_Area;
  }

  function getHeaC_Horno() {
    return $this->HeaC_Horno;
  }

  function getHeaC_Supervisor() {
    return $this->HeaC_Supervisor;
  }

  function getHeaC_Operador1() {
    return $this->HeaC_Operador1;
  }

  function getHeaC_Operador2() {
    return $this->HeaC_Operador2;
  }

  function getHeaC_Operador3() {
    return $this->HeaC_Operador3;
  }

  function getHeaC_Operador4() {
    return $this->HeaC_Operador4;
  }

  function getHeaC_Operador5() {
    return $this->HeaC_Operador5;
  }

  function getHeaC_Operador6() {
    return $this->HeaC_Operador6;
  }

  function getHeaC_Operador7() {
    return $this->HeaC_Operador7;
  }

  function getHeaC_Operador8() {
    return $this->HeaC_Operador8;
  }

  function getHeaC_Supervisor1() {
    return $this->HeaC_Supervisor1;
  }

  function getHeaC_Supervisor2() {
    return $this->HeaC_Supervisor2;
  }

  function getHeaC_Supervisor3() {
    return $this->HeaC_Supervisor3;
  }

  function getHeaC_Supervisor4() {
    return $this->HeaC_Supervisor4;
  }

  function getHeaC_Supervisor5() {
    return $this->HeaC_Supervisor5;
  }

  function getHeaC_Supervisor6() {
    return $this->HeaC_Supervisor6;
  }

  function getHeaC_jefe1() {
    return $this->HeaC_jefe1;
  }

  function getHeaC_jefe2() {
    return $this->HeaC_jefe2;
  }

  function getHeaC_Comentarios() {
    return $this->HeaC_Comentarios;
  }

  function getHeaC_Comentarios1() {
    return $this->HeaC_Comentarios1;
  }

  function getHeaC_Comentarios2() {
    return $this->HeaC_Comentarios2;
  }

  function getHeaC_Comentarios3() {
    return $this->HeaC_Comentarios3;
  }

  function getHeaC_Comentarios4() {
    return $this->HeaC_Comentarios4;
  }

  function getHeaC_Comentarios5() {
    return $this->HeaC_Comentarios5;
  }

  function getHeaC_Comentarios6() {
    return $this->HeaC_Comentarios6;
  }

  function getHeaC_Comentarios7() {
    return $this->HeaC_Comentarios7;
  }

  function getHeaC_Comentarios8() {
    return $this->HeaC_Comentarios8;
  }

  function getHeaC_Comentarios9() {
    return $this->HeaC_Comentarios9;
  }

  function getHeaC_Comentarios10() {
    return $this->HeaC_Comentarios10;
  }

  function getHeaC_Comentarios11() {
    return $this->HeaC_Comentarios11;
  }

  function getHeaC_Comentarios12() {
    return $this->HeaC_Comentarios12;
  }

  function getHeaC_Comentarios13() {
    return $this->HeaC_Comentarios13;
  }

  function getHeaC_Comentarios14() {
    return $this->HeaC_Comentarios14;
  }

  function getHeaC_Comentarios15() {
    return $this->HeaC_Comentarios15;
  }

  function getHeaC_Comentarios16() {
    return $this->HeaC_Comentarios16;
  }

  function getHeaC_FechaHoraCrea() {
    return $this->HeaC_FechaHoraCrea;
  }

  function getHeaC_UsuarioCrea() {
    return $this->HeaC_UsuarioCrea;
  }

  function getHeaC_Estado() {
    return $this->HeaC_Estado;
  }

  function setHeaC_Codigo($HeaC_Codigo) {
    $this->HeaC_Codigo = $HeaC_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setRef_Codigo($Ref_Codigo) {
    $this->Ref_Codigo = $Ref_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setHeaC_fecha($HeaC_fecha) {
    $this->HeaC_fecha = $HeaC_fecha;
  }

  function setHeaC_ProcesoEvaluar($HeaC_ProcesoEvaluar) {
    $this->HeaC_ProcesoEvaluar = $HeaC_ProcesoEvaluar;
  }

  function setHeaC_Evaluador($HeaC_Evaluador) {
    $this->HeaC_Evaluador = $HeaC_Evaluador;
  }

  function setHeaC_Area($HeaC_Area) {
    $this->HeaC_Area = $HeaC_Area;
  }

  function setHeaC_Horno($HeaC_Horno) {
    $this->HeaC_Horno = $HeaC_Horno;
  }

  function setHeaC_Supervisor($HeaC_Supervisor) {
    $this->HeaC_Supervisor = $HeaC_Supervisor;
  }

  function setHeaC_Operador1($HeaC_Operador1) {
    $this->HeaC_Operador1 = $HeaC_Operador1;
  }

  function setHeaC_Operador2($HeaC_Operador2) {
    $this->HeaC_Operador2 = $HeaC_Operador2;
  }

  function setHeaC_Operador3($HeaC_Operador3) {
    $this->HeaC_Operador3 = $HeaC_Operador3;
  }

  function setHeaC_Operador4($HeaC_Operador4) {
    $this->HeaC_Operador4 = $HeaC_Operador4;
  }

  function setHeaC_Operador5($HeaC_Operador5) {
    $this->HeaC_Operador5 = $HeaC_Operador5;
  }

  function setHeaC_Operador6($HeaC_Operador6) {
    $this->HeaC_Operador6 = $HeaC_Operador6;
  }

  function setHeaC_Operador7($HeaC_Operador7) {
    $this->HeaC_Operador7 = $HeaC_Operador7;
  }

  function setHeaC_Operador8($HeaC_Operador8) {
    $this->HeaC_Operador8 = $HeaC_Operador8;
  }

  function setHeaC_Supervisor1($HeaC_Supervisor1) {
    $this->HeaC_Supervisor1 = $HeaC_Supervisor1;
  }

  function setHeaC_Supervisor2($HeaC_Supervisor2) {
    $this->HeaC_Supervisor2 = $HeaC_Supervisor2;
  }

  function setHeaC_Supervisor3($HeaC_Supervisor3) {
    $this->HeaC_Supervisor3 = $HeaC_Supervisor3;
  }

  function setHeaC_Supervisor4($HeaC_Supervisor4) {
    $this->HeaC_Supervisor4 = $HeaC_Supervisor4;
  }

  function setHeaC_Supervisor5($HeaC_Supervisor5) {
    $this->HeaC_Supervisor5 = $HeaC_Supervisor5;
  }

  function setHeaC_Supervisor6($HeaC_Supervisor6) {
    $this->HeaC_Supervisor6 = $HeaC_Supervisor6;
  }

  function setHeaC_jefe1($HeaC_jefe1) {
    $this->HeaC_jefe1 = $HeaC_jefe1;
  }

  function setHeaC_jefe2($HeaC_jefe2) {
    $this->HeaC_jefe2 = $HeaC_jefe2;
  }

  function setHeaC_Comentarios($HeaC_Comentarios) {
    $this->HeaC_Comentarios = $HeaC_Comentarios;
  }

  function setHeaC_Comentarios1($HeaC_Comentarios1) {
    $this->HeaC_Comentarios1 = $HeaC_Comentarios1;
  }

  function setHeaC_Comentarios2($HeaC_Comentarios2) {
    $this->HeaC_Comentarios2 = $HeaC_Comentarios2;
  }

  function setHeaC_Comentarios3($HeaC_Comentarios3) {
    $this->HeaC_Comentarios3 = $HeaC_Comentarios3;
  }

  function setHeaC_Comentarios4($HeaC_Comentarios4) {
    $this->HeaC_Comentarios4 = $HeaC_Comentarios4;
  }

  function setHeaC_Comentarios5($HeaC_Comentarios5) {
    $this->HeaC_Comentarios5 = $HeaC_Comentarios5;
  }

  function setHeaC_Comentarios6($HeaC_Comentarios6) {
    $this->HeaC_Comentarios6 = $HeaC_Comentarios6;
  }

  function setHeaC_Comentarios7($HeaC_Comentarios7) {
    $this->HeaC_Comentarios7 = $HeaC_Comentarios7;
  }

  function setHeaC_Comentarios8($HeaC_Comentarios8) {
    $this->HeaC_Comentarios8 = $HeaC_Comentarios8;
  }

  function setHeaC_Comentarios9($HeaC_Comentarios9) {
    $this->HeaC_Comentarios9 = $HeaC_Comentarios9;
  }

  function setHeaC_Comentarios10($HeaC_Comentarios10) {
    $this->HeaC_Comentarios10 = $HeaC_Comentarios10;
  }

  function setHeaC_Comentarios11($HeaC_Comentarios11) {
    $this->HeaC_Comentarios11 = $HeaC_Comentarios11;
  }

  function setHeaC_Comentarios12($HeaC_Comentarios12) {
    $this->HeaC_Comentarios12 = $HeaC_Comentarios12;
  }

  function setHeaC_Comentarios13($HeaC_Comentarios13) {
    $this->HeaC_Comentarios13 = $HeaC_Comentarios13;
  }

  function setHeaC_Comentarios14($HeaC_Comentarios14) {
    $this->HeaC_Comentarios14 = $HeaC_Comentarios14;
  }

  function setHeaC_Comentarios15($HeaC_Comentarios15) {
    $this->HeaC_Comentarios15 = $HeaC_Comentarios15;
  }

  function setHeaC_Comentarios16($HeaC_Comentarios16) {
    $this->HeaC_Comentarios16 = $HeaC_Comentarios16;
  }

  function setHeaC_FechaHoraCrea($HeaC_FechaHoraCrea) {
    $this->HeaC_FechaHoraCrea = $HeaC_FechaHoraCrea;
  }

  function setHeaC_UsuarioCrea($HeaC_UsuarioCrea) {
    $this->HeaC_UsuarioCrea = $HeaC_UsuarioCrea;
  }

  function setHeaC_Estado($HeaC_Estado) {
    $this->HeaC_Estado = $HeaC_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "Ref_Codigo", "Usu_Codigo", "HeaC_fecha", "HeaC_ProcesoEvaluar", "HeaC_Evaluador", "HeaC_Area", "HeaC_Horno", "HeaC_Supervisor", "HeaC_Operador1", "HeaC_Operador2", "HeaC_Operador3", "HeaC_Operador4", "HeaC_Operador5", "HeaC_Operador6", "HeaC_Operador7", "HeaC_Operador8", "HeaC_Supervisor1", "HeaC_Supervisor2", "HeaC_Supervisor3", "HeaC_Supervisor4", "HeaC_Supervisor5", "HeaC_Supervisor6", "HeaC_jefe1", "HeaC_jefe2", "HeaC_Comentarios", "HeaC_Comentarios1", "HeaC_Comentarios2", "HeaC_Comentarios3", "HeaC_Comentarios4", "HeaC_Comentarios5", "HeaC_Comentarios6", "HeaC_Comentarios7", "HeaC_Comentarios8", "HeaC_Comentarios9", "HeaC_Comentarios10", "HeaC_Comentarios11", "HeaC_Comentarios12", "HeaC_Comentarios13", "HeaC_Comentarios14", "HeaC_Comentarios15", "HeaC_Comentarios16", "HeaC_FechaHoraCrea", "HeaC_UsuarioCrea", "HeaC_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->Ref_Codigo, 
      $this->Usu_Codigo, 
      $this->HeaC_fecha, 
      $this->HeaC_ProcesoEvaluar, 
      $this->HeaC_Evaluador, 
      $this->HeaC_Area, 
      $this->HeaC_Horno, 
      $this->HeaC_Supervisor, 
      $this->HeaC_Operador1, 
      $this->HeaC_Operador2, 
      $this->HeaC_Operador3, 
      $this->HeaC_Operador4, 
      $this->HeaC_Operador5, 
      $this->HeaC_Operador6, 
      $this->HeaC_Operador7, 
      $this->HeaC_Operador8, 
      $this->HeaC_Supervisor1, 
      $this->HeaC_Supervisor2, 
      $this->HeaC_Supervisor3, 
      $this->HeaC_Supervisor4, 
      $this->HeaC_Supervisor5, 
      $this->HeaC_Supervisor6, 
      $this->HeaC_jefe1, 
      $this->HeaC_jefe2, 
      $this->HeaC_Comentarios, 
      $this->HeaC_Comentarios1, 
      $this->HeaC_Comentarios2, 
      $this->HeaC_Comentarios3, 
      $this->HeaC_Comentarios4, 
      $this->HeaC_Comentarios5, 
      $this->HeaC_Comentarios6, 
      $this->HeaC_Comentarios7, 
      $this->HeaC_Comentarios8, 
      $this->HeaC_Comentarios9, 
      $this->HeaC_Comentarios10, 
      $this->HeaC_Comentarios11, 
      $this->HeaC_Comentarios12, 
      $this->HeaC_Comentarios13, 
      $this->HeaC_Comentarios14, 
      $this->HeaC_Comentarios15, 
      $this->HeaC_Comentarios16, 
      $this->HeaC_FechaHoraCrea, 
      $this->HeaC_UsuarioCrea, 
      $this->HeaC_Estado
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
    $sql =  "SELECT * FROM health_check WHERE HeaC_Codigo = :cod";
    $parametros = array(":cod"=>$this->HeaC_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setRef_Codigo($res[2]);
      $this->setUsu_Codigo($res[3]);
      $this->setHeaC_fecha($res[4]);
      $this->setHeaC_ProcesoEvaluar($res[5]);
      $this->setHeaC_Evaluador($res[6]);
      $this->setHeaC_Area($res[7]);
      $this->setHeaC_Horno($res[8]);
      $this->setHeaC_Supervisor($res[9]);
      $this->setHeaC_Operador1($res[10]);
      $this->setHeaC_Operador2($res[11]);
      $this->setHeaC_Operador3($res[12]);
      $this->setHeaC_Operador4($res[13]);
      $this->setHeaC_Operador5($res[14]);
      $this->setHeaC_Operador6($res[15]);
      $this->setHeaC_Operador7($res[16]);
      $this->setHeaC_Operador8($res[17]);
      $this->setHeaC_Supervisor1($res[18]);
      $this->setHeaC_Supervisor2($res[19]);
      $this->setHeaC_Supervisor3($res[20]);
      $this->setHeaC_Supervisor4($res[21]);
      $this->setHeaC_Supervisor5($res[22]);
      $this->setHeaC_Supervisor6($res[23]);
      $this->setHeaC_jefe1($res[24]);
      $this->setHeaC_jefe2($res[25]);
      $this->setHeaC_Comentarios($res[26]);
      $this->setHeaC_Comentarios1($res[27]);
      $this->setHeaC_Comentarios2($res[28]);
      $this->setHeaC_Comentarios3($res[29]);
      $this->setHeaC_Comentarios4($res[30]);
      $this->setHeaC_Comentarios5($res[31]);
      $this->setHeaC_Comentarios6($res[32]);
      $this->setHeaC_Comentarios7($res[33]);
      $this->setHeaC_Comentarios8($res[34]);
      $this->setHeaC_Comentarios9($res[35]);
      $this->setHeaC_Comentarios10($res[36]);
      $this->setHeaC_Comentarios11($res[37]);
      $this->setHeaC_Comentarios12($res[38]);
      $this->setHeaC_Comentarios13($res[39]);
      $this->setHeaC_Comentarios14($res[40]);
      $this->setHeaC_Comentarios15($res[41]);
      $this->setHeaC_Comentarios16($res[42]);
      $this->setHeaC_FechaHoraCrea($res[43]);
      $this->setHeaC_UsuarioCrea($res[44]);
      $this->setHeaC_Estado($res[45]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Ref_Codigo", "Usu_Codigo", "HeaC_fecha", "HeaC_ProcesoEvaluar", "HeaC_Evaluador", "HeaC_Area", "HeaC_Horno", "HeaC_Supervisor", "HeaC_Operador1", "HeaC_Operador2", "HeaC_Operador3", "HeaC_Operador4", "HeaC_Operador5", "HeaC_Operador6", "HeaC_Operador7", "HeaC_Operador8", "HeaC_Supervisor1", "HeaC_Supervisor2", "HeaC_Supervisor3", "HeaC_Supervisor4", "HeaC_Supervisor5", "HeaC_Supervisor6", "HeaC_jefe1", "HeaC_jefe2", "HeaC_Comentarios", "HeaC_Comentarios1", "HeaC_Comentarios2", "HeaC_Comentarios3", "HeaC_Comentarios4", "HeaC_Comentarios5", "HeaC_Comentarios6", "HeaC_Comentarios7", "HeaC_Comentarios8", "HeaC_Comentarios9", "HeaC_Comentarios10", "HeaC_Comentarios11", "HeaC_Comentarios12", "HeaC_Comentarios13", "HeaC_Comentarios14", "HeaC_Comentarios15", "HeaC_Comentarios16", "HeaC_FechaHoraCrea", "HeaC_UsuarioCrea", "HeaC_Estado");
    $valores = array($this->getPla_Codigo(), $this->getRef_Codigo(), $this->getUsu_Codigo(), $this->getHeaC_fecha(), $this->getHeaC_ProcesoEvaluar(), $this->getHeaC_Evaluador(), $this->getHeaC_Area(), $this->getHeaC_Horno(), $this->getHeaC_Supervisor(), $this->getHeaC_Operador1(), $this->getHeaC_Operador2(), $this->getHeaC_Operador3(), $this->getHeaC_Operador4(), $this->getHeaC_Operador5(), $this->getHeaC_Operador6(), $this->getHeaC_Operador7(), $this->getHeaC_Operador8(), $this->getHeaC_Supervisor1(), $this->getHeaC_Supervisor2(), $this->getHeaC_Supervisor3(), $this->getHeaC_Supervisor4(), $this->getHeaC_Supervisor5(), $this->getHeaC_Supervisor6(), $this->getHeaC_jefe1(), $this->getHeaC_jefe2(), $this->getHeaC_Comentarios(), $this->getHeaC_Comentarios1(), $this->getHeaC_Comentarios2(), $this->getHeaC_Comentarios3(), $this->getHeaC_Comentarios4(), $this->getHeaC_Comentarios5(), $this->getHeaC_Comentarios6(), $this->getHeaC_Comentarios7(), $this->getHeaC_Comentarios8(), $this->getHeaC_Comentarios9(), $this->getHeaC_Comentarios10(), $this->getHeaC_Comentarios11(), $this->getHeaC_Comentarios12(), $this->getHeaC_Comentarios13(), $this->getHeaC_Comentarios14(), $this->getHeaC_Comentarios15(), $this->getHeaC_Comentarios16(), $this->getHeaC_FechaHoraCrea(), $this->getHeaC_UsuarioCrea(), $this->getHeaC_Estado());
    $llaveprimaria = "HeaC_Codigo";
    $valorllaveprimaria = $this->getHeaC_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM health_check WHERE HeaC_Codigo = :cod";
    $parametros = array(":cod"=>$this->HeaC_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
   
  /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function healthCheckListar($fechaI, $fechaF, $area, $referencia, $planta){

    $parametros = array(":fecI"=>$fechaI." 00:00:00", ":fecF"=>$fechaF." 23:59:59", ":pla"=>$planta);

    $sql = "SELECT HeaC_Codigo, HeaC_fecha, CONCAT_WS(' ',eva.Usu_Nombres, eva.Usu_Apellidos) as Evaluador, CONCAT_WS(' ',supe.Usu_Nombres, supe.Usu_Apellidos) AS supervisor, HeaC_Comentarios, HeaC_Area, Ref_Descripcion, HeaC_UsuarioCrea
    FROM health_check 
    LEFT JOIN usuarios eva ON health_check.HeaC_Evaluador = eva.Usu_Codigo
    LEFT JOIN usuarios supe ON health_check.HeaC_Supervisor = supe.Usu_Codigo
    LEFT JOIN referencias ON health_check.Ref_Codigo = referencias.Ref_Codigo AND Ref_Estado = 1
    WHERE HeaC_Estado = 1 AND HeaC_fecha BETWEEN :fecI AND :fecF AND health_check.Pla_Codigo = :pla
    ";
    
    if ( $area != "" ) {
      $pri = 1;
      foreach ( $area as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " HeaC_Area = :are" . $pri . " ";
        $parametros[ ':are' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
   
    
    if($referencia != ""){ 
      $pri2 = 1; 
      foreach($referencia as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " health_check.Ref_Codigo = :ref".$pri2." "; 
        $parametros[':ref'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
     $sql .= " ORDER BY HeaC_fecha ASC";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function healthCheckListarExcel($fechaI, $fechaF, $area, $referencia, $planta){

    $parametros = array(":fecI"=>$fechaI." 00:00:00", ":fecF"=>$fechaF." 23:59:59", ":pla"=>$planta);

    $sql = "SELECT HeaC_Codigo, HeaC_fecha, CONCAT_WS(' ',eva.Usu_Nombres, eva.Usu_Apellidos) as Evaluador, CONCAT_WS(' ',supe.Usu_Nombres, supe.Usu_Apellidos) AS supervisor, HeaC_Comentarios, HeaC_Area, Ref_Descripcion, HeaC_UsuarioCrea
    FROM health_check 
    LEFT JOIN usuarios eva ON health_check.HeaC_Evaluador = eva.Usu_Codigo
    LEFT JOIN usuarios supe ON health_check.HeaC_Supervisor = supe.Usu_Codigo
    LEFT JOIN referencias ON health_check.Ref_Codigo = referencias.Ref_Codigo AND Ref_Estado = 1
    WHERE HeaC_Estado = 1 AND HeaC_fecha BETWEEN :fecI AND :fecF AND health_check.Pla_Codigo = :pla
    ";
    
    if ( $area != "null" ) {
      $pri = 1;
      foreach ( $area as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " HeaC_Area = :are" . $pri . " ";
        $parametros[ ':are' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
   
    
    if($referencia != "null"){ 
      $pri2 = 1; 
      foreach($referencia as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " health_check.Ref_Codigo = :ref".$pri2." "; 
        $parametros[':ref'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
     $sql .= " ORDER BY HeaC_fecha ASC";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
