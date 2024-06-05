<?php
require_once('basedatos.php');

  class agrupaciones_configft extends basedatos {
    private $AgrC_Codigo;
    private $Pla_Codigo;
    private $AgrC_Nombre;
    private $AgrC_Archivo;
    private $AgrC_TomaVariable;
    private $AgrC_Ordenamiento;
    private $AgrC_Tipo;
    private $AgrC_TipoVariable;
    private $AgrC_PuntoControl;
    private $AgrC_UnidadMedida;
    private $AgrC_FechaHoraCrea;
    private $AgrC_UsuarioCrea;
    private $AgrC_Estado;

  function __construct($AgrC_Codigo = NULL, $Pla_Codigo = NULL, $AgrC_Nombre = NULL, $AgrC_Archivo = NULL, $AgrC_TomaVariable = NULL, $AgrC_Ordenamiento = NULL, $AgrC_Tipo = NULL, $AgrC_TipoVariable = NULL, $AgrC_PuntoControl = NULL, $AgrC_UnidadMedida = NULL, $AgrC_FechaHoraCrea = NULL, $AgrC_UsuarioCrea = NULL, $AgrC_Estado = NULL) {
    $this->AgrC_Codigo = $AgrC_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->AgrC_Nombre = $AgrC_Nombre;
    $this->AgrC_Archivo = $AgrC_Archivo;
    $this->AgrC_TomaVariable = $AgrC_TomaVariable;
    $this->AgrC_Ordenamiento = $AgrC_Ordenamiento;
    $this->AgrC_Tipo = $AgrC_Tipo;
    $this->AgrC_TipoVariable = $AgrC_TipoVariable;
    $this->AgrC_PuntoControl = $AgrC_PuntoControl;
    $this->AgrC_UnidadMedida = $AgrC_UnidadMedida;
    $this->AgrC_FechaHoraCrea = $AgrC_FechaHoraCrea;
    $this->AgrC_UsuarioCrea = $AgrC_UsuarioCrea;
    $this->AgrC_Estado = $AgrC_Estado;
    $this->tabla = "agrupaciones_configft";
  }

  function getAgrC_Codigo() {
    return $this->AgrC_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getAgrC_Nombre() {
    return $this->AgrC_Nombre;
  }

  function getAgrC_Archivo() {
    return $this->AgrC_Archivo;
  }

  function getAgrC_TomaVariable() {
    return $this->AgrC_TomaVariable;
  }

  function getAgrC_Ordenamiento() {
    return $this->AgrC_Ordenamiento;
  }

  function getAgrC_Tipo() {
    return $this->AgrC_Tipo;
  }

  function getAgrC_TipoVariable() {
    return $this->AgrC_TipoVariable;
  }

  function getAgrC_PuntoControl() {
    return $this->AgrC_PuntoControl;
  }

  function getAgrC_UnidadMedida() {
    return $this->AgrC_UnidadMedida;
  }

  function getAgrC_FechaHoraCrea() {
    return $this->AgrC_FechaHoraCrea;
  }

  function getAgrC_UsuarioCrea() {
    return $this->AgrC_UsuarioCrea;
  }

  function getAgrC_Estado() {
    return $this->AgrC_Estado;
  }

  function setAgrC_Codigo($AgrC_Codigo) {
    $this->AgrC_Codigo = $AgrC_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setAgrC_Nombre($AgrC_Nombre) {
    $this->AgrC_Nombre = $AgrC_Nombre;
  }

  function setAgrC_Archivo($AgrC_Archivo) {
    $this->AgrC_Archivo = $AgrC_Archivo;
  }

  function setAgrC_TomaVariable($AgrC_TomaVariable) {
    $this->AgrC_TomaVariable = $AgrC_TomaVariable;
  }

  function setAgrC_Ordenamiento($AgrC_Ordenamiento) {
    $this->AgrC_Ordenamiento = $AgrC_Ordenamiento;
  }

  function setAgrC_Tipo($AgrC_Tipo) {
    $this->AgrC_Tipo = $AgrC_Tipo;
  }

  function setAgrC_TipoVariable($AgrC_TipoVariable) {
    $this->AgrC_TipoVariable = $AgrC_TipoVariable;
  }

  function setAgrC_PuntoControl($AgrC_PuntoControl) {
    $this->AgrC_PuntoControl = $AgrC_PuntoControl;
  }

  function setAgrC_UnidadMedida($AgrC_UnidadMedida) {
    $this->AgrC_UnidadMedida = $AgrC_UnidadMedida;
  }

  function setAgrC_FechaHoraCrea($AgrC_FechaHoraCrea) {
    $this->AgrC_FechaHoraCrea = $AgrC_FechaHoraCrea;
  }

  function setAgrC_UsuarioCrea($AgrC_UsuarioCrea) {
    $this->AgrC_UsuarioCrea = $AgrC_UsuarioCrea;
  }

  function setAgrC_Estado($AgrC_Estado) {
    $this->AgrC_Estado = $AgrC_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "AgrC_Nombre", "AgrC_Archivo", "AgrC_TomaVariable", "AgrC_Ordenamiento", "AgrC_Tipo", "AgrC_TipoVariable", "AgrC_PuntoControl", "AgrC_UnidadMedida", "AgrC_FechaHoraCrea", "AgrC_UsuarioCrea", "AgrC_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->AgrC_Nombre, 
      $this->AgrC_Archivo, 
      $this->AgrC_TomaVariable, 
      $this->AgrC_Ordenamiento, 
      $this->AgrC_Tipo, 
      $this->AgrC_TipoVariable, 
      $this->AgrC_PuntoControl, 
      $this->AgrC_UnidadMedida, 
      $this->AgrC_FechaHoraCrea, 
      $this->AgrC_UsuarioCrea, 
      $this->AgrC_Estado
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
    $sql =  "SELECT * FROM agrupaciones_configft WHERE AgrC_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrC_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setAgrC_Nombre($res[2]);
      $this->setAgrC_Archivo($res[3]);
      $this->setAgrC_TomaVariable($res[4]);
      $this->setAgrC_Ordenamiento($res[5]);
      $this->setAgrC_Tipo($res[6]);
      $this->setAgrC_TipoVariable($res[7]);
      $this->setAgrC_PuntoControl($res[8]);
      $this->setAgrC_UnidadMedida($res[9]);
      $this->setAgrC_FechaHoraCrea($res[10]);
      $this->setAgrC_UsuarioCrea($res[11]);
      $this->setAgrC_Estado($res[12]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "AgrC_Nombre", "AgrC_Archivo", "AgrC_TomaVariable", "AgrC_Ordenamiento", "AgrC_Tipo", "AgrC_TipoVariable", "AgrC_PuntoControl", "AgrC_UnidadMedida", "AgrC_FechaHoraCrea", "AgrC_UsuarioCrea", "AgrC_Estado");
    $valores = array($this->getPla_Codigo(), $this->getAgrC_Nombre(), $this->getAgrC_Archivo(), $this->getAgrC_TomaVariable(), $this->getAgrC_Ordenamiento(), $this->getAgrC_Tipo(), $this->getAgrC_TipoVariable(), $this->getAgrC_PuntoControl(), $this->getAgrC_UnidadMedida(), $this->getAgrC_FechaHoraCrea(), $this->getAgrC_UsuarioCrea(), $this->getAgrC_Estado());
    $llaveprimaria = "AgrC_Codigo";
    $valorllaveprimaria = $this->getAgrC_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM agrupaciones_configft WHERE AgrC_Codigo = :cod";
    $parametros = array(":cod"=>$this->AgrC_Codigo);
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
  public function listarAgrupacionesConfFT( $planta, $usuario ) {

    $parametros = array( ":pla" => $planta, ":usu" => $usuario );

    $sql = "SELECT AgrC_Codigo, AgrC_Nombre
    FROM agrupaciones_configft
    INNER JOIN plantas ON agrupaciones_configft.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE AgrC_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND agrupaciones_configft.Pla_Codigo = :pla
    ORDER BY AgrC_Nombre ASC";

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
  public function listarAgrupacionesConfigftPrincipal( $planta, $usuario, $estado ) {

    $parametros = array( ":usu" => $usuario, ":est" => $estado );

    $sql = "SELECT AgrC_Codigo, AgrC_Nombre, plantas.Pla_Nombre, AgrC_Estado, AgrC_Ordenamiento, AgrC_Tipo
    FROM agrupaciones_configft
    INNER JOIN plantas ON agrupaciones_configft.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE AgrC_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

    if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " agrupaciones_configft.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
    $sql .= " ORDER BY AgrC_Ordenamiento, AgrC_Nombre ASC";
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
  public function buscarArchivoAgruCFT($planta){

    $parametros = array(":pla"=>$planta);
    
    $sql = "SELECT AgrC_Nombre, AgrC_Archivo
    FROM agrupaciones_configft
    WHERE AgrC_Estado = 1 AND AgrC_Archivo IS NOT NULL AND Pla_Codigo = :pla";

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
  public function listarUltimoRegistroCreado($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT AgrC_Codigo 
    FROM agrupaciones_configft
    WHERE AgrC_Estado = 1 AND AgrC_UsuarioCrea = :usu
    ORDER BY AgrC_Codigo  DESC
    LIMIT 1";

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
  public function buscarTipoVariable($variable,$planta){

    $parametros = array(":var"=>$variable,":pla"=>$planta);

    $sql = "SELECT AgrC_Nombre, AgrC_Tipo
    FROM agrupaciones_configft
    WHERE AgrC_Estado = '1' AND AgrC_Nombre = :var AND Pla_Codigo= :pla";

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
  public function buscarTipoVariableTodas($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT AgrC_Nombre, AgrC_Tipo
    FROM agrupaciones_configft
    WHERE AgrC_Estado = '1' AND Pla_Codigo= :pla";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
