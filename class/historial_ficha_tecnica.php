<?php
require_once('basedatos.php');

  class historial_ficha_tecnica extends basedatos {
    private $HisFT_Codigo;
    private $DetFT_Codigo;
    private $FicT_Codigo;
    private $AgrVCon_Codigo;
    private $AgrMCon_Codigo;
    private $Maq_Codigo;
    private $HisFT_Fecha;
    private $HisFT_Version;
    private $HisFT_Tipo;
    private $HisFT_UnidadMedida;
    private $HisFT_ValorControl;
    private $HisFT_ValorControlTexto;
    private $HisFT_ValorTolerancia;
    private $HisFT_Operador;
    private $HisFT_TomaVariable;
    private $HisFT_FechaHoraCrea;
    private $HisFT_UsuarioCrea;
    private $HisFT_Estado;

  function __construct($HisFT_Codigo = NULL, $DetFT_Codigo = NULL, $FicT_Codigo = NULL, $AgrVCon_Codigo = NULL, $AgrMCon_Codigo = NULL, $Maq_Codigo = NULL, $HisFT_Fecha = NULL, $HisFT_Version = NULL, $HisFT_Tipo = NULL, $HisFT_UnidadMedida = NULL, $HisFT_ValorControl = NULL, $HisFT_ValorControlTexto = NULL, $HisFT_ValorTolerancia = NULL, $HisFT_Operador = NULL, $HisFT_TomaVariable = NULL, $HisFT_FechaHoraCrea = NULL, $HisFT_UsuarioCrea = NULL, $HisFT_Estado = NULL) {
    $this->HisFT_Codigo = $HisFT_Codigo;
    $this->DetFT_Codigo = $DetFT_Codigo;
    $this->FicT_Codigo = $FicT_Codigo;
    $this->AgrVCon_Codigo = $AgrVCon_Codigo;
    $this->AgrMCon_Codigo = $AgrMCon_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->HisFT_Fecha = $HisFT_Fecha;
    $this->HisFT_Version = $HisFT_Version;
    $this->HisFT_Tipo = $HisFT_Tipo;
    $this->HisFT_UnidadMedida = $HisFT_UnidadMedida;
    $this->HisFT_ValorControl = $HisFT_ValorControl;
    $this->HisFT_ValorControlTexto = $HisFT_ValorControlTexto;
    $this->HisFT_ValorTolerancia = $HisFT_ValorTolerancia;
    $this->HisFT_Operador = $HisFT_Operador;
    $this->HisFT_TomaVariable = $HisFT_TomaVariable;
    $this->HisFT_FechaHoraCrea = $HisFT_FechaHoraCrea;
    $this->HisFT_UsuarioCrea = $HisFT_UsuarioCrea;
    $this->HisFT_Estado = $HisFT_Estado;
    $this->tabla = "historial_ficha_tecnica";
  }

  function getHisFT_Codigo() {
    return $this->HisFT_Codigo;
  }

  function getDetFT_Codigo() {
    return $this->DetFT_Codigo;
  }

  function getFicT_Codigo() {
    return $this->FicT_Codigo;
  }

  function getAgrVCon_Codigo() {
    return $this->AgrVCon_Codigo;
  }

  function getAgrMCon_Codigo() {
    return $this->AgrMCon_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getHisFT_Fecha() {
    return $this->HisFT_Fecha;
  }

  function getHisFT_Version() {
    return $this->HisFT_Version;
  }

  function getHisFT_Tipo() {
    return $this->HisFT_Tipo;
  }

  function getHisFT_UnidadMedida() {
    return $this->HisFT_UnidadMedida;
  }

  function getHisFT_ValorControl() {
    return $this->HisFT_ValorControl;
  }

  function getHisFT_ValorControlTexto() {
    return $this->HisFT_ValorControlTexto;
  }

  function getHisFT_ValorTolerancia() {
    return $this->HisFT_ValorTolerancia;
  }

  function getHisFT_Operador() {
    return $this->HisFT_Operador;
  }

  function getHisFT_TomaVariable() {
    return $this->HisFT_TomaVariable;
  }

  function getHisFT_FechaHoraCrea() {
    return $this->HisFT_FechaHoraCrea;
  }

  function getHisFT_UsuarioCrea() {
    return $this->HisFT_UsuarioCrea;
  }

  function getHisFT_Estado() {
    return $this->HisFT_Estado;
  }

  function setHisFT_Codigo($HisFT_Codigo) {
    $this->HisFT_Codigo = $HisFT_Codigo;
  }

  function setDetFT_Codigo($DetFT_Codigo) {
    $this->DetFT_Codigo = $DetFT_Codigo;
  }

  function setFicT_Codigo($FicT_Codigo) {
    $this->FicT_Codigo = $FicT_Codigo;
  }

  function setAgrVCon_Codigo($AgrVCon_Codigo) {
    $this->AgrVCon_Codigo = $AgrVCon_Codigo;
  }

  function setAgrMCon_Codigo($AgrMCon_Codigo) {
    $this->AgrMCon_Codigo = $AgrMCon_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setHisFT_Fecha($HisFT_Fecha) {
    $this->HisFT_Fecha = $HisFT_Fecha;
  }

  function setHisFT_Version($HisFT_Version) {
    $this->HisFT_Version = $HisFT_Version;
  }

  function setHisFT_Tipo($HisFT_Tipo) {
    $this->HisFT_Tipo = $HisFT_Tipo;
  }

  function setHisFT_UnidadMedida($HisFT_UnidadMedida) {
    $this->HisFT_UnidadMedida = $HisFT_UnidadMedida;
  }

  function setHisFT_ValorControl($HisFT_ValorControl) {
    $this->HisFT_ValorControl = $HisFT_ValorControl;
  }

  function setHisFT_ValorControlTexto($HisFT_ValorControlTexto) {
    $this->HisFT_ValorControlTexto = $HisFT_ValorControlTexto;
  }

  function setHisFT_ValorTolerancia($HisFT_ValorTolerancia) {
    $this->HisFT_ValorTolerancia = $HisFT_ValorTolerancia;
  }

  function setHisFT_Operador($HisFT_Operador) {
    $this->HisFT_Operador = $HisFT_Operador;
  }

  function setHisFT_TomaVariable($HisFT_TomaVariable) {
    $this->HisFT_TomaVariable = $HisFT_TomaVariable;
  }

  function setHisFT_FechaHoraCrea($HisFT_FechaHoraCrea) {
    $this->HisFT_FechaHoraCrea = $HisFT_FechaHoraCrea;
  }

  function setHisFT_UsuarioCrea($HisFT_UsuarioCrea) {
    $this->HisFT_UsuarioCrea = $HisFT_UsuarioCrea;
  }

  function setHisFT_Estado($HisFT_Estado) {
    $this->HisFT_Estado = $HisFT_Estado;
  }

  public function insertar(){
    $campos = array("DetFT_Codigo", "FicT_Codigo", "AgrVCon_Codigo", "AgrMCon_Codigo", "Maq_Codigo", "HisFT_Fecha", "HisFT_Version", "HisFT_Tipo", "HisFT_UnidadMedida", "HisFT_ValorControl", "HisFT_ValorControlTexto", "HisFT_ValorTolerancia", "HisFT_Operador", "HisFT_TomaVariable", "HisFT_FechaHoraCrea", "HisFT_UsuarioCrea", "HisFT_Estado");
    $valores = array(
    array(
      $this->DetFT_Codigo, 
      $this->FicT_Codigo, 
      $this->AgrVCon_Codigo, 
      $this->AgrMCon_Codigo, 
      $this->Maq_Codigo, 
      $this->HisFT_Fecha, 
      $this->HisFT_Version, 
      $this->HisFT_Tipo, 
      $this->HisFT_UnidadMedida, 
      $this->HisFT_ValorControl, 
      $this->HisFT_ValorControlTexto, 
      $this->HisFT_ValorTolerancia, 
      $this->HisFT_Operador, 
      $this->HisFT_TomaVariable, 
      $this->HisFT_FechaHoraCrea, 
      $this->HisFT_UsuarioCrea, 
      $this->HisFT_Estado
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
    $sql =  "SELECT * FROM historial_ficha_tecnica WHERE HisFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->HisFT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setDetFT_Codigo($res[1]);
      $this->setFicT_Codigo($res[2]);
      $this->setAgrVCon_Codigo($res[3]);
      $this->setAgrMCon_Codigo($res[4]);
      $this->setMaq_Codigo($res[5]);
      $this->setHisFT_Fecha($res[6]);
      $this->setHisFT_Version($res[7]);
      $this->setHisFT_Tipo($res[8]);
      $this->setHisFT_UnidadMedida($res[9]);
      $this->setHisFT_ValorControl($res[10]);
      $this->setHisFT_ValorControlTexto($res[11]);
      $this->setHisFT_ValorTolerancia($res[12]);
      $this->setHisFT_Operador($res[13]);
      $this->setHisFT_TomaVariable($res[14]);
      $this->setHisFT_FechaHoraCrea($res[15]);
      $this->setHisFT_UsuarioCrea($res[16]);
      $this->setHisFT_Estado($res[17]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("DetFT_Codigo", "FicT_Codigo", "AgrVCon_Codigo", "AgrMCon_Codigo", "Maq_Codigo", "HisFT_Fecha", "HisFT_Version", "HisFT_Tipo", "HisFT_UnidadMedida", "HisFT_ValorControl", "HisFT_ValorControlTexto", "HisFT_ValorTolerancia", "HisFT_Operador", "HisFT_TomaVariable", "HisFT_FechaHoraCrea", "HisFT_UsuarioCrea", "HisFT_Estado");
    $valores = array($this->getDetFT_Codigo(), $this->getFicT_Codigo(), $this->getAgrVCon_Codigo(), $this->getAgrMCon_Codigo(), $this->getMaq_Codigo(), $this->getHisFT_Fecha(), $this->getHisFT_Version(), $this->getHisFT_Tipo(), $this->getHisFT_UnidadMedida(), $this->getHisFT_ValorControl(), $this->getHisFT_ValorControlTexto(), $this->getHisFT_ValorTolerancia(), $this->getHisFT_Operador(), $this->getHisFT_TomaVariable(), $this->getHisFT_FechaHoraCrea(), $this->getHisFT_UsuarioCrea(), $this->getHisFT_Estado());
    $llaveprimaria = "HisFT_Codigo";
    $valorllaveprimaria = $this->getHisFT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM historial_ficha_tecnica WHERE HisFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->HisFT_Codigo);
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
  public function listarHistorialFT(){

    $sql = "SELECT COUNT(HisFT_Codigo), FicT_Codigo 
    FROM historial_ficha_tecnica
    WHERE HisFT_Estado = 1 
    GROUP BY FicT_Codigo";

    $this->consultaSQL($sql);
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
  public function listarHistorialFTN($fichaTecnica){
    
    $parametros = array(":cod"=>$fichaTecnica);

    $sql = "SELECT COUNT(HisFT_Codigo), FicT_Codigo, DetFT_Codigo
    FROM historial_ficha_tecnica
    WHERE HisFT_Estado = 1 AND FicT_Codigo = :cod
    GROUP BY FicT_Codigo";

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
  public function cantidadRegistrosFamiliaVersion($formato,$familia, $color){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT historial_ficha_tecnica.FicT_Codigo AS Cant
    FROM historial_ficha_tecnica
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo
    WHERE For_Codigo = :for AND FicT_Familia = :fam AND FicT_Color = :col AND FicT_Estado IN (1,0)";

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
  public function buscarversionFT($fichaTecnica){

    $parametros = array(":cod"=>$fichaTecnica);

    $sql = "SELECT DISTINCT HisFT_Version
    FROM historial_ficha_tecnica
    WHERE HisFT_Estado = 1 AND FicT_Codigo = :cod";

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
  public function buscarPDFVersion($familia, $color, $formato){

    $parametros = array(":fam"=>$familia, ":col"=>$color, ":for"=>$formato);

    $sql = "SELECT DISTINCT (historial_ficha_tecnica.FicT_Codigo), FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos ON ficha_tecnica.For_Codigo = formatos.For_Codigo
    WHERE FicT_Familia = :fam AND FicT_Color = :col AND formatos.For_Nombre = :for AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>