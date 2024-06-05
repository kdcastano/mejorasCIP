<?php
require_once( 'basedatos.php' );

class estaciones_areas extends basedatos {
  private $EstA_Codigo;
  private $Est_Codigo;
  private $Are_Codigo;
  private $EstA_FechaHoraCrea;
  private $EstA_UsuarioCrea;
  private $EstA_Estado;

  function __construct( $EstA_Codigo = NULL, $Est_Codigo = NULL, $Are_Codigo = NULL, $EstA_FechaHoraCrea = NULL, $EstA_UsuarioCrea = NULL, $EstA_Estado = NULL ) {
    $this->EstA_Codigo = $EstA_Codigo;
    $this->Est_Codigo = $Est_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->EstA_FechaHoraCrea = $EstA_FechaHoraCrea;
    $this->EstA_UsuarioCrea = $EstA_UsuarioCrea;
    $this->EstA_Estado = $EstA_Estado;
    $this->tabla = "estaciones_areas";
  }

  function getEstA_Codigo() {
    return $this->EstA_Codigo;
  }

  function getEst_Codigo() {
    return $this->Est_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getEstA_FechaHoraCrea() {
    return $this->EstA_FechaHoraCrea;
  }

  function getEstA_UsuarioCrea() {
    return $this->EstA_UsuarioCrea;
  }

  function getEstA_Estado() {
    return $this->EstA_Estado;
  }

  function setEstA_Codigo( $EstA_Codigo ) {
    $this->EstA_Codigo = $EstA_Codigo;
  }

  function setEst_Codigo( $Est_Codigo ) {
    $this->Est_Codigo = $Est_Codigo;
  }

  function setAre_Codigo( $Are_Codigo ) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setEstA_FechaHoraCrea( $EstA_FechaHoraCrea ) {
    $this->EstA_FechaHoraCrea = $EstA_FechaHoraCrea;
  }

  function setEstA_UsuarioCrea( $EstA_UsuarioCrea ) {
    $this->EstA_UsuarioCrea = $EstA_UsuarioCrea;
  }

  function setEstA_Estado( $EstA_Estado ) {
    $this->EstA_Estado = $EstA_Estado;
  }

  public function insertar() {
    $campos = array( "Est_Codigo", "Are_Codigo", "EstA_FechaHoraCrea", "EstA_UsuarioCrea", "EstA_Estado" );
    $valores = array(
      array(
        $this->Est_Codigo,
        $this->Are_Codigo,
        $this->EstA_FechaHoraCrea,
        $this->EstA_UsuarioCrea,
        $this->EstA_Estado
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
    $sql = "SELECT * FROM estaciones_areas WHERE EstA_Codigo = :cod";
    $parametros = array( ":cod" => $this->EstA_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setEst_Codigo( $res[ 1 ] );
      $this->setAre_Codigo( $res[ 2 ] );
      $this->setEstA_FechaHoraCrea( $res[ 3 ] );
      $this->setEstA_UsuarioCrea( $res[ 4 ] );
      $this->setEstA_Estado( $res[ 5 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Est_Codigo", "Are_Codigo", "EstA_FechaHoraCrea", "EstA_UsuarioCrea", "EstA_Estado" );
    $valores = array( $this->getEst_Codigo(), $this->getAre_Codigo(), $this->getEstA_FechaHoraCrea(), $this->getEstA_UsuarioCrea(), $this->getEstA_Estado() );
    $llaveprimaria = "EstA_Codigo";
    $valorllaveprimaria = $this->getEstA_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM estaciones_areas WHERE EstA_Codigo = :cod";
    $parametros = array( ":cod" => $this->EstA_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }

  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarAreasEstacionesAreasEstaciones( $estacion, $usuario ) {

    $parametros = array( ":est" => $estacion, ":usu" => $usuario );

    $sql = "SELECT EstA_Codigo, Pla_Nombre, Are_Nombre
FROM estaciones_areas
INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
WHERE EstA_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND Est_Codigo = :est
ORDER BY Pla_Nombre ASC, Are_Nombre ASC";

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
  public function listarAreasEstacionesPuestosTrabajo( $estacion ) {

    $parametros = array( ":est" => $estacion );

    $sql = "SELECT estaciones_areas.EstA_Codigo, Are_Nombre, Est_Codigo
	FROM estaciones_areas
	INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	WHERE EstA_Estado = 1 AND estaciones_areas.Est_Codigo = :est
	ORDER BY Are_Nombre ASC";

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
  public function buscarAreas($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT DISTINCT areas.Are_Codigo 
    FROM estaciones_areas
    INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    WHERE EstA_Estado = 1 AND plantas.Pla_Codigo = :pla 
    ORDER BY Pla_Nombre ASC, Are_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>