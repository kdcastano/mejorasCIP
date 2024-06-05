<?php
require_once('basedatos.php');

  class listas_tipos extends basedatos {
    private $LisT_Codigo;
    private $Pla_Codigo;
    private $ConFT_Codigo;
    private $Maq_Codigo;
    private $LisT_Dato;
    private $LisT_FechaHoraCrea;
    private $LisT_UsuarioCrea;
    private $LisT_Estado;

  function __construct($LisT_Codigo = NULL, $Pla_Codigo = NULL, $ConFT_Codigo = NULL, $Maq_Codigo = NULL, $LisT_Dato = NULL, $LisT_FechaHoraCrea = NULL, $LisT_UsuarioCrea = NULL, $LisT_Estado = NULL) {
    $this->LisT_Codigo = $LisT_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->ConFT_Codigo = $ConFT_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->LisT_Dato = $LisT_Dato;
    $this->LisT_FechaHoraCrea = $LisT_FechaHoraCrea;
    $this->LisT_UsuarioCrea = $LisT_UsuarioCrea;
    $this->LisT_Estado = $LisT_Estado;
    $this->tabla = "listas_tipos";
  }

  function getLisT_Codigo() {
    return $this->LisT_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getConFT_Codigo() {
    return $this->ConFT_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getLisT_Dato() {
    return $this->LisT_Dato;
  }

  function getLisT_FechaHoraCrea() {
    return $this->LisT_FechaHoraCrea;
  }

  function getLisT_UsuarioCrea() {
    return $this->LisT_UsuarioCrea;
  }

  function getLisT_Estado() {
    return $this->LisT_Estado;
  }

  function setLisT_Codigo($LisT_Codigo) {
    $this->LisT_Codigo = $LisT_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setConFT_Codigo($ConFT_Codigo) {
    $this->ConFT_Codigo = $ConFT_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setLisT_Dato($LisT_Dato) {
    $this->LisT_Dato = $LisT_Dato;
  }

  function setLisT_FechaHoraCrea($LisT_FechaHoraCrea) {
    $this->LisT_FechaHoraCrea = $LisT_FechaHoraCrea;
  }

  function setLisT_UsuarioCrea($LisT_UsuarioCrea) {
    $this->LisT_UsuarioCrea = $LisT_UsuarioCrea;
  }

  function setLisT_Estado($LisT_Estado) {
    $this->LisT_Estado = $LisT_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "ConFT_Codigo", "Maq_Codigo", "LisT_Dato", "LisT_FechaHoraCrea", "LisT_UsuarioCrea", "LisT_Estado");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->ConFT_Codigo, 
      $this->Maq_Codigo, 
      $this->LisT_Dato, 
      $this->LisT_FechaHoraCrea, 
      $this->LisT_UsuarioCrea, 
      $this->LisT_Estado
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
    $sql =  "SELECT * FROM listas_tipos WHERE LisT_Codigo = :cod";
    $parametros = array(":cod"=>$this->LisT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setConFT_Codigo($res[2]);
      $this->setMaq_Codigo($res[3]);
      $this->setLisT_Dato($res[4]);
      $this->setLisT_FechaHoraCrea($res[5]);
      $this->setLisT_UsuarioCrea($res[6]);
      $this->setLisT_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "ConFT_Codigo", "Maq_Codigo", "LisT_Dato", "LisT_FechaHoraCrea", "LisT_UsuarioCrea", "LisT_Estado");
    $valores = array($this->getPla_Codigo(), $this->getConFT_Codigo(), $this->getMaq_Codigo(), $this->getLisT_Dato(), $this->getLisT_FechaHoraCrea(), $this->getLisT_UsuarioCrea(), $this->getLisT_Estado());
    $llaveprimaria = "LisT_Codigo";
    $valorllaveprimaria = $this->getLisT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM listas_tipos WHERE LisT_Codigo = :cod";
    $parametros = array(":cod"=>$this->LisT_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
}
?>
