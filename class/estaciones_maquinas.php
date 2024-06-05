<?php
require_once( 'basedatos.php' );

class estaciones_maquinas extends basedatos {
  private $EstM_Codigo;
  private $Est_Codigo;
  private $Maq_Codigo;
  private $EstM_FechaHoraCrea;
  private $EstM_UsuarioCrea;
  private $EstM_Estado;

  function __construct( $EstM_Codigo = NULL, $Est_Codigo = NULL, $Maq_Codigo = NULL, $EstM_FechaHoraCrea = NULL, $EstM_UsuarioCrea = NULL, $EstM_Estado = NULL ) {
    $this->EstM_Codigo = $EstM_Codigo;
    $this->Est_Codigo = $Est_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->EstM_FechaHoraCrea = $EstM_FechaHoraCrea;
    $this->EstM_UsuarioCrea = $EstM_UsuarioCrea;
    $this->EstM_Estado = $EstM_Estado;
    $this->tabla = "estaciones_maquinas";
  }

  function getEstM_Codigo() {
    return $this->EstM_Codigo;
  }

  function getEst_Codigo() {
    return $this->Est_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getEstM_FechaHoraCrea() {
    return $this->EstM_FechaHoraCrea;
  }

  function getEstM_UsuarioCrea() {
    return $this->EstM_UsuarioCrea;
  }

  function getEstM_Estado() {
    return $this->EstM_Estado;
  }

  function setEstM_Codigo( $EstM_Codigo ) {
    $this->EstM_Codigo = $EstM_Codigo;
  }

  function setEst_Codigo( $Est_Codigo ) {
    $this->Est_Codigo = $Est_Codigo;
  }

  function setMaq_Codigo( $Maq_Codigo ) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setEstM_FechaHoraCrea( $EstM_FechaHoraCrea ) {
    $this->EstM_FechaHoraCrea = $EstM_FechaHoraCrea;
  }

  function setEstM_UsuarioCrea( $EstM_UsuarioCrea ) {
    $this->EstM_UsuarioCrea = $EstM_UsuarioCrea;
  }

  function setEstM_Estado( $EstM_Estado ) {
    $this->EstM_Estado = $EstM_Estado;
  }

  public function insertar() {
    $campos = array( "Est_Codigo", "Maq_Codigo", "EstM_FechaHoraCrea", "EstM_UsuarioCrea", "EstM_Estado" );
    $valores = array(
      array(
        $this->Est_Codigo,
        $this->Maq_Codigo,
        $this->EstM_FechaHoraCrea,
        $this->EstM_UsuarioCrea,
        $this->EstM_Estado
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
    $sql = "SELECT * FROM estaciones_maquinas WHERE EstM_Codigo = :cod";
    $parametros = array( ":cod" => $this->EstM_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setEst_Codigo( $res[ 1 ] );
      $this->setMaq_Codigo( $res[ 2 ] );
      $this->setEstM_FechaHoraCrea( $res[ 3 ] );
      $this->setEstM_UsuarioCrea( $res[ 4 ] );
      $this->setEstM_Estado( $res[ 5 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Est_Codigo", "Maq_Codigo", "EstM_FechaHoraCrea", "EstM_UsuarioCrea", "EstM_Estado" );
    $valores = array( $this->getEst_Codigo(), $this->getMaq_Codigo(), $this->getEstM_FechaHoraCrea(), $this->getEstM_UsuarioCrea(), $this->getEstM_Estado() );
    $llaveprimaria = "EstM_Codigo";
    $valorllaveprimaria = $this->getEstM_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM estaciones_maquinas WHERE EstM_Codigo = :cod";
    $parametros = array( ":cod" => $this->EstM_Codigo );
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
  public function listarMaquinasEstacionesMaquinas( $estacion, $usuario ) {

    $parametros = array( ":est" => $estacion, ":usu" => $usuario );

    $sql = "SELECT EstM_Codigo, Pla_Nombre, Are_Nombre, Maq_Nombre
	FROM estaciones_maquinas
	INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
	INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE EstM_Estado = 1 AND estaciones_maquinas.Est_Codigo = :est AND plantas_usuarios.Usu_Codigo = :usu
	ORDER BY Maq_Nombre ASC";

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
  public function filtroEstacionesMaquinasEstaciones( $estacion, $usuario ) {

    $parametros = array( ":est" => $estacion, ":usu" => $usuario );

    $sql = "SELECT EstM_Codigo, Maq_Nombre
	FROM estaciones_maquinas
	INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND maquina.Maq_Estado = 1
	INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN canales ON areas.Can_Codigo = canales.Can_Codigo AND canales.Can_Estado = 1
	INNER JOIN fases ON canales.Fas_Codigo = fases.Fas_Codigo AND fases.Fas_Estado = 1
	INNER JOIN plantas ON fases.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE EstM_Estado = 1 AND estaciones_maquinas.Est_Codigo = :est AND plantas_usuarios.Usu_Codigo = :usu
	ORDER BY Maq_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
