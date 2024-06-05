<?php
require_once( 'basedatos.php' );

class submarcas extends basedatos {
  private $Sub_Codigo;
  private $Pla_Codigo;
  private $Sub_Nombre;
  private $Sub_UsuarioCrea;
  private $Sub_FechaHoraCrea;
  private $Sub_Estado;

  function __construct( $Sub_Codigo = NULL, $Pla_Codigo = NULL, $Sub_Nombre = NULL, $Sub_UsuarioCrea = NULL, $Sub_FechaHoraCrea = NULL, $Sub_Estado = NULL ) {
    $this->Sub_Codigo = $Sub_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Sub_Nombre = $Sub_Nombre;
    $this->Sub_UsuarioCrea = $Sub_UsuarioCrea;
    $this->Sub_FechaHoraCrea = $Sub_FechaHoraCrea;
    $this->Sub_Estado = $Sub_Estado;
    $this->tabla = "submarcas";
  }

  function getSub_Codigo() {
    return $this->Sub_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getSub_Nombre() {
    return $this->Sub_Nombre;
  }

  function getSub_UsuarioCrea() {
    return $this->Sub_UsuarioCrea;
  }

  function getSub_FechaHoraCrea() {
    return $this->Sub_FechaHoraCrea;
  }

  function getSub_Estado() {
    return $this->Sub_Estado;
  }

  function setSub_Codigo( $Sub_Codigo ) {
    $this->Sub_Codigo = $Sub_Codigo;
  }

  function setPla_Codigo( $Pla_Codigo ) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setSub_Nombre( $Sub_Nombre ) {
    $this->Sub_Nombre = $Sub_Nombre;
  }

  function setSub_UsuarioCrea( $Sub_UsuarioCrea ) {
    $this->Sub_UsuarioCrea = $Sub_UsuarioCrea;
  }

  function setSub_FechaHoraCrea( $Sub_FechaHoraCrea ) {
    $this->Sub_FechaHoraCrea = $Sub_FechaHoraCrea;
  }

  function setSub_Estado( $Sub_Estado ) {
    $this->Sub_Estado = $Sub_Estado;
  }

  public function insertar() {
    $campos = array( "Pla_Codigo", "Sub_Nombre", "Sub_UsuarioCrea", "Sub_FechaHoraCrea", "Sub_Estado" );
    $valores = array(
      array(
        $this->Pla_Codigo,
        $this->Sub_Nombre,
        $this->Sub_UsuarioCrea,
        $this->Sub_FechaHoraCrea,
        $this->Sub_Estado
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
    $sql = "SELECT * FROM submarcas WHERE Sub_Codigo = :cod";
    $parametros = array( ":cod" => $this->Sub_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setPla_Codigo( $res[ 1 ] );
      $this->setSub_Nombre( $res[ 2 ] );
      $this->setSub_UsuarioCrea( $res[ 3 ] );
      $this->setSub_FechaHoraCrea( $res[ 4 ] );
      $this->setSub_Estado( $res[ 5 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Pla_Codigo", "Sub_Nombre", "Sub_UsuarioCrea", "Sub_FechaHoraCrea", "Sub_Estado" );
    $valores = array( $this->getPla_Codigo(), $this->getSub_Nombre(), $this->getSub_UsuarioCrea(), $this->getSub_FechaHoraCrea(), $this->getSub_Estado() );
    $llaveprimaria = "Sub_Codigo";
    $valorllaveprimaria = $this->getSub_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM submarcas WHERE Sub_Codigo = :cod";
    $parametros = array( ":cod" => $this->Sub_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }


  /*
    Autor: Natalia Rodriguez
    Fecha: 
    Descripción:
    Parámetros:
   */
  public function listarSubmarcasPrincipal( $planta, $estado, $usuario ) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario );

    $sql = "SELECT Sub_Codigo, Pla_Nombre, Sub_Nombre, Sub_Estado
	 FROM submarcas
	 INNER JOIN plantas ON submarcas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	 INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	 WHERE Sub_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

    if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " submarcas.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

  /*
      Autor: Natalia Rodriguez
      Fecha: 
      Descripción: NO MODIFICAR
      Parámetros:
     */
  public function listarSubmarcas( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT DISTINCT Sub_Nombre , Sub_Codigo, plantas.Pla_Codigo
     FROM submarcas
     INNER JOIN plantas ON submarcas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
     INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado=1
     WHERE Sub_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
     GROUP BY Sub_Nombre 
     ORDER BY Sub_Nombre ASC";

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
  public function listarSubmarcasUsuario( $planta, $usuario ) {

    $parametros = array( ":pla" => $planta, ":usu" => $usuario );

    $sql = "SELECT Sub_Codigo, Sub_Nombre
      FROM submarcas
      INNER JOIN plantas ON submarcas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE submarcas.Pla_Codigo = :pla AND plantas_usuarios.Usu_Codigo = :usu AND Sub_Estado = 1
      ORDER BY Sub_Nombre ASC";

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
  public function buscarPlanta( $submarca ) {

    $parametros = array( ":sub" => $submarca );

    $sql = "SELECT plantas.Pla_Codigo
     FROM submarcas
     INNER JOIN plantas ON submarcas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
     WHERE Sub_Estado = 1 AND submarcas.Sub_Codigo = :sub";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }

}


?>
