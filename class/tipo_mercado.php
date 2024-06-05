<?php
require_once('basedatos.php');

  class tipo_mercado extends basedatos {
    private $TipM_Codigo;
    private $Pla_Codigo;
    private $Sub_Codigo;
    private $TipM_Tipo;
    private $TipM_UsuarioCrea;
    private $TipM_FechaHoraCrea;
    private $TipM_Estado;

  function __construct($TipM_Codigo = NULL, $Pla_Codigo = NULL, $Sub_Codigo = NULL, $TipM_Tipo = NULL, $TipM_UsuarioCrea = NULL, $TipM_FechaHoraCrea = NULL, $TipM_Estado = NULL) {
    $this->TipM_Codigo = $TipM_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Sub_Codigo = $Sub_Codigo;
    $this->TipM_Tipo = $TipM_Tipo;
    $this->TipM_UsuarioCrea = $TipM_UsuarioCrea;
    $this->TipM_FechaHoraCrea = $TipM_FechaHoraCrea;
    $this->TipM_Estado = $TipM_Estado;
    $this->tabla = "tipo_mercado";
  }

  function getTipM_Codigo() {
    return $this->TipM_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getSub_Codigo() {
    return $this->Sub_Codigo;
  }

  function getTipM_Tipo() {
    return $this->TipM_Tipo;
  }

  function getTipM_UsuarioCrea() {
    return $this->TipM_UsuarioCrea;
  }

  function getTipM_FechaHoraCrea() {
    return $this->TipM_FechaHoraCrea;
  }

  function getTipM_Estado() {
    return $this->TipM_Estado;
  }

  function setTipM_Codigo($TipM_Codigo) {
    $this->TipM_Codigo = $TipM_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setSub_Codigo($Sub_Codigo) {
    $this->Sub_Codigo = $Sub_Codigo;
  }

  function setTipM_Tipo($TipM_Tipo) {
    $this->TipM_Tipo = $TipM_Tipo;
  }

  function setTipM_UsuarioCrea($TipM_UsuarioCrea) {
    $this->TipM_UsuarioCrea = $TipM_UsuarioCrea;
  }

  function setTipM_FechaHoraCrea($TipM_FechaHoraCrea) {
    $this->TipM_FechaHoraCrea = $TipM_FechaHoraCrea;
  }

  function setTipM_Estado($TipM_Estado) {
    $this->TipM_Estado = $TipM_Estado;
  }

  public function insertar(){
    $campos = array( "Pla_Codigo", "Sub_Codigo", "TipM_Tipo", "TipM_UsuarioCrea", "TipM_FechaHoraCrea", "TipM_Estado");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->Sub_Codigo, 
      $this->TipM_Tipo, 
      $this->TipM_UsuarioCrea, 
      $this->TipM_FechaHoraCrea, 
      $this->TipM_Estado
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
    $sql =  "SELECT * FROM tipo_mercado WHERE TipM_Codigo = :cod";
    $parametros = array(":cod"=>$this->TipM_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setSub_Codigo($res[2]);
      $this->setTipM_Tipo($res[3]);
      $this->setTipM_UsuarioCrea($res[4]);
      $this->setTipM_FechaHoraCrea($res[5]);
      $this->setTipM_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Sub_Codigo", "TipM_Tipo", "TipM_UsuarioCrea", "TipM_FechaHoraCrea", "TipM_Estado");
    $valores = array($this->getPla_Codigo(), $this->getSub_Codigo(), $this->getTipM_Tipo(), $this->getTipM_UsuarioCrea(), $this->getTipM_FechaHoraCrea(), $this->getTipM_Estado());
    $llaveprimaria = "TipM_Codigo";
    $valorllaveprimaria = $this->getTipM_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM tipo_mercado WHERE TipM_Codigo = :cod";
    $parametros = array(":cod"=>$this->TipM_Codigo);
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
  public function listarTipoMercado( $planta, $submarca, $estado, $usuario ) {

    $parametros = array(":est" => $estado, ":usu"=>$usuario );

    $sql = "SELECT TipM_Codigo, plantas.Pla_Nombre, submarcas.Sub_Nombre, 
 	IF(TipM_Tipo = 1, 'EUROPALLET', 
      IF(TipM_Tipo = 2, 'EXPORTACIÓN', 
        IF(TipM_Tipo = 3, 'NACIONAL', 'No existe tipo'
        )
      )
    ) as Tipo, TipM_Estado
    FROM tipo_mercado
    INNER JOIN submarcas ON tipo_mercado.Sub_Codigo = submarcas.Sub_Codigo AND submarcas.Sub_Estado = 1
    INNER JOIN plantas ON tipo_mercado.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN usuarios ON tipo_mercado.TipM_UsuarioCrea = usuarios.Usu_Codigo AND usuarios.Usu_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE TipM_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";
    
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
    
    if($submarca != ""){ 
      $pri1 = 1; 
      foreach($submarca as $registro2){ 
        if($pri1 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= "submarcas.Sub_Codigo = :sub".$pri1." "; 
        $parametros[':sub'.$pri1] = $registro2; 
        $pri1++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .=" ORDER BY plantas.Pla_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
