<?php
require_once('basedatos.php');

  class variables extends basedatos {
    private $Var_Codigo;
    private $Maq_Codigo;
    private $For_Codigo;
    private $DetFT_Codigo;
    private $Var_Familia;
    private $Var_Color;
    private $Var_Nombre;
    private $Var_Foto;
    private $Var_Tipo;
    private $Var_Origen;
    private $Var_UnidadMedida;
    private $Var_ValorControl;
    private $Var_ValorTolerancia;
    private $Var_Operador;
    private $Var_TipoVariable;
    private $Var_PuntoControl;
    private $Var_Archivo;
    private $Var_Orden;
    private $Var_FechaHoraCrea;
    private $Var_UsuarioCrea;
    private $Var_Estado;
    private $Var_Hora00;
    private $Var_Hora01;
    private $Var_Hora02;
    private $Var_Hora03;
    private $Var_Hora04;
    private $Var_Hora05;
    private $Var_Hora06;
    private $Var_Hora07;
    private $Var_Hora08;
    private $Var_Hora09;
    private $Var_Hora10;
    private $Var_Hora11;
    private $Var_Hora12;
    private $Var_Hora13;
    private $Var_Hora14;
    private $Var_Hora15;
    private $Var_Hora16;
    private $Var_Hora17;
    private $Var_Hora18;
    private $Var_Hora19;
    private $Var_Hora20;
    private $Var_Hora21;
    private $Var_Hora22;
    private $Var_Hora23;

  function __construct($Var_Codigo = NULL, $Maq_Codigo = NULL, $For_Codigo = NULL, $DetFT_Codigo = NULL, $Var_Familia = NULL, $Var_Color = NULL, $Var_Nombre = NULL, $Var_Foto = NULL, $Var_Tipo = NULL, $Var_Origen = NULL, $Var_UnidadMedida = NULL, $Var_ValorControl = NULL, $Var_ValorTolerancia = NULL, $Var_Operador = NULL, $Var_TipoVariable = NULL, $Var_PuntoControl = NULL, $Var_Archivo = NULL, $Var_Orden = NULL, $Var_FechaHoraCrea = NULL, $Var_UsuarioCrea = NULL, $Var_Estado = NULL, $Var_Hora00 = NULL, $Var_Hora01 = NULL, $Var_Hora02 = NULL, $Var_Hora03 = NULL, $Var_Hora04 = NULL, $Var_Hora05 = NULL, $Var_Hora06 = NULL, $Var_Hora07 = NULL, $Var_Hora08 = NULL, $Var_Hora09 = NULL, $Var_Hora10 = NULL, $Var_Hora11 = NULL, $Var_Hora12 = NULL, $Var_Hora13 = NULL, $Var_Hora14 = NULL, $Var_Hora15 = NULL, $Var_Hora16 = NULL, $Var_Hora17 = NULL, $Var_Hora18 = NULL, $Var_Hora19 = NULL, $Var_Hora20 = NULL, $Var_Hora21 = NULL, $Var_Hora22 = NULL, $Var_Hora23 = NULL) {
    $this->Var_Codigo = $Var_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->DetFT_Codigo = $DetFT_Codigo;
    $this->Var_Familia = $Var_Familia;
    $this->Var_Color = $Var_Color;
    $this->Var_Nombre = $Var_Nombre;
    $this->Var_Foto = $Var_Foto;
    $this->Var_Tipo = $Var_Tipo;
    $this->Var_Origen = $Var_Origen;
    $this->Var_UnidadMedida = $Var_UnidadMedida;
    $this->Var_ValorControl = $Var_ValorControl;
    $this->Var_ValorTolerancia = $Var_ValorTolerancia;
    $this->Var_Operador = $Var_Operador;
    $this->Var_TipoVariable = $Var_TipoVariable;
    $this->Var_PuntoControl = $Var_PuntoControl;
    $this->Var_Archivo = $Var_Archivo;
    $this->Var_Orden = $Var_Orden;
    $this->Var_FechaHoraCrea = $Var_FechaHoraCrea;
    $this->Var_UsuarioCrea = $Var_UsuarioCrea;
    $this->Var_Estado = $Var_Estado;
    $this->Var_Hora00 = $Var_Hora00;
    $this->Var_Hora01 = $Var_Hora01;
    $this->Var_Hora02 = $Var_Hora02;
    $this->Var_Hora03 = $Var_Hora03;
    $this->Var_Hora04 = $Var_Hora04;
    $this->Var_Hora05 = $Var_Hora05;
    $this->Var_Hora06 = $Var_Hora06;
    $this->Var_Hora07 = $Var_Hora07;
    $this->Var_Hora08 = $Var_Hora08;
    $this->Var_Hora09 = $Var_Hora09;
    $this->Var_Hora10 = $Var_Hora10;
    $this->Var_Hora11 = $Var_Hora11;
    $this->Var_Hora12 = $Var_Hora12;
    $this->Var_Hora13 = $Var_Hora13;
    $this->Var_Hora14 = $Var_Hora14;
    $this->Var_Hora15 = $Var_Hora15;
    $this->Var_Hora16 = $Var_Hora16;
    $this->Var_Hora17 = $Var_Hora17;
    $this->Var_Hora18 = $Var_Hora18;
    $this->Var_Hora19 = $Var_Hora19;
    $this->Var_Hora20 = $Var_Hora20;
    $this->Var_Hora21 = $Var_Hora21;
    $this->Var_Hora22 = $Var_Hora22;
    $this->Var_Hora23 = $Var_Hora23;
    $this->tabla = "variables";
  }

  function getVar_Codigo() {
    return $this->Var_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getDetFT_Codigo() {
    return $this->DetFT_Codigo;
  }

  function getVar_Familia() {
    return $this->Var_Familia;
  }

  function getVar_Color() {
    return $this->Var_Color;
  }

  function getVar_Nombre() {
    return $this->Var_Nombre;
  }

  function getVar_Foto() {
    return $this->Var_Foto;
  }

  function getVar_Tipo() {
    return $this->Var_Tipo;
  }

  function getVar_Origen() {
    return $this->Var_Origen;
  }

  function getVar_UnidadMedida() {
    return $this->Var_UnidadMedida;
  }

  function getVar_ValorControl() {
    return $this->Var_ValorControl;
  }

  function getVar_ValorTolerancia() {
    return $this->Var_ValorTolerancia;
  }

  function getVar_Operador() {
    return $this->Var_Operador;
  }

  function getVar_TipoVariable() {
    return $this->Var_TipoVariable;
  }

  function getVar_PuntoControl() {
    return $this->Var_PuntoControl;
  }

  function getVar_Archivo() {
    return $this->Var_Archivo;
  }

  function getVar_Orden() {
    return $this->Var_Orden;
  }

  function getVar_FechaHoraCrea() {
    return $this->Var_FechaHoraCrea;
  }

  function getVar_UsuarioCrea() {
    return $this->Var_UsuarioCrea;
  }

  function getVar_Estado() {
    return $this->Var_Estado;
  }

  function getVar_Hora00() {
    return $this->Var_Hora00;
  }

  function getVar_Hora01() {
    return $this->Var_Hora01;
  }

  function getVar_Hora02() {
    return $this->Var_Hora02;
  }

  function getVar_Hora03() {
    return $this->Var_Hora03;
  }

  function getVar_Hora04() {
    return $this->Var_Hora04;
  }

  function getVar_Hora05() {
    return $this->Var_Hora05;
  }

  function getVar_Hora06() {
    return $this->Var_Hora06;
  }

  function getVar_Hora07() {
    return $this->Var_Hora07;
  }

  function getVar_Hora08() {
    return $this->Var_Hora08;
  }

  function getVar_Hora09() {
    return $this->Var_Hora09;
  }

  function getVar_Hora10() {
    return $this->Var_Hora10;
  }

  function getVar_Hora11() {
    return $this->Var_Hora11;
  }

  function getVar_Hora12() {
    return $this->Var_Hora12;
  }

  function getVar_Hora13() {
    return $this->Var_Hora13;
  }

  function getVar_Hora14() {
    return $this->Var_Hora14;
  }

  function getVar_Hora15() {
    return $this->Var_Hora15;
  }

  function getVar_Hora16() {
    return $this->Var_Hora16;
  }

  function getVar_Hora17() {
    return $this->Var_Hora17;
  }

  function getVar_Hora18() {
    return $this->Var_Hora18;
  }

  function getVar_Hora19() {
    return $this->Var_Hora19;
  }

  function getVar_Hora20() {
    return $this->Var_Hora20;
  }

  function getVar_Hora21() {
    return $this->Var_Hora21;
  }

  function getVar_Hora22() {
    return $this->Var_Hora22;
  }

  function getVar_Hora23() {
    return $this->Var_Hora23;
  }

  function setVar_Codigo($Var_Codigo) {
    $this->Var_Codigo = $Var_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setDetFT_Codigo($DetFT_Codigo) {
    $this->DetFT_Codigo = $DetFT_Codigo;
  }

  function setVar_Familia($Var_Familia) {
    $this->Var_Familia = $Var_Familia;
  }

  function setVar_Color($Var_Color) {
    $this->Var_Color = $Var_Color;
  }

  function setVar_Nombre($Var_Nombre) {
    $this->Var_Nombre = $Var_Nombre;
  }

  function setVar_Foto($Var_Foto) {
    $this->Var_Foto = $Var_Foto;
  }

  function setVar_Tipo($Var_Tipo) {
    $this->Var_Tipo = $Var_Tipo;
  }

  function setVar_Origen($Var_Origen) {
    $this->Var_Origen = $Var_Origen;
  }

  function setVar_UnidadMedida($Var_UnidadMedida) {
    $this->Var_UnidadMedida = $Var_UnidadMedida;
  }

  function setVar_ValorControl($Var_ValorControl) {
    $this->Var_ValorControl = $Var_ValorControl;
  }

  function setVar_ValorTolerancia($Var_ValorTolerancia) {
    $this->Var_ValorTolerancia = $Var_ValorTolerancia;
  }

  function setVar_Operador($Var_Operador) {
    $this->Var_Operador = $Var_Operador;
  }

  function setVar_TipoVariable($Var_TipoVariable) {
    $this->Var_TipoVariable = $Var_TipoVariable;
  }

  function setVar_PuntoControl($Var_PuntoControl) {
    $this->Var_PuntoControl = $Var_PuntoControl;
  }

  function setVar_Archivo($Var_Archivo) {
    $this->Var_Archivo = $Var_Archivo;
  }

  function setVar_Orden($Var_Orden) {
    $this->Var_Orden = $Var_Orden;
  }

  function setVar_FechaHoraCrea($Var_FechaHoraCrea) {
    $this->Var_FechaHoraCrea = $Var_FechaHoraCrea;
  }

  function setVar_UsuarioCrea($Var_UsuarioCrea) {
    $this->Var_UsuarioCrea = $Var_UsuarioCrea;
  }

  function setVar_Estado($Var_Estado) {
    $this->Var_Estado = $Var_Estado;
  }

  function setVar_Hora00($Var_Hora00) {
    $this->Var_Hora00 = $Var_Hora00;
  }

  function setVar_Hora01($Var_Hora01) {
    $this->Var_Hora01 = $Var_Hora01;
  }

  function setVar_Hora02($Var_Hora02) {
    $this->Var_Hora02 = $Var_Hora02;
  }

  function setVar_Hora03($Var_Hora03) {
    $this->Var_Hora03 = $Var_Hora03;
  }

  function setVar_Hora04($Var_Hora04) {
    $this->Var_Hora04 = $Var_Hora04;
  }

  function setVar_Hora05($Var_Hora05) {
    $this->Var_Hora05 = $Var_Hora05;
  }

  function setVar_Hora06($Var_Hora06) {
    $this->Var_Hora06 = $Var_Hora06;
  }

  function setVar_Hora07($Var_Hora07) {
    $this->Var_Hora07 = $Var_Hora07;
  }

  function setVar_Hora08($Var_Hora08) {
    $this->Var_Hora08 = $Var_Hora08;
  }

  function setVar_Hora09($Var_Hora09) {
    $this->Var_Hora09 = $Var_Hora09;
  }

  function setVar_Hora10($Var_Hora10) {
    $this->Var_Hora10 = $Var_Hora10;
  }

  function setVar_Hora11($Var_Hora11) {
    $this->Var_Hora11 = $Var_Hora11;
  }

  function setVar_Hora12($Var_Hora12) {
    $this->Var_Hora12 = $Var_Hora12;
  }

  function setVar_Hora13($Var_Hora13) {
    $this->Var_Hora13 = $Var_Hora13;
  }

  function setVar_Hora14($Var_Hora14) {
    $this->Var_Hora14 = $Var_Hora14;
  }

  function setVar_Hora15($Var_Hora15) {
    $this->Var_Hora15 = $Var_Hora15;
  }

  function setVar_Hora16($Var_Hora16) {
    $this->Var_Hora16 = $Var_Hora16;
  }

  function setVar_Hora17($Var_Hora17) {
    $this->Var_Hora17 = $Var_Hora17;
  }

  function setVar_Hora18($Var_Hora18) {
    $this->Var_Hora18 = $Var_Hora18;
  }

  function setVar_Hora19($Var_Hora19) {
    $this->Var_Hora19 = $Var_Hora19;
  }

  function setVar_Hora20($Var_Hora20) {
    $this->Var_Hora20 = $Var_Hora20;
  }

  function setVar_Hora21($Var_Hora21) {
    $this->Var_Hora21 = $Var_Hora21;
  }

  function setVar_Hora22($Var_Hora22) {
    $this->Var_Hora22 = $Var_Hora22;
  }

  function setVar_Hora23($Var_Hora23) {
    $this->Var_Hora23 = $Var_Hora23;
  }

  public function insertar(){
    $campos = array("Maq_Codigo", "For_Codigo", "DetFT_Codigo", "Var_Familia", "Var_Color", "Var_Nombre", "Var_Foto", "Var_Tipo", "Var_Origen", "Var_UnidadMedida", "Var_ValorControl", "Var_ValorTolerancia", "Var_Operador", "Var_TipoVariable", "Var_PuntoControl", "Var_Archivo", "Var_Orden", "Var_FechaHoraCrea", "Var_UsuarioCrea", "Var_Estado", "Var_Hora00", "Var_Hora01", "Var_Hora02", "Var_Hora03", "Var_Hora04", "Var_Hora05", "Var_Hora06", "Var_Hora07", "Var_Hora08", "Var_Hora09", "Var_Hora10", "Var_Hora11", "Var_Hora12", "Var_Hora13", "Var_Hora14", "Var_Hora15", "Var_Hora16", "Var_Hora17", "Var_Hora18", "Var_Hora19", "Var_Hora20", "Var_Hora21", "Var_Hora22", "Var_Hora23");
    $valores = array(
    array( 
      $this->Maq_Codigo, 
      $this->For_Codigo, 
      $this->DetFT_Codigo, 
      $this->Var_Familia, 
      $this->Var_Color, 
      $this->Var_Nombre, 
      $this->Var_Foto, 
      $this->Var_Tipo, 
      $this->Var_Origen, 
      $this->Var_UnidadMedida, 
      $this->Var_ValorControl, 
      $this->Var_ValorTolerancia, 
      $this->Var_Operador, 
      $this->Var_TipoVariable, 
      $this->Var_PuntoControl, 
      $this->Var_Archivo, 
      $this->Var_Orden, 
      $this->Var_FechaHoraCrea, 
      $this->Var_UsuarioCrea, 
      $this->Var_Estado, 
      $this->Var_Hora00, 
      $this->Var_Hora01, 
      $this->Var_Hora02, 
      $this->Var_Hora03, 
      $this->Var_Hora04, 
      $this->Var_Hora05, 
      $this->Var_Hora06, 
      $this->Var_Hora07, 
      $this->Var_Hora08, 
      $this->Var_Hora09, 
      $this->Var_Hora10, 
      $this->Var_Hora11, 
      $this->Var_Hora12, 
      $this->Var_Hora13, 
      $this->Var_Hora14, 
      $this->Var_Hora15, 
      $this->Var_Hora16, 
      $this->Var_Hora17, 
      $this->Var_Hora18, 
      $this->Var_Hora19, 
      $this->Var_Hora20, 
      $this->Var_Hora21, 
      $this->Var_Hora22, 
      $this->Var_Hora23
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
    $sql =  "SELECT * FROM variables WHERE Var_Codigo = :cod";
    $parametros = array(":cod"=>$this->Var_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setMaq_Codigo($res[1]);
      $this->setFor_Codigo($res[2]);
      $this->setDetFT_Codigo($res[3]);
      $this->setVar_Familia($res[4]);
      $this->setVar_Color($res[5]);
      $this->setVar_Nombre($res[6]);
      $this->setVar_Foto($res[7]);
      $this->setVar_Tipo($res[8]);
      $this->setVar_Origen($res[9]);
      $this->setVar_UnidadMedida($res[10]);
      $this->setVar_ValorControl($res[11]);
      $this->setVar_ValorTolerancia($res[12]);
      $this->setVar_Operador($res[13]);
      $this->setVar_TipoVariable($res[14]);
      $this->setVar_PuntoControl($res[15]);
      $this->setVar_Archivo($res[16]);
      $this->setVar_Orden($res[17]);
      $this->setVar_FechaHoraCrea($res[18]);
      $this->setVar_UsuarioCrea($res[19]);
      $this->setVar_Estado($res[20]);
      $this->setVar_Hora00($res[21]);
      $this->setVar_Hora01($res[22]);
      $this->setVar_Hora02($res[23]);
      $this->setVar_Hora03($res[24]);
      $this->setVar_Hora04($res[25]);
      $this->setVar_Hora05($res[26]);
      $this->setVar_Hora06($res[27]);
      $this->setVar_Hora07($res[28]);
      $this->setVar_Hora08($res[29]);
      $this->setVar_Hora09($res[30]);
      $this->setVar_Hora10($res[31]);
      $this->setVar_Hora11($res[32]);
      $this->setVar_Hora12($res[33]);
      $this->setVar_Hora13($res[34]);
      $this->setVar_Hora14($res[35]);
      $this->setVar_Hora15($res[36]);
      $this->setVar_Hora16($res[37]);
      $this->setVar_Hora17($res[38]);
      $this->setVar_Hora18($res[39]);
      $this->setVar_Hora19($res[40]);
      $this->setVar_Hora20($res[41]);
      $this->setVar_Hora21($res[42]);
      $this->setVar_Hora22($res[43]);
      $this->setVar_Hora23($res[44]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Maq_Codigo", "For_Codigo", "DetFT_Codigo", "Var_Familia", "Var_Color", "Var_Nombre", "Var_Foto", "Var_Tipo", "Var_Origen", "Var_UnidadMedida", "Var_ValorControl", "Var_ValorTolerancia", "Var_Operador", "Var_TipoVariable", "Var_PuntoControl", "Var_Archivo", "Var_Orden", "Var_FechaHoraCrea", "Var_UsuarioCrea", "Var_Estado", "Var_Hora00", "Var_Hora01", "Var_Hora02", "Var_Hora03", "Var_Hora04", "Var_Hora05", "Var_Hora06", "Var_Hora07", "Var_Hora08", "Var_Hora09", "Var_Hora10", "Var_Hora11", "Var_Hora12", "Var_Hora13", "Var_Hora14", "Var_Hora15", "Var_Hora16", "Var_Hora17", "Var_Hora18", "Var_Hora19", "Var_Hora20", "Var_Hora21", "Var_Hora22", "Var_Hora23");
    $valores = array($this->getMaq_Codigo(), $this->getFor_Codigo(), $this->getDetFT_Codigo(), $this->getVar_Familia(), $this->getVar_Color(), $this->getVar_Nombre(), $this->getVar_Foto(), $this->getVar_Tipo(), $this->getVar_Origen(), $this->getVar_UnidadMedida(), $this->getVar_ValorControl(), $this->getVar_ValorTolerancia(), $this->getVar_Operador(), $this->getVar_TipoVariable(), $this->getVar_PuntoControl(), $this->getVar_Archivo(), $this->getVar_Orden(), $this->getVar_FechaHoraCrea(), $this->getVar_UsuarioCrea(), $this->getVar_Estado(), $this->getVar_Hora00(), $this->getVar_Hora01(), $this->getVar_Hora02(), $this->getVar_Hora03(), $this->getVar_Hora04(), $this->getVar_Hora05(), $this->getVar_Hora06(), $this->getVar_Hora07(), $this->getVar_Hora08(), $this->getVar_Hora09(), $this->getVar_Hora10(), $this->getVar_Hora11(), $this->getVar_Hora12(), $this->getVar_Hora13(), $this->getVar_Hora14(), $this->getVar_Hora15(), $this->getVar_Hora16(), $this->getVar_Hora17(), $this->getVar_Hora18(), $this->getVar_Hora19(), $this->getVar_Hora20(), $this->getVar_Hora21(), $this->getVar_Hora22(), $this->getVar_Hora23());
    $llaveprimaria = "Var_Codigo";
    $valorllaveprimaria = $this->getVar_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM variables WHERE Var_Codigo = :cod";
    $parametros = array(":cod"=>$this->Var_Codigo);
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
  public function listarVariablesPrincipal($estado, $usuario, $planta, $area, $maquina) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario );

    $sql = "SELECT Var_Codigo, maquinas.Maq_Nombre, areas.Are_Nombre, plantas.Pla_Nombre, Var_Nombre,
      IF( Var_Tipo = 1, 'Texto',
        IF( Var_Tipo = 2, 'Numérico Entero',
          IF( Var_Tipo = 3, 'Numérico Decimal',
            IF( Var_Tipo = 4, 'Si/No', 'No existe el tipo' ) ) ) ) as Tipo,
      IF( Var_Origen = 1, 'Ficha Técnica',
        IF( Var_Origen = 2, 'Máquina',
          IF( Var_Origen = 3, 'Sin Formato', 'No existe' ) ) ) as Origen, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
      IF( Var_Operador = 1, '>=',
        IF( Var_Operador = 2, '<=',
          IF( Var_Operador = 3, '+-', 'Sin operador' ) ) ) as Operador, Var_Estado,
      IF( Var_TipoVariable = 1, 'Variable crítica', 
        IF( Var_TipoVariable = 2, 'Variable mayor', 
         IF( Var_TipoVariable = 3, 'Variable menor', 'Sin clasificación' 
         ))) as TipoVariable,
       IF( Var_PuntoControl = 1, 'Tipo Control', 
        IF( Var_PuntoControl = 2, 'Tipo Verificación', 'No existe el tipo' 
         )) as puntoControl, Var_Orden
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE Var_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu AND Var_Origen = 3 ";
	
	if($planta != ""){ 
      $pri = 1; 
      foreach($planta as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " plantas.Pla_Codigo = :pla".$pri." "; 
        $parametros[':pla'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($area != ""){ 
      $pri4 = 1; 
      foreach($area as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " areas.Are_Codigo = :are".$pri4." "; 
        $parametros[':are'.$pri4] = $registro4; 
        $pri4++; 
      } 
      $sql .= " )"; 
    }
	  
	if($maquina != ""){ 
      $pri3 = 1; 
      foreach($maquina as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " maquinas.Maq_Codigo = :maq".$pri3." "; 
        $parametros[':maq'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
	$sql .= " ORDER BY Var_Nombre";
    
    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function hallarCodigoInsertParametrosVariables($maquina, $formato, $familia, $color, $variable, $usuario, $origen){

    $parametros = array(":maq"=>$maquina, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":var"=>$variable, ":usu"=>$usuario, ":ori"=>$origen);

    $sql = "SELECT Var_Codigo
FROM variables
WHERE Maq_Codigo = :maq AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Var_Nombre = :var AND Var_UsuarioCrea = :usu AND Var_Origen = :ori
ORDER BY Var_Codigo DESC
LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
	

  /*
    Autor: Natalia Rodríguez
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarUltimoRegistroUsuarioVar( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT Var_Codigo
    FROM variables
    WHERE Var_Estado = 1 AND Var_UsuarioCrea = :usu
    ORDER BY Var_Codigo DESC
    LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
  
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function updateInactivarFichaActualVariables($familia, $color, $formato){

    $parametros = array(":fam"=>$familia, ":col"=>$color, ":for"=>$formato);

    $sql = "UPDATE variables SET Var_Estado = 0 WHERE Var_Familia = :fam AND Var_Color = :col AND For_Codigo = :for";

    $this->consultaSQL($sql, $parametros);
    $this->desconectar();
  }
  
  
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarVariablesObjetivos($referenciaConsulta, $formato, $familia, $color, $turno){

    $sql = "SELECT DISTINCT v1.Var_Nombre, m1.Are_Codigo, a1.Are_Nombre, pt1.PueT_Nombre,
    (SELECT COUNT(DISTINCT Fre_Hora)
    FROM frecuencias
    INNER JOIN variables v2 ON frecuencias.Var_Codigo = v2.Var_Codigo
    INNER JOIN maquinas m2 ON v2.Maq_Codigo = m2.Maq_Codigo AND m2.Maq_Estado = 1
    INNER JOIN areas a2 ON m2.Are_Codigo = a2.Are_Codigo AND a2.Are_Estado = 1
    INNER JOIN estaciones_areas ea2 ON a2.Are_Codigo = ea2.Are_Codigo AND ea2.EstA_Estado = 1
    INNER JOIN puestos_trabajos pt2 ON ea2.EstA_Codigo = pt2.EstA_Codigo AND pt2.PueT_Estado = 1
    WHERE v2.Var_Nombre = v1.Var_Nombre AND v2.Var_Estado = 1 AND pt2.PueT_Nombre = pt1.PueT_Nombre
    AND Fre_Estado = 1 ";
    
    if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (v2.For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND v2.Var_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND v2.Var_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
    if($turno != "-1"){
      $sql .= " AND Tur_Codigo = :tur";
      $parametros[':tur'] = $turno;
    }
    
    $sql .= "  AND m2.Maq_Nombre = m1.Maq_Nombre ) AS CantFre, m1.Maq_Nombre, v1.For_Codigo, v1.Var_Familia, v1.Var_Color FROM variables v1
    INNER JOIN maquinas m1 ON v1.Maq_Codigo = m1.Maq_Codigo AND m1.Maq_Estado = 1
    INNER JOIN estaciones_maquinas estm ON m1.Maq_Codigo = estm.Maq_Codigo AND EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas pte ON estm.EstM_Codigo = pte.EstM_Codigo AND PueTEM_Estado = 1
    INNER JOIN puestos_trabajos pt1 ON pte.PueT_Codigo = pt1.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN areas a1 ON m1.Are_Codigo = a1.Are_Codigo AND a1.Are_Estado = 1
    WHERE v1.Var_Estado = 1 ";
    
    if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (v1.For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND v1.Var_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND v1.Var_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
    $sql .=" ORDER BY v1.Var_Nombre ASC";

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
  public function listarVariablesObjetivosLogueo($formato, $familia, $color, $turno){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT DISTINCT v1.Var_Nombre, m1.Are_Codigo, a1.Are_Nombre, pt1.PueT_Nombre,
    (SELECT COUNT(DISTINCT Fre_Hora)
    FROM frecuencias
    INNER JOIN variables v2 ON frecuencias.Var_Codigo = v2.Var_Codigo
    INNER JOIN maquinas m2 ON v2.Maq_Codigo = m2.Maq_Codigo AND m2.Maq_Estado = 1
    INNER JOIN areas a2 ON m2.Are_Codigo = a2.Are_Codigo AND a2.Are_Estado = 1
    INNER JOIN estaciones_areas ea2 ON a2.Are_Codigo = ea2.Are_Codigo AND ea2.EstA_Estado = 1
    INNER JOIN puestos_trabajos pt2 ON ea2.EstA_Codigo = pt2.EstA_Codigo AND pt2.PueT_Estado = 1
    WHERE v2.Var_Nombre = v1.Var_Nombre AND v2.For_Codigo = :for AND v2.Var_Familia = :fam
    AND v2.Var_Color = :col AND v2.Var_Estado = 1 AND pt2.PueT_Nombre = pt1.PueT_Nombre
    AND Fre_Estado = 1 ";
    
    if($turno != "-1"){
      $sql .= " AND Tur_Codigo = :tur";
      $parametros[':tur'] = $turno;
    }
    
    $sql .= " AND m2.Maq_Nombre = m1.Maq_Nombre ) AS CantFre, m1.Maq_Nombre FROM variables v1
    INNER JOIN maquinas m1 ON v1.Maq_Codigo = m1.Maq_Codigo AND m1.Maq_Estado = 1
    INNER JOIN estaciones_maquinas estm ON m1.Maq_Codigo = estm.Maq_Codigo AND EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas pte ON estm.EstM_Codigo = pte.EstM_Codigo AND PueTEM_Estado = 1
    INNER JOIN puestos_trabajos pt1 ON pte.PueT_Codigo = pt1.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN areas a1 ON m1.Are_Codigo = a1.Are_Codigo AND a1.Are_Estado = 1
    WHERE v1.For_Codigo = :for AND v1.Var_Familia = :fam AND v1.Var_Color = :col
    AND v1.Var_Estado = 1 ORDER BY v1.Var_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
  /*
    Autor: Rx David
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarVariablesObjetivosLogueoRegistroNotificacionesTS($formato, $familia, $color, $listaHoras, $cantidadHoras, $fecha){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fec"=>$fecha);

    $sql = "SELECT DISTINCT v1.Var_Nombre, m1.Are_Codigo, a1.Are_Nombre, pt1.PueT_Nombre,
    SUM( ";
    
    $max = $cantidadHoras - 1;
    for($a = 0; $a < $cantidadHoras; $a++){
      $sql .= " IF(v1.Var_Hora".$listaHoras[$a]." IS NOT NULL, 1, 0) ";
      
      if($a < $max){
        $sql .= " + ";
      }
    }
    
    $sql .= " ) AS total,
     m1.Maq_Nombre, v1.Var_Codigo
    FROM variables v1
    INNER JOIN maquinas m1 ON v1.Maq_Codigo = m1.Maq_Codigo AND m1.Maq_Estado = 1
    INNER JOIN estaciones_maquinas estm ON m1.Maq_Codigo = estm.Maq_Codigo AND EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas pte ON estm.EstM_Codigo = pte.EstM_Codigo AND PueTEM_Estado = 1
    INNER JOIN puestos_trabajos pt1 ON pte.PueT_Codigo = pt1.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN areas a1 ON m1.Are_Codigo = a1.Are_Codigo AND a1.Are_Estado = 1
    WHERE v1.For_Codigo = :for AND v1.Var_Familia = :fam AND v1.Var_Color = :col AND v1.Var_FechaHoraCrea = :fec
    GROUP BY v1.Var_Nombre, m1.Are_Codigo, a1.Are_Nombre, pt1.PueT_Nombre, m1.Maq_Nombre
    ORDER BY v1.Var_Nombre ASC";
    
//    echo "-- listarVariablesObjetivosLogueoRegistroNotificacionesTS --"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";

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
  public function listarVariablesObjetivosLogueoMaPe($turno){

    $sql = "SELECT DISTINCT v1.Var_Nombre, m1.Are_Codigo, a1.Are_Nombre, pt1.PueT_Nombre,
    (SELECT COUNT(DISTINCT Fre_Hora)
    FROM frecuencias
    INNER JOIN variables v2 ON frecuencias.Var_Codigo = v2.Var_Codigo
    INNER JOIN maquinas m2 ON v2.Maq_Codigo = m2.Maq_Codigo AND m2.Maq_Estado = 1
    INNER JOIN areas a2 ON m2.Are_Codigo = a2.Are_Codigo AND a2.Are_Estado = 1
    INNER JOIN estaciones_areas ea2 ON a2.Are_Codigo = ea2.Are_Codigo AND ea2.EstA_Estado = 1
    INNER JOIN puestos_trabajos pt2 ON ea2.EstA_Codigo = pt2.EstA_Codigo AND pt2.PueT_Estado = 1
    WHERE v2.Var_Nombre = v1.Var_Nombre AND v2.Var_Estado = 1 AND pt2.PueT_Nombre = pt1.PueT_Nombre
    AND Fre_Estado = 1 ";
    
    if($turno != "-1"){
      $sql .= " AND Tur_Codigo = :tur";
      $parametros[':tur'] = $turno;
    }
    
    $sql .= " AND m2.Maq_Nombre = m1.Maq_Nombre AND v2.Var_Origen = '3' ) AS CantFre, m1.Maq_Nombre FROM variables v1
    INNER JOIN maquinas m1 ON v1.Maq_Codigo = m1.Maq_Codigo AND m1.Maq_Estado = 1
    INNER JOIN estaciones_maquinas estm ON m1.Maq_Codigo = estm.Maq_Codigo AND EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas pte ON estm.EstM_Codigo = pte.EstM_Codigo AND PueTEM_Estado = 1
    INNER JOIN puestos_trabajos pt1 ON pte.PueT_Codigo = pt1.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN areas a1 ON m1.Are_Codigo = a1.Are_Codigo AND a1.Are_Estado = 1
    WHERE v1.Var_Estado = 1 AND v1.Var_Origen = '3' ORDER BY v1.Var_Nombre ASC";

    $this->consultaSQL($sql,$parametros);
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
  public function listarVariablesConFrecuenciaUsuLogueados($formato, $familia, $color, $horaInicial, $horaFinal, $fecha, $agrupacion, $planta){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":horI"=>$horaInicial,":horF"=>$horaFinal,":agr"=>$agrupacion,":pla"=>$planta);

    $sql = "SELECT DISTINCT (COUNT(variables.Var_Codigo)), PueT_Nombre, Fre_Hora
    FROM puestos_trabajos_estaciones_maquinas 
    INNER JOIN puestos_trabajos ON puestos_trabajos_estaciones_maquinas.PueT_Codigo = puestos_trabajos.PueT_Codigo AND puestos_trabajos.PueT_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND estaciones_maquinas.EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1 
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1 
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1 
    INNER JOIN agrupaciones_areas ON maquinas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND agrupaciones.Agr_Estado = 1 
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)  
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Fre_Estado = 1   
    AND agrupaciones.Agr_Codigo = :agr AND Fre_Hora BETWEEN :horI AND :horF AND plantas.Pla_Codigo = :pla AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    GROUP BY Fre_Hora, PueT_Nombre 
    ORDER BY PueT_Nombre ASC, Fre_Hora ASC";

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
  public function listarVariablesConFrecuenciaUsuLogueadosMaPe($horaInicial, $horaFinal, $fecha, $agrupacion, $planta){

    $parametros = array(":horI"=>$horaInicial,":horF"=>$horaFinal,":agr"=>$agrupacion,":pla"=>$planta);

    $sql = "SELECT DISTINCT (COUNT(variables.Var_Codigo)), PueT_Nombre, Fre_Hora
    FROM puestos_trabajos_estaciones_maquinas 
    INNER JOIN puestos_trabajos ON puestos_trabajos_estaciones_maquinas.PueT_Codigo = puestos_trabajos.PueT_Codigo AND puestos_trabajos.PueT_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND estaciones_maquinas.EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1 
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1 
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1 
    INNER JOIN agrupaciones_areas ON maquinas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND agrupaciones.Agr_Estado = 1 
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)  
    AND Maq_Estado = 1 AND Fre_Estado = 1   
    AND agrupaciones.Agr_Codigo = :agr AND Fre_Hora BETWEEN :horI AND :horF AND plantas.Pla_Codigo = :pla AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    GROUP BY Fre_Hora, PueT_Nombre 
    ORDER BY PueT_Nombre ASC, Fre_Hora ASC";

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
  public function listarVariablesAreMaqPAC($planta, $area, $maquina, $usuario, $formato, $familia, $color){

    $parametros = array(":pla"=>$planta, ":are"=>$area, ":maq"=>$maquina, ":usu"=>$usuario, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT Var_Codigo, Var_Nombre,
      IF( Var_Tipo = 1, 'Texto',
        IF( Var_Tipo = 2, 'Numérico Entero',
          IF( Var_Tipo = 3, 'Numérico Decimal',
            IF( Var_Tipo = 4, 'Si/No', 'No existe el tipo' ) ) ) ) as Tipo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE Var_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla AND 
    areas.Are_Codigo = :are AND maquinas.Maq_Codigo = :maq AND For_Codigo =:for AND Var_Familia = :fam AND Var_Color = :col
    ORDER BY Var_Nombre";

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
  public function listarVariablesAreMaqPACMultiple($referenciaConsulta, $planta, $area, $maquina, $usuario, $formato, $familia, $color){

    $parametros = array(":pla"=>$planta, ":usu"=>$usuario);

    $sql = "SELECT Var_Codigo, Var_Nombre,
      IF( Var_Tipo = 1, 'Texto',
        IF( Var_Tipo = 2, 'Numérico Entero',
          IF( Var_Tipo = 3, 'Numérico Decimal',
            IF( Var_Tipo = 4, 'Si/No', 'No existe el tipo' ) ) ) ) as Tipo, formatos.For_Nombre, Var_Familia, Var_Color
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN formatos ON variables.For_Codigo = formatos.For_Codigo AND For_Estado = 1
    WHERE Var_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla ";
    
    if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " areas.Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($maquina != ""){ 
      $pri2 = 1; 
      foreach($maquina as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " maquinas.Maq_Codigo = :maq".$pri2." "; 
        $parametros[':maq'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

//          echo "registro8 ".$registro8."<br>";
        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (variables.For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND Var_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND Var_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
    $sql .= " ORDER BY Var_Nombre";

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
  public function buscarArchivoVariables($planta){

    $parametros = array(":pla"=>$planta);
    
    $sql = "SELECT Var_Codigo, Var_Archivo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    WHERE Var_Archivo IS NOT NULL AND Var_Estado = '1' AND plantas.Pla_Codigo = :pla";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  } 
    
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarRespuestasVariablesPPActualizarColores($variable, $fechaHora){

    $parametros = array(":var"=>$variable, ":fechor"=>$fechaHora);

    $sql = "SELECT respuestas.Res_Codigo, respuestas.Res_Fecha, respuestas.Res_HoraSugerida, Res_ValorNum
    FROM variables
    INNER JOIN respuestas ON variables.Var_Codigo = respuestas.Var_Codigo
    WHERE variables.Var_Codigo = :var AND CONCAT_WS(' ', respuestas.Res_Fecha, respuestas.Res_HoraSugerida) >= :fechor AND respuestas.Res_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3)";

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
  public function ValidarVariableCreada($variable, $planta){

    $parametros = array(":var"=>$variable, ":pla"=>$planta);

    $sql = "SELECT DISTINCT Var_Nombre, Var_Tipo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE Var_Nombre = :var AND Pla_Codigo = :pla AND Var_Estado = '1'";

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
  public function ValidarVariableCreadaTodas($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT DISTINCT Var_Nombre, Var_Tipo, maquinas.Maq_Codigo, variables.For_Codigo 
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1' 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1' 
    WHERE Pla_Codigo = :pla AND Var_Estado = '1' 
    ORDER BY maquinas.Maq_Codigo, Var_Nombre ASC";
    
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
  public function ValidarVariableCreadaTipo($variable, $planta, $tipo, $maquina){

    $parametros = array(":var"=>$variable, ":pla"=>$planta, ":tip"=>$tipo, ":maq"=>$maquina);

    $sql = "SELECT DISTINCT Var_Nombre, Var_Tipo, variables.Maq_Codigo, variables.For_Codigo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE Var_Nombre = :var AND Pla_Codigo = :pla AND Var_Estado = '1' AND Var_Tipo = :tip AND variables.Maq_Codigo = :maq AND For_Codigo IS NULL";
    
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
  public function ValidarVariableCreadaTipoFormato($variable, $planta, $tipo, $maquina, $formato){

    $parametros = array(":var"=>$variable, ":pla"=>$planta, ":tip"=>$tipo, ":maq"=>$maquina, ":for"=>$formato);

    $sql = "SELECT DISTINCT Var_Nombre, Var_Tipo, variables.Maq_Codigo, variables.For_Codigo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE Var_Nombre = :var AND Pla_Codigo = :pla AND Var_Estado = '1' AND Var_Tipo = :tip AND variables.Maq_Codigo = :maq AND variables.For_Codigo = :for ";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  } 
}
?>
