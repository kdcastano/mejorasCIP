<?php
require_once('basedatos.php');

  class agrupaciones_maquinas extends basedatos {
    private $AgrM_Codigo;
    private $Pla_Codigo;
    private $AgrM_Nombre;
    private $AgrM_Tipo;
    private $AgrM_Orden;
    private $AgrM_FechaHoraCrea;
    private $AgrM_UsuarioCrea;
    private $AgrM_Estado;

  function __construct($AgrM_Codigo = NULL, $Pla_Codigo = NULL, $AgrM_Nombre = NULL, $AgrM_Tipo = NULL, $AgrM_Orden = NULL, $AgrM_FechaHoraCrea = NULL, $AgrM_UsuarioCrea = NULL, $AgrM_Estado = NULL) {
    $this->AgrM_Codigo = $AgrM_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->AgrM_Nombre = $AgrM_Nombre;
    $this->AgrM_Tipo = $AgrM_Tipo;
    $this->AgrM_Orden = $AgrM_Orden;
    $this->AgrM_FechaHoraCrea = $AgrM_FechaHoraCrea;
    $this->AgrM_UsuarioCrea = $AgrM_UsuarioCrea;
    $this->AgrM_Estado = $AgrM_Estado;
    $this->tabla = "agrupaciones_maquinas";
  }

  function getAgrM_Codigo() {
    return $this->AgrM_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getAgrM_Nombre() {
    return $this->AgrM_Nombre;
  }

  function getAgrM_Tipo() {
    return $this->AgrM_Tipo;
  }

  function getAgrM_Orden() {
    return $this->AgrM_Orden;
  }

  function getAgrM_FechaHoraCrea() {
    return $this->AgrM_FechaHoraCrea;
  }

  function getAgrM_UsuarioCrea() {
    return $this->AgrM_UsuarioCrea;
  }

  function getAgrM_Estado() {
    return $this->AgrM_Estado;
  }

  function setAgrM_Codigo($AgrM_Codigo) {
    $this->AgrM_Codigo = $AgrM_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setAgrM_Nombre($AgrM_Nombre) {
    $this->AgrM_Nombre = $AgrM_Nombre;
  }

  function setAgrM_Tipo($AgrM_Tipo) {
    $this->AgrM_Tipo = $AgrM_Tipo;
  }

  function setAgrM_Orden($AgrM_Orden) {
    $this->AgrM_Orden = $AgrM_Orden;
  }

  function setAgrM_FechaHoraCrea($AgrM_FechaHoraCrea) {
    $this->AgrM_FechaHoraCrea = $AgrM_FechaHoraCrea;
  }

  function setAgrM_UsuarioCrea($AgrM_UsuarioCrea) {
    $this->AgrM_UsuarioCrea = $AgrM_UsuarioCrea;
  }

  function setAgrM_Estado($AgrM_Estado) {
    $this->AgrM_Estado = $AgrM_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "AgrM_Nombre", "AgrM_Tipo", "AgrM_Orden", "AgrM_FechaHoraCrea", "AgrM_UsuarioCrea", "AgrM_Estado");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->AgrM_Nombre, 
      $this->AgrM_Tipo, 
      $this->AgrM_Orden, 
      $this->AgrM_FechaHoraCrea, 
      $this->AgrM_UsuarioCrea, 
      $this->AgrM_Estado
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
    $sql =  "SELECT * FROM agrupaciones_maquinas WHERE AgrM_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrM_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setAgrM_Nombre($res[2]);
      $this->setAgrM_Tipo($res[3]);
      $this->setAgrM_Orden($res[4]);
      $this->setAgrM_FechaHoraCrea($res[5]);
      $this->setAgrM_UsuarioCrea($res[6]);
      $this->setAgrM_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "AgrM_Nombre", "AgrM_Tipo", "AgrM_Orden", "AgrM_FechaHoraCrea", "AgrM_UsuarioCrea", "AgrM_Estado");
    $valores = array($this->getPla_Codigo(), $this->getAgrM_Nombre(), $this->getAgrM_Tipo(), $this->getAgrM_Orden(), $this->getAgrM_FechaHoraCrea(), $this->getAgrM_UsuarioCrea(), $this->getAgrM_Estado());
    $llaveprimaria = "AgrM_Codigo";
    $valorllaveprimaria = $this->getAgrM_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();

    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM agrupaciones_maquinas WHERE AgrM_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrM_Codigo);
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
  public function listarAgrupacionesMaquinas( $planta, $usuario ) {

    $parametros = array( ":pla" => $planta, ":usu" => $usuario );

    $sql = "SELECT AgrM_Codigo, AgrM_Nombre
    FROM agrupaciones_maquinas
    INNER JOIN plantas ON agrupaciones_maquinas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE AgrM_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND agrupaciones_maquinas.Pla_Codigo = :pla
    ORDER BY AgrM_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarAgrupacionesMaquinasAgrAct( $planta, $usuario, $tipoArea) {

    $parametros = array( ":pla" => $planta, ":usu" => $usuario, ":tip" => $tipoArea );

    $sql = "SELECT AgrM_Codigo, AgrM_Nombre
    FROM agrupaciones_maquinas
    INNER JOIN plantas ON agrupaciones_maquinas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE AgrM_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND agrupaciones_maquinas.Pla_Codigo = :pla AND AgrM_Tipo = :tip
    ORDER BY AgrM_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarAgrupacionesMaquinasAgr( $planta, $usuario, $tipoArea) {

    $parametros = array( ":pla" => $planta, ":usu" => $usuario , ":tip" => $tipoArea );

    $sql = "SELECT AgrM_Codigo, AgrM_Nombre
    FROM agrupaciones_maquinas
    INNER JOIN plantas ON agrupaciones_maquinas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE AgrM_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND agrupaciones_maquinas.Pla_Codigo = :pla AND AgrM_Tipo = :tip
    ORDER BY AgrM_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarAgrupacionesMaquinasPrincipal( $planta, $usuario, $estado, $tipo) {

    $parametros = array(":usu" => $usuario,  ":est" => $estado );

    $sql = "SELECT AgrM_Codigo, AgrM_Nombre, plantas.Pla_Nombre, AgrM_Estado,
    (SELECT COUNT(AgrVCon_Codigo) FROM agrupaciones_variables_configft 
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1' WHERE AgrVCon_Estado = '1' 
    AND agrupaciones_variables_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo ) AS cantVariables,
    (SELECT COUNT(AgrMCon_Codigo) FROM agrupaciones_maquinas_configft 
    INNER JOIN maquinas ON agrupaciones_maquinas_configft.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1' WHERE AgrMCon_Estado = '1' 
    AND agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo ) AS cantMaquinas, AgrM_Tipo, AgrM_Orden, plantas.Pla_Codigo
    FROM agrupaciones_maquinas
    INNER JOIN plantas ON agrupaciones_maquinas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE AgrM_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";
	
	if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " plantas.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
    
    if($tipo != "-1"){
      $sql .= " AND AgrM_Tipo = :tip ";
      $parametros[':tip'] = $tipo; 
    }
    
	$sql .=" ORDER BY AgrM_Orden, AgrM_Nombre ASC";
	  
    $this->consultaSQL( $sql, $parametros );
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
  public function buscarUltimoRegistroCreado($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT AgrM_Codigo
    FROM agrupaciones_maquinas
    WHERE AgrM_Estado = 1 AND AgrM_UsuarioCrea = :usu
    ORDER BY AgrM_Codigo DESC
    LIMIT 1
    ";

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
  public function listarAgrupacionesMaquinasTipo($tipo, $planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT AgrM_Codigo, AgrM_Nombre
    FROM agrupaciones_maquinas
    WHERE AgrM_Estado = '1' AND Pla_Codigo = :pla";
    
    if($tipo == "2"){
      $sql .= " AND AgrM_Tipo IN (2,3)";
    }else{
      $sql .= " AND AgrM_Tipo = :tip ";
      $parametros[':tip'] = $tipo;
    }
    
    $sql .= " ORDER BY AgrM_Orden ASC";

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
  public function listarAgrupacionMSeleccionadas($codigo){

    $sql = "SELECT DISTINCT agrupaciones_maquinas.AgrM_Codigo, AgrM_Nombre
    FROM agrupaciones_maquinas
    WHERE AgrM_Estado = '1'";
    
    if($codigo != ""){ 
      $pri = 1; 
      foreach($codigo as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND agrupaciones_maquinas.AgrM_Codigo IN (";  
        }else{ 
          $sql .= " , "; 
        } 
        $sql .= " :tip".$pri." "; 
        $parametros[':tip'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY agrupaciones_maquinas.AgrM_Codigo ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
