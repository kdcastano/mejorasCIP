<?php
require_once( 'basedatos.php' );

class agrupaciones_areas extends basedatos {
  private $AgrA_Codigo;
  private $Are_Codigo;
  private $Agr_Codigo;
  private $AgrA_UsuarioCrea;
  private $AgrA_FechaHora;
  private $AgrA_Estado;

  function __construct( $AgrA_Codigo = NULL, $Are_Codigo = NULL, $Agr_Codigo = NULL, $AgrA_UsuarioCrea = NULL, $AgrA_FechaHora = NULL, $AgrA_Estado = NULL) {
    $this->AgrA_Codigo = $AgrA_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->Agr_Codigo = $Agr_Codigo;
    $this->AgrA_UsuarioCrea = $AgrA_UsuarioCrea;
    $this->AgrA_FechaHora = $AgrA_FechaHora;
    $this->AgrA_Estado = $AgrA_Estado;
    $this->tabla = "agrupaciones_areas";
  }

  function getAgrA_Codigo() {
    return $this->AgrA_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getAgr_Codigo() {
    return $this->Agr_Codigo;
  }

  function getAgrA_UsuarioCrea() {
    return $this->AgrA_UsuarioCrea;
  }

  function getAgrA_FechaHora() {
    return $this->AgrA_FechaHora;
  }

  function getAgrA_Estado() {
    return $this->AgrA_Estado;
  }
  
  function setAgrA_Codigo( $AgrA_Codigo ) {
    $this->AgrA_Codigo = $AgrA_Codigo;
  }

  function setAre_Codigo( $Are_Codigo ) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setAgr_Codigo( $Agr_Codigo ) {
    $this->Agr_Codigo = $Agr_Codigo;
  }

  function setAgrA_UsuarioCrea( $AgrA_UsuarioCrea ) {
    $this->AgrA_UsuarioCrea = $AgrA_UsuarioCrea;
  }

  function setAgrA_FechaHora( $AgrA_FechaHora ) {
    $this->AgrA_FechaHora = $AgrA_FechaHora;
  }

  function setAgrA_Estado( $AgrA_Estado ) {
    $this->AgrA_Estado = $AgrA_Estado;
  }
  
  public function insertar() {
    $campos = array( "Are_Codigo", "Agr_Codigo", "AgrA_UsuarioCrea", "AgrA_FechaHora", "AgrA_Estado" );
    $valores = array(
      array(
        $this->Are_Codigo,
        $this->Agr_Codigo,
        $this->AgrA_UsuarioCrea,
        $this->AgrA_FechaHora,
        $this->AgrA_Estado
      )
    );

    $resultado = $this->insertarRegistros( $campos, $valores );
    $this->desconectar();

    if ( $resultado[ 0 ] == "OK" ) {
      return true;
    } else {
      return false;
    }
  }

  public function consultar() {
    $sql = "SELECT * FROM agrupaciones_areas WHERE AgrA_Codigo = :cod";
    $parametros = array( ":cod" => $this->AgrA_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setAre_Codigo( $res[ 1 ] );
      $this->setAgr_Codigo( $res[ 2 ] );
      $this->setAgrA_UsuarioCrea( $res[ 3 ] );
      $this->setAgrA_FechaHora( $res[ 4 ] );
      $this->setAgrA_Estado( $res[ 5 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Are_Codigo", "Agr_Codigo", "AgrA_UsuarioCrea", "AgrA_FechaHora", "AgrA_Estado" );
    $valores = array( $this->getAre_Codigo(), $this->getAgr_Codigo(), $this->getAgrA_UsuarioCrea(), $this->getAgrA_FechaHora(), $this->getAgrA_Estado() );
    $llaveprimaria = "AgrA_Codigo";
    $valorllaveprimaria = $this->getAgrA_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM agrupaciones_areas WHERE AgrA_Codigo = :cod";
    $parametros = array( ":cod" => $this->AgrA_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }

  /*
      Autor: Natalia Rodríguez
      Fecha: 
      Descripción:
      Parámetros:
      */
  public function areasAgrupacionListar( $agrupacion ) {

    $parametros = array( ":agr" => $agrupacion );

    $sql = "SELECT Agr_Nombre, Are_nombre, areas.Are_Codigo, AgrA_Codigo
    FROM agrupaciones_areas
    INNER JOIN areas ON areas.Are_Codigo=agrupaciones_areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones.Agr_Codigo=agrupaciones_areas.Agr_Codigo AND agrupaciones.Agr_Estado = 1
    WHERE agrupaciones_areas.Agr_Codigo = :agr AND AgrA_Estado = 1";


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
  public function buscarAreaCalidadAgrupacion($agrupacion){

    $parametros = array(":agr"=>$agrupacion);

    $sql = "SELECT areas.Are_Codigo
    FROM agrupaciones_areas
    INNER JOIN areas ON agrupaciones_areas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    WHERE AgrA_Estado = 1 AND Are_Tipo  = '6' AND Agr_Codigo = :agr";

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
  public function buscarAreaPrensasAgrupacion($agrupacion){

    $parametros = array(":agr"=>$agrupacion);

    $sql = "SELECT areas.Are_Codigo, areas.Are_Nombre
    FROM agrupaciones_areas
    INNER JOIN areas ON agrupaciones_areas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    WHERE AgrA_Estado = 1 AND Are_Tipo  = '2' AND Agr_Codigo = :agr";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
